<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Renter extends Model
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

    public function contact(): MorphOne
    {
        return $this->morphOne(Contact::class, 'contactable');
    }

    public function rents(): HasMany
    {
        return $this->hasMany(Rent::class);
    }

    protected function formatedCnpj(): Attribute
    {
        return Attribute::make(
            get: fn() => substr($this->cnpj, 0, 2) . '.' . substr($this->cnpj, 2, 3) . '.' . substr($this->cnpj, 5, 3) . '/' . substr($this->cnpj, 8, 4) . '-' . substr($this->cnpj, -2),
        );
    }
}
