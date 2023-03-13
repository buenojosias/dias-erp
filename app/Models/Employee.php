<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf',
        'rg',
        'birthday',
        'role',
    ];

    protected $casts = [
        'birthday' => 'date:Y-m-d',
    ];

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function contact(): MorphOne
    {
        return $this->morphOne(Contact::class, 'contactable');
    }

    public function payments(): MorphMany
    {
        return $this->MorphMany(Payment::class, 'paymentable');
    }

    protected function formatedCpf(): Attribute
    {
        return Attribute::make(
            get: fn() => substr($this->cpf, 0, 3) . '.' . substr($this->cpf, 3, 3) . '.' . substr($this->cpf, 6, 3) . '-' . substr($this->cpf, 9)
        );
    }
}
