<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
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
        'status',
        'balance',
        'taxe_tva',
        'rcm_number',
        'rcc_number',
        'reglement',
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
