<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WareItem;    
use App\Models\Ware;    
use App\Models\Product;    
use Illuminate\Support\Facades\Validator;
use Redirect;


class WareItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = WareItem::orderBy('created_at', 'desc')->paginate(30);
        return view('backend.ware-item.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wares = Ware::all()->pluck('name','id');
        $products = Product::all()->pluck('name','id');
        return view('backend.ware-item.create',compact('wares','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ware_id' => ['required', 'integer'],
            'product_id' => ['required', 'integer','unique:ware_items'],
            'price' => ['required', 'integer'],
            'item_count' => ['required', 'integer'],
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else
        WareItem::add($request->all());
        return redirect()->route('ware-item.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!empty(WareItem::find($id)))
        {
            $item = WareItem::find($id);
            return view('backend.ware-item.view',compact('item'));
        }
        return redirect()->route('ware-item.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!empty(WareItem::find($id)))
        {
            $item = WareItem::find($id);
            $wares = Ware::all()->pluck('name','id');
            $products = Product::all()->pluck('name','id');
            return view('backend.ware-item.edit',compact('item','wares','products'));
        }
        return redirect()->route('ware-item.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!empty(WareItem::find($id)))
        {
            $item = WareItem::find($id);

            $validator = Validator::make($request->all(), [
            'ware_id' => ['required', 'integer'],
            'product_id' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'item_count' => ['required', 'integer'],
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            else                
            $item->edit($request->all());
        }
        return redirect()->route('ware-item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = WareItem::find($id);
        if($item->delete())
        {
            return back();
        }
        return redirect()->route('ware-item.index');
    }

    public function search()
    {
        $query = WareItem::query();
        if (isset($_GET["q"]) && $_GET["q"]) {
            $key = $_GET["q"];    
            $items = $query->where('product_id','LIKE','%'.$key.'%')->orderBy('created_at', 'desc')->paginate(30);
            return view('backend.ware-item.index',compact('items'));
        }
        $items = $query->paginate(30);
        return view('backend.ware-item.index',compact('items'));
    }
}
