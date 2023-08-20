<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberParticipation extends Model
{
    use HasFactory;

    protected $fillable = [
        "member_id",
        "year_id",
        "amount",
        "motif"
    ];

    /*public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }*/
}
