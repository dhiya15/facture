<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jam3iyaExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        "type_id",
        "amount",
        "description"
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
