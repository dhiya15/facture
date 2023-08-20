<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "month_amount",
        "is_active",
        "is_current",
    ];

    public function members()
    {
        return $this->hasMany(MemberYear::class);
    }
}
