<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'body', 'category_id'
    ];

    public function getSlugAttribute($value){
        return $value."-".$this->id;
    }

    public function category() {
       return $this->belongsTo('App\Models\Category');
    }

}
