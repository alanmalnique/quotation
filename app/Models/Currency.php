<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'currencies';
    protected $primaryKey = 'currency_id';
    protected $fillable = [
        'iso_code'
    ];
}
