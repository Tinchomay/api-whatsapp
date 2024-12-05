<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    use HasFactory;

    protected $fillable = [
        'numde',
        'naciu',
        'tiden',
        'vemar',
        'vemol',
        'vepla',
        'estde',
        'resIns',
        'insce',
        'nafis',
        'comsu',
        'estoc',
        'indpe',
        'indsu',
        'comsd',
        'ninfi',
        'dareg',
        'numof',
    ];
}
