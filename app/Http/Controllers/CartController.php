<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;

class CartController extends Controller
{
    public function save_cart(Request $request){
    	$productId = $request->product_id_hidden;
    	$quantity = $request->qty;

    	$product_info = DB::table('tbl_product')->where('product_id', $productId)->first();

//    	Cart::add('293ad', 'Product 1', 1, 9.99, 550);
// Cart::destroy();

    	$data['id'] = $product_info->product_id;
    	$data['qty'] = $quantity;
    	$data['name'] = $product_info->product_name;
    	$data['price'] = $product_info->product_price;
    	$data['weight'] = $product_info->product_id;
    	$data['options']['image'] = $product_info->product_image;

    	Cart::add($data);

        Session::put('message', 'Thêm sản phẩm vào giỏ hàng thành công!');


    	return Redirect::to('/show-cart');
    }

    public function show_cart(){

    	return view('pages.cart');

    }

    public function delete_cart($rowId){

        Cart::update($rowId,0);

        Session::put('message', 'Xoá sản phẩm thành công!');

        return Redirect::to('/show-cart');
    }

    public function update_cart(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->quantity_cart;

        Cart::update($rowId,$qty);

        Session::put('message', 'Cập nhật số lượng sản phẩm thành công!');


        return Redirect::to('/show-cart');

    }
}
