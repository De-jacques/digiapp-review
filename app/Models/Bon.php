<?php

namespace App\Models;

use App\Models\TypeBon;
use App\Models\Proforma;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bon extends Model
{
    use HasFactory;

    protected $fillable= ['type_bon_id', 'proforma_id', 'created_at', 'updated_at', 'path', 'file_bon', 'bon_ref'];

    public function proforma(): BelongsTo{
        return $this->belongsTo(Proforma::class, 'proforma_id');
    }
    public function typeBon(): BelongsTo{
        return $this->belongsTo(TypeBon::class, 'type_bon_id');
    }
   
}
