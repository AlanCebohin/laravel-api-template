<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['title', 'body', 'user_id'])]
class Post extends Model
{
    // protected $fillable = [
    //     'title',
    //     'body',
    // ];
}
