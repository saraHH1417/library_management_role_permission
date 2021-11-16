<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Book extends Model implements HasMedia
{
    use HasFactory , SoftDeletes , InteractsWithMedia;
    protected $fillable = [
        'name',
        'quantity',
        'author_id',
        'publisher_id',
        'user_id'
    ];

    public function publisher()
    {
       return $this->belongsTo(Publisher::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function user()
    {
        return $this->belongsTo(User::all());
    }
}
