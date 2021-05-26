<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    public function note()
    {
        return $this->hasMany(Note::class);
    }

    protected $fillable = [
        'title',
    ];
}
