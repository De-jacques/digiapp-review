<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sortie extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'id',
        'uuid',
        'ref_sortie',
        'ref_proforma',
        'date',
        'num_facture',
        'entrepot_id',
        'customer_id',
        'document_path',
        'author',
        'facture_path',
    ];



    public function sortieIterms()
    {
        return $this->hasMany(SortieIterm::class);
    }
    public function serialNumber()
    {
        return $this->has(SerialNumber::class);
    }
    public function document()
    {
        return $this->hasOne(Document::class);
    }
    public function customer()
    {
        return $this->hasOne(Client::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function getEntrepotNom($id)
    {
        $entrepot = Entrepot::find($id)->name;
        return $entrepot;
    }
    public function getCustomer($id)
    {
        $client = Client::find($id);

        if ($client) {
            $customer = $client->nom;
            return $customer;
        }

        return null; // ou une autre valeur par défaut en cas d'absence de client
    }
    public function getProvider($id)
    {
        $provider = Provider::find($id)->name;
        return $provider;
    }
    public function getSupplier($id)
    {
        $supplier = Supplier::find($id)->name;
        return $supplier;
    }
}
