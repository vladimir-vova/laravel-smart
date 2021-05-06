<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }

    protected $fillable = [
        'name',
        'work_id', // статус
        'description', // описание
        'order_id', // номер заказа
        'step', // 0-срочное, 1-обычное
        'created_at', // от
        'updated_at', // до
        'user_id', // кто создал
        'open', // закрыт или открыт
    ];

    public function getPostDate($title)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->$title)->format('d-F-Y');
    }
}
