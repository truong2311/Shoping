<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_product(){
        $this -> AuthLogin();

        $category_product = DB::table('tbl_category_product')->orderby('category_product_id', 'asc')->get();
        $brand = DB::table('tbl_brand')->orderby('brand_id', 'asc')->get();

    	return view('admin.product.add_product')->with('category_product', $category_product)->with('brand', $brand);
    }

    public function all_product(Request $request){
        $this -> AuthLogin();
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by == 'all'){
                $all_product = DB::table('tbl_product')
                ->join('tbl_category_product', 'tbl_category_product.category_product_id', '=' , 'tbl_product.category_product_id')
                ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
                ->orderby('product_id', 'desc')->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'az') {

                $all_product = DB::table('tbl_product')->orderby('product_name', 'asc')
                ->join('tbl_category_product', 'tbl_category_product.category_product_id', '=' , 'tbl_product.category_product_id')
                ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
                ->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'za') {
                $all_product = DB::table('tbl_product')->orderby('product_name', 'desc')
                ->join('tbl_category_product', 'tbl_category_product.category_product_id', '=' , 'tbl_product.category_product_id')
                ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
                ->paginate(5)->appends(request()->query());
            }

        }else{
            $all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_product_id', '=' , 'tbl_product.category_product_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->orderby('product_id', 'desc')->paginate(5);
        }

    	return view('admin.product.all_product')->with('all_product', $all_product);
    }

    public function save_product(Request $request){
        $this -> AuthLogin();

    	$data = array();
    	$data['category_product_id'] = $request->category_product_id;
    	$data['brand_id'] = $request->brand_id;
    	$data['product_name'] = $request->product_name;
    	$data['product_slug'] = $request->product_slug;
    	$data['product_desc'] = $request->product_desc;
    	$data['product_content'] = $request->product_content;
      	$data['product_number'] = $request->product_number;    	
    	$data['product_price'] = $request->product_price;
    	$data['product_status'] = $request->product_status;

    	$get_image = $request->file('product_image');
    	if($get_image){
        	$get_name_image = $get_image->getClientOriginalName();
        	$name_image = current(explode('.', $get_name_image));
        	$new_image = $name_image.rand(0,99). '.' .$get_image->getClientOriginalExtension();
        	$get_image->move('public/upload/product', $new_image);
        	$data['product_image'] = $new_image;
        	DB::table('tbl_product')->insert($data);
        	Session::put('message','Thêm sản phẩm thành công!');
        	return Redirect::to('all-product');
    	} 
    	$data['product_image'] = '';
    	DB::table('tbl_product')->insert($data);
    	Session::put('message','Thêm sản phẩm thành công!');
    	return Redirect::to('all-product');
    }

    public function unactive_product($product_id){
        $this -> AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status'=>1]);
        Session::put('message','Ẩn sản phẩm thành công!');
        return Redirect::to('all-product');
    }

    public function active_product($product_id){
        $this -> AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status'=>0]);
        Session::put('message','Hiển thị sản phẩm thành công!');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id){
        $this -> AuthLogin();

        $category_product = DB::table('tbl_category_product')->orderby('category_product_id', 'asc')->get();
        $brand = DB::table('tbl_brand')->orderby('brand_id', 'asc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();

        return view('admin.product.edit_product')->with('edit_product', $edit_product)->with('category_product', $category_product)->with('brand', $brand);
    }

    public function update_product(Request $request, $product_id){
        $this -> AuthLogin();

        $data = array();
        $data['category_product_id'] = $request->category_product_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_name'] = $request->product_name;
        $data['product_slug'] = $request->product_slug;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_number'] = $request->product_number;     
        $data['product_price'] = $request->product_price;

        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99). '.' .$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công!');
            return Redirect::to('all-product');
        } 
        $data['product_image'] = '';
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công!');
        return Redirect::to('all-product');
    }

    public function delete_product($product_id){
        $this -> AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();

        Session::put('message', 'Xoá sản phẩm thành công!');

        return Redirect::to('all-product');
    }

/*    public function delete_category_product($category_product_id){
        $this -> AuthLogin();
        $all_category_product = DB::table('tbl_category_product') ->where('category_product_id', $category_product_id)->exists();

        if($all_category_product){
            Session::put('message','Danh mục sản phẩm đang được liên kết, Xoá không thành công!');
            return Redirect::to('all-category-product');
        }else{
            DB::table('tbl_category_product')->where('category_product_id', $category_product_id)->delete();
            Session::put('message','Xoá danh mục sản phẩm thành công!');
            return Redirect::to('all-category-product');
        }

    }*/

    public function search_product(Request $request){
        $this -> AuthLogin();
        $keywords = $request->keywords_submits;

        $search_product = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_category_product.category_product_id', '=' , 'tbl_product.category_product_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('product_name', 'like', '%'.$keywords.'%')->orderby('tbl_product.product_id', 'desc')->get();

       return view('admin.product.search_product')->with('search_product', $search_product);
    }
}
