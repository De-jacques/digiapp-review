<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;
use App\Models\SubCategory;


class Categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at'
    ];
    public function produits()
    {
        return $this->belongsTo(Produit::class);
    }
    public function sub_categories()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function sous_categories($id)
    {
        $subs = SubCategory::where('category_id', '=', $id)->get();
        return $subs;
    }
}
