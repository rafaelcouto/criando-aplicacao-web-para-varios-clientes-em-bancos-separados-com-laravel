<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $connection = 'main';
    
    protected $fillable = [
        'id',
        'name',
        'host',
        'port',
        'database_name',
        'username',
        'password'
    ];
}
