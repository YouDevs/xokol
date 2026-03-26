<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = []; // todos los campos son llenables.

    protected function casts()
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
