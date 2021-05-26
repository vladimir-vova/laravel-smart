<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    protected $fillable = [
        'name',
        'user_id',
        'type_id',
        'open',
        'created_at',
    ];

    public function getPostDate($title)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->$title)->diffForHumans();
    }
}
