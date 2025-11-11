<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'image',
        'category_id'
    ];


    public function cat(){

        return $this->belongsTo(Category::class,'category_id','id');

    }
}
