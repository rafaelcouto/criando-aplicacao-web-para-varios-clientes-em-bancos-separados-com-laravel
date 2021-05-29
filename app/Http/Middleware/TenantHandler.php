<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use App\Util\TenantConnector;
use Closure;
use Illuminate\Http\Request;

class TenantHandler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $tenant = Tenant::findOrFail($request->tenant);

        TenantConnector::connect($tenant);
        
        return $next($request);
    }
}
