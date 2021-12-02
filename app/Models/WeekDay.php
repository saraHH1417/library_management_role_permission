<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeekDay extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['name'];

    public function Books()
    {
        return $this->belongsToMany(Book::class , 'book_week_days')
            ->withPivot('start_time' , 'end_time' , 'id');
    }
}
