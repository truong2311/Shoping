<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(){

    	$product = DB::table('tbl_product')->where('product_status', '0')->orderby('product_id', 'desc')->paginate(8);

        $brand = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();

    	return view('pages.home')->with('brand', $brand)->with('product', $product);
    }
}
