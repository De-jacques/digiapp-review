<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreRelease extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'uuid',
        'ref_sortie',
        'customer_id',
        'entrepot_id',
        'proforma_id',
        'num_facture',
        'product_id',
        'date',
        'qte_dmd',
        'qte_livre',
        'reste',
        'observation',
        'facture_path',
    ];

    public function customer()
    {
        return $this->belongsTo(Client::class);
    }

    public function entrepot()
    {
        return $this->belongsTo(Entrepot::class);
    }

    public function proforma()
    {
        return $this->belongsTo(Proforma::class);
    }

    public function product()
    {
        return $this->belongsTo(Produit::class);
    }
    public function getProduit($id)
    {
        $productLook = Produit::find($id)->designation;
        return $productLook;
    }
    public function designation()
    {
        return $this->attributes['designation'];
    }
}
