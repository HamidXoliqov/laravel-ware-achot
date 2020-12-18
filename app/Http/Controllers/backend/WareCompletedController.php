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

class WareCompletedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $process = WareProcess::where('status','complect')->orderBy('created_at', 'desc')->paginate(30);
        return view('backend.ware-completed.index',compact('process'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('ware-completed.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('ware-completed.index'); 
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
            return view('backend.ware-completed.view',compact('process'));
        }
        return redirect()->route('ware-completed.index');
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
            $status = [
                'complect'=>'Completed',    
                'no-complect'=>'No completed',    
            ];

            return view('backend.ware-completed.edit',compact('process','wares','products','status'));
        }
        return redirect()->route('ware-completed.index');
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
                'status' => ['required', 'string'],
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            else
            $process->edit($request->all());
        }
        return redirect()->route('ware-completed.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('ware-completed.index');
    }

    public function search()
    {
        $query = WareProcess::query();
        if (isset($_GET["q"]) && $_GET["q"]) {
            $key = $_GET["q"];    
            $process = $query->where('status','complect')->where('product_id','LIKE','%'.$key.'%')->orderBy('created_at', 'desc')->paginate(30);
            return view('backend.ware-completed.index',compact('process'));
        }
        $process = $query->paginate(30);
        return view('backend.ware-completed.index',compact('process'));
    }
}
