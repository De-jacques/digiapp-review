<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'country',
        'city',
        'municipality',
        'contact',
        'email',
        'balance',
        'taxe_tva',
        'rcc_number',
        'rcm_number',
        'exo_path',
        'rcc_path',
        'rcm_path',
        'regime',
        'regime_path',
        'reglement',
        'domiciliation',
        'created_at',
        'updated_at'
    ];
}
