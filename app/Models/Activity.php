<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activity';
    protected $fillable = [
        'change_type',
        'model',
        'model_id',
        'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
