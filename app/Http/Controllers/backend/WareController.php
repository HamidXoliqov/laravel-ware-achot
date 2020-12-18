<?php

namespace App\Http\Controllers\backend;

use App\Models\Ware;
use App\Models\WareItem;
use App\Models\WareProcess;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;


class WareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wares = Ware::orderBy('created_at', 'desc')->paginate(30);

        return view('backend.ware.index',compact('wares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.ware.create');
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
            'name' => ['required', 'string', 'min:3','max:50', 'unique:ware'],
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else
        Ware::add($request->all());
        return redirect()->route('ware.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!empty(Ware::find($id)))
        {
            $ware = Ware::find($id);
            return view('backend.ware.view',compact('ware'));
        }
        return redirect()->route('ware.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!empty(Ware::find($id)))
        {
            $ware = Ware::find($id);
            return view('backend.ware.edit',compact('ware'));
        }
        return redirect()->route('ware.index');
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
        if(!empty(Ware::find($id)))
        {
            $ware = Ware::find($id);

            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'min:3','max:50', 'unique:ware'],
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            else
            $ware->edit($request->all());
        }
        return redirect()->route('ware.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ware = Ware::find($id);
        if($ware->delete())
        {
            if(WareItem::query()->where('ware_id',$id)->delete() && WareProcess::query()->where('ware_id',$id)->delete())
            {
                return back();
            }
            
        }
        return redirect()->route('ware.index');
    }

    public function search()
    {
        $query = Ware::query();
        if (isset($_GET["q"]) && $_GET["q"]) {
            $key = $_GET["q"];    
            $wares = $query->where('name','LIKE','%'.$key.'%')->orderBy('created_at', 'desc')->paginate(30);
            return view('backend.ware.index',compact('wares'));
        }
        $wares = $query->paginate(30);
        return view('backend.ware.index',compact('wares'));
    }

    public function status($id)
    {
        $ware = Ware::find($id);
        if($ware->status ==1)
        {
            $ware->status = 0;
        }
        else
        {
            $ware->status = 1;
        }
        if($ware->save()){
            echo json_encode('success');
        }
        else{
            echo json_encode('error');
        }        
    }
}
