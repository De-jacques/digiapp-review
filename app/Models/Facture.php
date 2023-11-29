<?php

namespace App\Models;

use App\Models\Proforma;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = ['ref_proforma','montant','date_facture'];

    public function proforma(): BelongsTo{
        return $this->belongsTo(Proforma::class, 'ref_proforma');
    }
}
