<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
   protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function getImage(){
        $image = $this->image != '' ? $this->image:'images/Krtf5ztEXvhaxT7ioAHPGO9eQK2XTHw1nndJiZ8g.png';
        return 'storage/'.$image;
    }
}
