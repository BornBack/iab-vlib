<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name',
        'author',
        'publication',
        'page_number',
        'cover_link',
        'read_link',
        'read',
    ];
    use HasFactory;
}