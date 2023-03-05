<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TributeInstallment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tribute_id',
        'amount',
        'expiration_date',
        'payment_date',
        'status',
    ];

    protected $casts = [
        'amount' => 'integer',
        'expiration_date' => 'date:Y-m-d',
        'payment_date' => 'date:Y-m-d',
    ];

    public function tribute(): BelongsTo{
        return $this->belongsTo(Tribute::class);
    }
}
