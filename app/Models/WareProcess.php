<?php

namespace App\models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class WareProcess extends Model
{
   protected $table = 'ware_process';

    protected $fillable = [
        'ware_id',
        'product_id',
        'price',
        'count',
        'item_number',
        'date',
        'status',
    ];

    public static function add($filds)
    {
        $post = new static;
        $post->fill($filds);
        $post->date = ($post['date'])?$post['date']:date('Y-m-d',time());
        $ware_count = WareItem::getCount($post['ware_id']);

        if (intval($ware_count)>=$post['count']) {
            $ware_item = WareItem::where('ware_id',$post['ware_id'])->first();
            $ware_item->item_count = intval($ware_count)-$post['count'];
            $ware_item->save();
            $post->save();
        }
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

    public function getClent()
    {
        if (!empty(User::find($this->clent_id))) {
            return User::find($this->clent_id)->name;
        }

        return "No product";
    }

    public function getPrice($ware_id,$product_id)
    {
        if ($ware_item = WareItem::where([['ware_id',$ware_id],['product_id',$product_id]])->first()) {
            return $ware_item->price;
        }

        return 0;
    }

    public function getStatus($status)
    {
        switch ($status) {
            case 'complect':
                $data = 'Completed';
                break;
            case 'no-complect':
                $data = 'No completed';
                break;
            
            default:
                $data = 'No status';
                break;
        }

        return $data;
    }

}
