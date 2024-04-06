<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        "member_id",
        "info_id",
        "products",
        "number",
        "order_no",
        "lang",
        "with_price",
        "created_at"
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function info()
    {
        return $this->belongsTo(Info::class);
    }
}
