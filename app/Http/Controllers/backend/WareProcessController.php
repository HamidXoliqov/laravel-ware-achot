<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WareItem;    
use App\Models\WareProcess;    
use App\Models\Ware;    
use App\Models\Product;
use App\User;    
use Illuminate\Support\Facades\Validator;
use Redirect;

class WareProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $process = WareProcess::where('status','no-complect')->orderBy('created_at', 'desc')->paginate(30);
        return view('backend.ware-process.index',compact('process'));
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
        return view('backend.ware-process.create',compact('wares','products'));
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
            'product_id' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'count' => ['required', 'integer'],
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else
        WareProcess::add($request->all());
        return redirect()->route('ware-process.index');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!empty(WareProcess::find($id)))
        {
            $process = WareProcess::find($id);
            return view('backend.ware-process.view',compact('process'));
        }
        return redirect()->route('ware-process.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!empty(WareProcess::find($id)))
        {
            $process = WareProcess::find($id);
            $wares = Ware::all()->pluck('name','id');
            $products = Product::all()->pluck('name','id');
            return view('backend.ware-process.edit',compact('process','wares','products'));
        }
        return redirect()->route('ware-process.index');
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
        if(!empty(WareProcess::find($id)))
        {
            $process = WareProcess::find($id);

            $validator = Validator::make($request->all(), [
                'ware_id' => ['required', 'integer'],
                'product_id' => ['required', 'integer'],
                'price' => ['required', 'integer'],
                'count' => ['required', 'integer'],
            ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else

            $process->edit($request->all());
        }
        return redirect()->route('ware-process.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $process = WareProcess::find($id);
        if($process->delete())
        {
            return back();
        }
        return redirect()->route('ware-process.index');
    }

    public function countplus(Request $request)
    {
        $process_id = $request->input("process_id");
        $ware_id = $request->input("ware_id");
        $product_id = $request->input("product_id");
        $count = $request->input("count");      

        if ($ware_item = WareItem::where([['ware_id','=',$ware_id],['product_id','=', $product_id]])->first()) {
            $process = WareProcess::where('id',$process_id)->first();
            if ($ware_item->item_count>=$count) {
                $process->count = $process->count+$count;
                $ware_item->item_count = $ware_item->item_count - $count;
            }
            if ($process->save() && $ware_item->save()) {
                return redirect()->route('ware-process.index');
            }
            return redirect()->route('ware-process.index');
        }
    }

    public function countminus(Request $request)
    {
        $process_id = $request->input("process_id");
        $ware_id = $request->input("ware_id");
        $product_id = $request->input("product_id");
        $count = $request->input("count");      

        if ($ware_item = WareItem::where([['ware_id','=',$ware_id],['product_id','=', $product_id]])->first()) {
            $process = WareProcess::where('id',$process_id)->first();
            if ($process->count>=$count) {
                $process->count = $process->count-$count;
                $ware_item->item_count = $ware_item->item_count + $count;
            }
            if ($process->save() && $ware_item->save()) {
                return redirect()->route('ware-process.index');
            }
            return redirect()->route('ware-process.index');
        }
    }
}
