<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'fantasy_name',
        'cnpj',
    ];

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function contactable(): MorphOne
    {
        return $this->morphOne(Contact::class, 'contactable');
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }
}
