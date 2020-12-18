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

class WareReportController extends Controller
{

    public function index()
    {
    	$query = WareProcess::where('status','complect');
        $process = $query->orderBy('date', 'desc')->paginate(30);
        $sum_price = $query->get()->sum("price");
        $old_prices = 0;
        $foyda = 0;
        foreach ($process as $key => $value) {
        	$price = $value->getPrice($value->ware_id,$value->product_id);
        	$old_prices += $price; 
        	$foyda += $value->price-$price;
        }
        return view('backend.ware-report.index',compact('process','sum_price','old_prices','foyda'));
    }

}