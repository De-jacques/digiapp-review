<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;


class Stock extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($stock) {
            $stock->uuid = Uuid::uuid4()->toString();
        });
    }
    protected $fillable = [
        'id',
        'uuid',
        'produit_id',
        'entrepot_id',
        'quantite',
    ];

    public function getProduit($id)
    {
        $produit = Produit::findOrFail($id);
        return $produit;
    }
    public function getDesignation($id)
    {
        $produit = Produit::findOrFail($id)->designation;
        return $produit;
    }

    public function getEntrepotNom($id)
    {
        $produit = Entrepot::findOrFail($id)->name;
        return $produit;
    }


    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function entrepot()
    {
        return $this->belongsTo(Entrepot::class);
    }
}
