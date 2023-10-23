<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    use HasFactory;
    protected $fillable = [
        'nom',
        'pays',
        'ville',
        'commune',
        'contact',
        'email',
        'type',
        'solde',
        'status',
        'localisation',
        'code_postale',
        'taxe_tva',
        'rcc_number',
        'rcm_number',
        'created_at',
        'updated_at',
        'exo_path',
        'rcc_path',
        'rcm_path',
        'id',
        'uuid',
        'regime',
        'regime_path',
        'domiciliation',
    ];

    public function proformas()
    {
        return $this->hasMany(Proforma::class);
    }
    public function entreprise(): HasOne
    {
        return $this->hasOne(ContactEntrepriseClient::class);
    }
    public function sortie()
    {
        return $this->belongsTo(Sortie::class);
    }

    // public function contactEntrepriseClient($id){
    //     $contact = ContactEntrepriseClient::where('client_id',$id);
    //     return $contact;
    // }
}
