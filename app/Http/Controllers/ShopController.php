<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Paginate\Paginator;

class ShopController extends Controller
{
    public function index(){

        $category_product = DB::table('tbl_category_product')->where('category_product_status', '0')->orderby('category_product_id', 'asc')->get();

        $brand = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();

    	$product = DB::table('tbl_product')->where('product_status', '0')->orderby('product_id', 'desc')->paginate(8);

    	return view('pages.shop')->with('category_product', $category_product)->with('brand', $brand)->with('product', $product);
    }

    //danh mục sản phẩm

    public function show_category_product($category_product_slug){

        $category_product = DB::table('tbl_category_product')->where('category_product_status', '0')->orderby('category_product_id', 'asc')->get();

        $brand = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();

    	$category = DB::table('tbl_category_product')->where('category_product_slug', $category_product_slug)->take(1)->get();

    	foreach ($category as $key => $val) {
            $category_product_id = $val->category_product_id;
        }

        $category_by_id = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_product_id', '=', 'tbl_product.category_product_id')
        ->where('tbl_category_product.category_product_id', $category_product_id)->where('tbl_product.product_status', '0')->get();

    	return view('pages.product.show_category_product')->with('category_product', $category_product)->with('brand', $brand)->with('category_by_id', $category_by_id);
    }

    public function show_brand_product($brand_slug){

        $category_product = DB::table('tbl_category_product')->where('category_product_status', '0')->orderby('category_product_id', 'asc')->get();

        $brand = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();

        $brand_slug = DB::table('tbl_brand')->where('brand_slug', $brand_slug)->take(1)->get();

        foreach ($brand_slug as $key => $val) {
            $brand_id = $val->brand_id;
        }

        $brand_by_id = DB::table('tbl_product')
        ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('tbl_brand.brand_id', $brand_id)->where('tbl_product.product_status', '0')->get();

        return view('pages.product.show_brand_product')->with('category_product', $category_product)->with('brand', $brand)->with('brand_by_id', $brand_by_id);
    }

}
