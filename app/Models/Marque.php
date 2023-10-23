<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;


class Marque extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'id',
        'name',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
