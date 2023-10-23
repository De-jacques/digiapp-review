<?php

namespace App\Models;

use App\Http\Controllers\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_du_contact',
        'numero_telephone',
        'poste',
        'adresse_email',
        'relation',
        'customer_id',
        'supplier_id',
        'provider_id',
        'created_at',
        'updated_at',
        'id',
        'uuid'

    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function fournisseur()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function prestataire()
    {
        return $this->belongsTo(Provider::class);
    }

    public function provider($id)
    {
        $name = Provider::findOrFail($id)->name;
        return $name;
    }
    public function supplier($id)
    {
        $name = Supplier::findOrFail($id)->name;
        return $name;
    }
    public function getCustomer($id)
    {
        $customer = Client::findOrFail($id)->nom;
        // dd($name);
        return $customer;
    }
}
