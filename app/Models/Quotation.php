<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quotation extends Model
{
    public $timestamps = true;

    protected $table = 'quotations';
    protected $fillable = [
        'age',
        'currency',
        'fixed_rate',
        'age_load',
        'value'
    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }
}
