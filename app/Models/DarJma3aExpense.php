<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DarJma3aExpense extends Model
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
