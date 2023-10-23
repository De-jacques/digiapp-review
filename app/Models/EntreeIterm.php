<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntreeIterm extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'uuid',
        'entree_id',
        'qte_cmd',
        'qte_livre',
        'reste',
        'produit_id',
        'ref_entree',
        'observation',

    ];

    public function entree()
    {
        return $this->belongsTo(Entree::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
    public function getProduit($id)
    {
        $productLook = Produit::find($id);
        return $productLook;
    }

    public function designation()
    {
        return $this->attributes['designation'];
    }
    public function refProduit($id)
    {
        $prod = Produit::findOrFail($id);
        $ref = $prod->ref;
        return $ref;
    }
}
