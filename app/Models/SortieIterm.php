<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortieIterm extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'qte_dmd',
        'qte_livre',
        'reste',
        'observation',
        'uuid',
        'produit_id',
        'sortie_id',
        'ref_sortie',

    ];

    public function serialNumbers()
    {
        return $this->hasMany(SerialNumber::class);
    }

    public function sortie()
    {
        return $this->belongsTo(Sortie::class);
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
