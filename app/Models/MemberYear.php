<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberYear extends Model
{
    use HasFactory;

    protected $table = "members_years";

    protected $fillable = [
        "member_id",
        "year_id",
        "amount",
        "motif"
    ];
}
