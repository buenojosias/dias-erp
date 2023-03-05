<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Installment extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'number',
        'amount',
        'expiration_date',
        'payment_date',
        'status',
    ];

    protected $casts = [
        'number' => 'integer',
        'amount' => 'integer',
        'expiration_date' => 'date:Y-m-d',
        'payment_date' => 'date:Y-m-d',
    ];

    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }

    public function transaction(): MorphOne
    {
        return $this->morphOne(Transaction::class, 'transactionable');
    }
}
