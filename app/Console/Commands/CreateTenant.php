<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Models\Company;
use App\Models\Tenant;
use App\Util\TenantConnector;

class CreateTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-tenant {name} {--host=127.0.0.1} {--port=3306} {--username=root}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Tenant';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tenant = $this->getTenant();

        $this->info('Creating database');
        $this->createDatabase($tenant);

        $tenant->save();

        $this->info('Connecting in tenant database');
        TenantConnector::connect($tenant);

        $this->info('Starting migrations');
        $this->call('migrate', ['--database' => 'tenant']);

        $this->info('Creating tenant company');
        $this->createCompany($tenant);
    }

    /**
     * @return Tenant
     */
    private function getTenant()
    {
        $data = $this->options();
        $data['name'] = $this->argument('name');
        $data['id'] = $data['database_name'] = Str::slug($data['name'], '');
        $data['password'] = Crypt::encrypt($this->secret('Input the database password'));

        $tenant = new Tenant();
        $tenant->fill($data);

        return $tenant;
    }

    /**
     * @return void
     */
    private function createDatabase(Tenant $tenant)
    {
        $process = new Process([
            'mysql', 
            "-h{$tenant->host}",
            "-P{$tenant->port}",
            "-u{$tenant->username}",
            "-p" . Crypt::decrypt($tenant->password),
            "-e CREATE DATABASE IF NOT EXISTS {$tenant->database_name} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
        ]);

        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    /**
     * @return void
     */
    private function createCompany(Tenant $tenant)
    {
        $company = new Company();
        $company->name = $tenant->name;
        $company->save();
    }

}
