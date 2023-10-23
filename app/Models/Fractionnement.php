<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fractionnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'norme',
        'type',
        'ref_proforma',
        'date',
        'description',
        'livraison',
        'proforma_id',
        'ref_proforma'
    ];

    public function proforma()
    {
        return $this->belongsTo(Proforma::class);
    }
}
