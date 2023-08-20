<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description"
    ];

    public function jam3iyaExpenses()
    {
        return $this->hasMany(Jam3iyaExpense::class);
    }

    public function darJma3aExpenses()
    {
        return $this->hasMany(DarJma3aExpense::class);
    }
}
