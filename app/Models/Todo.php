<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'todo'; 

    protected $fillable = [
        'title',
        'body',
        'image_url',
        'completed',
    ];

    protected $casts = [
        'completed' => 'boolean',  
    ];

    protected $dates = [
        'deleted_at',
    ];

}
