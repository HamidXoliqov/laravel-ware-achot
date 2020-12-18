<?php

namespace App\models;

use App\Models\WareItem;

use Illuminate\Database\Eloquent\Model;

class Ware extends Model
{
   protected $table = 'ware';

    protected $fillable = [
        'name',
        'parend',
        'clent_id',
    ];

    public static function add($filds)
    {
        $post = new static;
        $post->fill($filds);
        $post->parend = ($post['parend'])?$post['parend']:0;
        $post->save();
    }
    public function edit($filds)
    {
        $this->fill($filds); 
        $this->save();
    }

    public function getWares($id)
    {
        $ware = Ware::where('parend',$id)->get();
        return $ware;
    }

}
