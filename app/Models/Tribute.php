<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Tribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'title_id',
        'amount',
        'note',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
        'amount' => 'integer'
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function title(): BelongsTo
    {
        return $this->belongsTo(TributeTitle::class, 'title_id', 'id');
    }

    public function installments(): HasMany
    {
        return $this->hasMany(TributeInstallment::class);
    }

    public function transaction(): MorphOne
    {
        return $this->morphOne(Transaction::class, 'transactionable');
    }

    protected function formatedAmount(): Attribute
    {
        return Attribute::make(
            get: fn() => number_format($this->amount/100,2,",","."),
        );
    }
}
