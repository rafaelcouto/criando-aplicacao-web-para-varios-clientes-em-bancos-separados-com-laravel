<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $connection = 'tenant';

    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('d/m/Y H:i:s');
    }
}
