<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(30);

        return view('backend.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.create');
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
            'name' => ['required', 'string', 'min:3','max:50', 'unique:product'],
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else
        Product::add($request->all());
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!empty(Product::find($id)))
        {
            $product = Product::find($id);
            return view('backend.product.view',compact('product'));
        }
        return redirect()->route('product.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!empty(Product::find($id)))
        {
            $product = Product::find($id);
            return view('backend.product.edit',compact('product'));
        }
        return redirect()->route('product.index');
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
        if(!empty(Product::find($id)))
        {
            $product = Product::find($id);

            $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3','max:50', 'unique:product'],
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            else
            $product->edit($request->all());
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product->delete())
        {
            return back();
        }
        return redirect()->route('product.index');
    }

    public function search()
    {
        $query = Product::query();
        if (isset($_GET["q"]) && $_GET["q"]) {
            $key = $_GET["q"];    
            $product = $query->where('name','LIKE','%'.$key.'%')->orderBy('created_at', 'desc')->paginate(30);
            return view('backend.product.index',compact('product'));
        }
        $product = $query->paginate(30);
        return view('backend.product.index',compact('product'));
    }
}
