<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'renter_id',
        'date',
        'item',
        'amount',
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

    public function renter(): BelongsTo
    {
        return $this->belongsTo(Renter::class);
    }

    protected function formatedAmount(): Attribute
    {
        return Attribute::make(
            get: fn() => number_format($this->amount/100,2,",","."),
        );
    }
}
