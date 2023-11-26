<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivePlayerManage extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'artist', 'image', 'song_file','listening','android','ios', 'status'];
}
