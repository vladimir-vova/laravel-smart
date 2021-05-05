<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    protected $fillable = [
        'title',
        'step',
        'color',
    ];
}
