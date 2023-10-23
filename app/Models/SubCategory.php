<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'category_id',
        'created_at',
        'updated_at'
    ];

    public function categories()
    {
        return $this->hasMany(Categorie::class);
    }
        public function produits()
    {
        return $this->belongsTo(Produit::class);
    }

    public function getCategoryName($id){
        $get = Categorie::findOrFail($id)->name;
        return $get;
    }
}