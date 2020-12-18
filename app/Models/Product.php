<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $table = 'product';

    protected $fillable = [
        'name',
        'model',
    ];

    public static function add($filds)
    {
        $post = new static;
        $post->fill($filds);
        $post->save();
    }
    public function edit($filds)
    {
        $this->fill($filds); 
        $this->save();
    }
}
