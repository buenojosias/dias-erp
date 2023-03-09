<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'supplier_id',
        'date',
        'products',
        'amount',
        'payment_method',
        'note',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
        'amount' => 'integer',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function installments(): HasMany
    {
        return $this->hasMany(Installment::class);
    }

    protected function formatedAmount(): Attribute
    {
        return Attribute::make(
            get: fn() => number_format($this->amount/100,2,",","."),
        );
    }
}
