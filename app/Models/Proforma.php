<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
Use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proforma extends Model
{
    use HasFactory;
    protected $table = 'proformas';
    protected $guarded = [];

    protected $fillable = [
        'id',
        'total_ht',
        'total',
        'taxe',
        'note',
        'author',
        'customer_id',
        'ref_proforma',
        'discount',
        'commercial_net',
        'discount',
        'discount_amount',
        'tva_amount',
        'issue_date',
        'file',
        'taux_retenu',
        'retenu'
    ];


    public function produits()
    {
        return $this->belongsTo(Produit::class);
    }
    public function clients()
    {
        return $this->belongsTo(Client::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function fractionnements()
    {
        return $this->hasMany(Fractionnement::class);
    }

    public function getDiscount($idClient, $total)
    {
        $client = Client::findOrFail($idClient);
        if ($client->type == "normal" && $total > 5000000) {
            $discount = 2;
        }
        if ($client->type == "revendeur") {
            $discount = 6.5;
        }
        if ($client->type == "distributeur") {
            $discount = 10;
        } else {
            $discount = 0;
        }
        return $discount;
    }
    public function proformaItems()
    {
        return $this->hasMany(ProformaItem::class)->onDelete('cascade');
    }

    public function getClient($customer_id)
    {
        // $client = Client::findOrFail($client_id)->nom;
        $client = Client::find($customer_id)->nom;
        return $client;
    }

    public function getAuthor($author_id)
    {
        // $client = Client::findOrFail($client_id)->nom;
        $author = User::find($author_id)->name;
        return $author;
    }

    public function proformaItemProducts($proformaId)
    {
        $proformaItems = ProformaItem::where('proforma_id', $proformaId)->get();

        foreach ($proformaItems as $proformaItem) {
            $proformaItem->produit = Produit::find($proformaItem->product_id)->designation;
        }

        return $proformaItems;
    }


    public function proformaItemGet($id)
    {
        $proformaItemGet = ProformaItem::find($id);
        return $proformaItemGet;
    }
    public function proformaItemProductsInfo($proformaId)
    {
        $proformaItems = ProformaItem::where('proforma_id', $proformaId)->get();

        foreach ($proformaItems as $proformaItem) {
            $proformaItem->produit = Produit::find($proformaItem->product_id);
        }

        return $proformaItems;
    }

    public function customer(): belongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
