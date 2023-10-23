<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entree extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'id',
        'uuid',
        'num_facture',
        'date',
        'ref_entree',
        'entrepot_id',
        'provider_id',
        'supplier_id',
        'num_bl',
        'author',
        'document_path',
        'bl_path',

    ];


    public function entreeIterms()
    {
        return $this->hasMany(EntreeIterm::class);
    }
    public function serialNumber()
    {
        return $this->has(SerialNumber::class);
    }
    public function document()
    {
        return $this->hasOne(Document::class);
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


    public function isSnComplete($ref_entre)
    {
        $data['ref_entree'] = $ref_entre; //Récupérer la reférence de l'entrée réçu
        $data['entree'] = Entree::where('ref_entree', $ref_entre)->first(); //Reccuperer toutes les information de l'entrée à partir de la ref
        $data['entreeIterms'] = EntreeIterm::where('ref_entree', $ref_entre)->get(); //Ainsi que ces EntreeIterms
        $compter = 0;
        foreach ($data['entreeIterms'] as $item) {
            $registeredSnCount = SerialNumber::where('ref_entree', $ref_entre)
                ->where('product_id', $item->produit_id)
                ->count();

            $item->qte_livre -= $registeredSnCount;
            $compter += $item->qte_livre;
        }

        $data['snIterms'] = SerialNumber::where('ref_entree', $ref_entre)->get();

        if ($compter == 0) {
            return true;
        } else {

            return false;
        }
    }
}
