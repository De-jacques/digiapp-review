<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProformaItem extends Model
{
    protected $table = 'proforma_items';


    use HasFactory;
    protected $fillable = [
        'id',
        'proforma_id',
        'product_id',
        'price',
        'quantity',
        'total',
        'ref_proforma'
    ];

    public function proforma()
    {
        return $this->belongsTo(Proforma::class);
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

    // function getProformaItems($proformaItemId)
    // {
    //     $product = Produit::findOrFail($proformaItemId);
    //     $proformaItems = $product->proformaItems;
    //     return $proformaItems;
    // }
}
