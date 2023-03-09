<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transactionable',
        'description',
        'date',
        'amount',
        'balance_before',
        'balance_after',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
        'amount' => 'integer',
        'balance_before' => 'integer',
        'balance_after' => 'integer',
    ];

    public function transactionable(): MorphTo
    {
        return $this->morphTo();
    }

    protected function formatedAmount(): Attribute
    {
        return Attribute::make(
            get: fn() => number_format($this->amount/100,2,",","."),
        );
    }
}
