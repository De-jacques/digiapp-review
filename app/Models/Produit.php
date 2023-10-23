<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'uuid',
        'designation',
        'prix_revient',
        'marge',
        'prix_vente',
        'sub_category_id',
        'marque_id',
        'description',
        'prix_goov',
        'marge_goov',
        'ref',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (is_null($model->prix_revient)) {
                $model->prix_revient = 0;
            }

            if (is_null($model->marge) || $model->marge == 0) {
                $produit = Produit::all()->first();
                if ($produit) {
                    $model->marge = $produit->marge;
                } else {
                    $model->marge = 0;
                }
            }
            if (is_null($model->marge_goov) || $model->marge_goov == 0) {
                $produit = Produit::all()->first();
                if ($produit) {
                    $model->marge_goov = $produit->marge_goov;
                } else {
                    $model->marge_goov = 0;
                }
            }

            $model->prix_vente = (int) $model->prix_revient + (((int) $model->prix_revient * (int) $model->marge) / 100);
            $model->prix_goov = (int) $model->prix_revient + (((int) $model->prix_revient * ((int) $model->marge_goov)) / 100);
        });

        static::created(function ($produit) {
            $entrepots = Entrepot::all();

            foreach ($entrepots as $entrepot) {
                $stock = new Stock;
                $stock->produit_id = $produit->id;
                $stock->entrepot_id = $entrepot->id;
                $stock->quantite = 0;
                $stock->save();
            }
        });
    }

    public function categorie($id)
    {
        return Categorie::findOrFail($id)->name;
    }
    public function sous_categorie($id)
    {
        return SubCategory::findOrFail($id)->name;
    }

    public function getQte($id)
    {
        $find = Stock::where('produit_id', '=', $id)->sum('quantite');
        return $find;
    }
    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function serialNumbers()
    {
        return $this->hasMany(SerialNumber::class, 'product_id');
    }

    public function marque($id)
    {
        return Marque::findOrFail($id)->name;
    }
    public function entrepot($id)
    {
        return Entrepot::findOrFail($id)->name;
    }
    public function sub_categories()
    {
        return $this->hasOne(SubCategorie::class);
    }
    public function proformaItems()
    {
        return $this->hasMany(ProformaItem::class, 'product_id');
    }
    public function proformas()
    {
        return $this->hasMany(Proforma::class);
    }
    public function sortieIterms()
    {
        return $this->hasMany(SortieIterm::class, 'produit_id');
    }
    public function entreeIterms()
    {
        return $this->hasMany(EntreeIterm::class, 'produit_id');
    }
    // public function getMargeAttribute()
    // {
    //     // Calcul de la marge en pourcentage
    //     return ($this->prix_vente - $this->prix_revient) / $this->prix_revient * 100;
    // }

    // public function setMargeAttribute($value)
    // {
    //     // Mettre à jour les prix de vente en fonction de la nouvelle marge
    //     $this->prix_vente = $this->prix_revient * (1 + ($value / 100));
    //     $this->prix_goov = $this->prix_vente; // Modifier le prix goov également si nécessaire
    // }

}
