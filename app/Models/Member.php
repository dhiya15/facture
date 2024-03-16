<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        "full_name_ar",
        "full_name_fr",
        "email",
        "address_ar",
        "address_fr",
        "phone"
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

}
