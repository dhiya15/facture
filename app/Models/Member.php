<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        "full_name",
        "email",
        "birth_date",
        "profession",
        "phone",
        "image"
    ];

    public function years()
    {
        return $this->hasMany(MemberYear::class);
    }


}
