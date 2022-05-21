<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
  protected $fillable = ['title', 'contents'];
  use HasFactory;

  public function comments()
  {
    // return $this->hasMany('App\Models\Comment', 'post_id', 'blog_post_id');
    return $this->hasMany('App\Models\Comment');
  }
}
