<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivateModules extends Model
{
    use HasFactory;
    protected $fillable = [
        'module_name','module_id', 'priority','is_active'
    ];
}