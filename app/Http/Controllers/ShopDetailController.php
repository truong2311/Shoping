<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;


class ShopDetailController extends Controller
{

    public function detail_product($product_slug){

    	$detail_product = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_category_product.category_product_id', '=' , 'tbl_product.category_product_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('product_slug', $product_slug)->take(1)->get();

        foreach ($detail_product as $key => $value){
            $category_product_id = $value->category_product_id;
        }

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_category_product.category_product_id', '=' , 'tbl_product.category_product_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_category_product.category_product_id', $category_product_id)->where('product_status', '0')->whereNotIn('product_slug', [$product_slug])->get();


        return view('pages.product.shop_detail')->with('detail_product', $detail_product)->with('related_product', $related_product);

    }
}
