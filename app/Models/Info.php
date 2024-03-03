<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $fillable = [
        "key",
        "key_ar",
        "image",
        "full_name_ar",
        "full_name_fr",
        "phone",
        "email",
        "fax",
        "address_ar",
        "address_fr",
        "register_number",
        "id_number",
        "statistics_number",
        "account_number",
        "agency_ar",
        "agency_fr",
        "header_ar",
        "header_fr",
        "default"
    ];
}
