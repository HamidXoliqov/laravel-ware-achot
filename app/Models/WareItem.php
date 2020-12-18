<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ware;
use App\Models\Product;


class WareItem extends Model
{
   protected $table = 'ware_items';

    protected $fillable = [
        'ware_id',
        'product_id',
        'price',
        'item_count',
        'date',
        'item_number',
    ];

    public static function add($filds)
    {
        $post = new static;
        $post->fill($filds);
        $post->date = ($post['date'])?$post['date']:date('Y-m-d',time());
        $post->item_number = ($post['item_number'])?$post['item_number']:'';
        $post->save();
    }
    public function edit($filds)
    {
        $this->fill($filds); 
        $this->save();
    }

    public function getWare()
    {
        if (!empty(Ware::find($this->ware_id))) {
            return Ware::find($this->ware_id)->name;
        }

        return "No ware";
    }

    public function getProduct()
    {
        if (!empty(Product::find($this->product_id))) {
            return Product::find($this->product_id)->name;
        }

        return "No product";
    }

    public static function getCount($id)
    {
        $item = WareItem::where('ware_id',$id)->first();
        return $item->item_count;
    }
}
