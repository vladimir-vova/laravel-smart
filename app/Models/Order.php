<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    protected $fillable = [
        'condition',
        'type',
        'direction',
        'start',
        'description',
        'work_id',
        'client_id',
        'user_id',
    ];
}
