<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount'
    ];

    protected function formatedAmount(): Attribute
    {
        return Attribute::make(
            get: fn() => number_format($this->amount/100,2,",","."),
        );
    }
}
