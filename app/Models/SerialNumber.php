<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerialNumber extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'uuid',
        'product_id',
        'serial_number',
        'status',
        'supplier_id',
        'provider_id',
        'entree_id',
        'ref_entree',
        'customer_id',
        'sortie_id',
        'ref_sortie',

    ];


    public function entree()
    {
        return $this->belongsTo(Entree::class);
    }
    public function product()
    {
        return $this->belongsTo(Produit::class);
    }
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function sortie()
    {
        return $this->belongsTo(Sortie::class);
    }

    public function num_facture($id)
    {

        $ref = Entree::findOrFail($id)->ref_entree;

        return $ref;
    }
    public function num_bl($id)
    {
        $entree = Sortie::findOrFail($id)->ref_sortie;
        return $entree;
    }
    public function ref($id)
    {
        $entree = Produit::findOrFail($id)->ref;
        return $entree;
    }
    public function supplier($id)
    {
        $supplier = Supplier::find($id);
        return $supplier->name;
    }

    public function entre_date($id)
    {
        $supplier = Entree::find($id)->date;
        return $supplier;
    }
    public function sortie_date($id)
    {
        $supplier = Sortie::find($id)->date;
        return $supplier;
    }
}
