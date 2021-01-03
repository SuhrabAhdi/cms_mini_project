<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
   protected $guarded = [];
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function getDate(){
        return $this->created_at->diffForHumans();
    }
}
