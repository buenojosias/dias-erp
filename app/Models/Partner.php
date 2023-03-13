<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'fantasy_name',
        'person_type',
        'document_number',
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
    protected function formatedDocumentNumber(): Attribute
    {
        return Attribute::make(
            get: fn() => strlen($this->document_number) == 11
                ? substr($this->document_number, 0, 3) . '.' . substr($this->document_number, 3, 3) . '.' . substr($this->document_number, 6, 3) . '-' . substr($this->document_number, 9)
                : substr($this->document_number, 0, 2) . '.' . substr($this->document_number, 2, 3) . '.' . substr($this->document_number, 5, 3) . '/' . substr($this->document_number, 8, 4) . '-' . substr($this->document_number, -2),
        );
    }
}
