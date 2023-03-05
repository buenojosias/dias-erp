<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_name',
        'number',
        'complement',
        'district',
        'zip_code',
        'city',
        'state',
    ];

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
