<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class CategoryProductController extends Controller
{

    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_category_product(){
        $this -> AuthLogin();
    	return view('admin.categoryproduct.add_category_product');

    }

    public function all_category_product(Request $request){
        $this -> AuthLogin();
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by == 'all'){
                $all_category_product = DB::table('tbl_category_product')->orderby('category_product_id', 'desc')->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'az') {

                $all_category_product = DB::table('tbl_category_product')->orderby('category_product_name', 'asc')->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'za') {
                $all_category_product = DB::table('tbl_category_product')->orderby('category_product_name', 'desc')->paginate(5)->appends(request()->query());
            }

        }else{
            $all_category_product = DB::table('tbl_category_product')->orderby('category_product_id', 'desc')->paginate(5);
        }

    	return view('admin.categoryproduct.all_category_product')->with('all_category_product', $all_category_product);
    }

    public function save_category_product(Request $request){
        $this -> AuthLogin();

        $category_product_name = $request -> category_product_name;

        $result = DB::table('tbl_category_product')->where('category_product_name', $category_product_name)->first();

    	$data = array();
    	$data['category_product_name'] = $category_product_name;
    	$data['category_product_slug'] = $request->category_product_slug;
    	$data['category_product_desc'] = $request->category_product_desc;
    	$data['category_product_status'] = $request->category_product_status;


        if (isset($result)) {
            Session::put('message', 'Danh mục sản phẩm đã có!');
            return Redirect::to('add-category-product');
        } else {
            DB::table('tbl_category_product')->insert($data);

            Session::put('message', 'Thêm danh mục sản phẩm thành công!');

            return Redirect::to('all-category-product');
        }
    }

    public function unactive_category_product($category_product_id){
        $this -> AuthLogin();
    	DB::table('tbl_category_product')->where('category_product_id', $category_product_id)->update(['category_product_status'=>1]);
    	Session::put('message','Ẩn danh mục sản phẩm thành công!');
    	return Redirect::to('all-category-product');
    }

    public function active_category_product($category_product_id){
        $this -> AuthLogin();
    	DB::table('tbl_category_product')->where('category_product_id', $category_product_id)->update(['category_product_status'=>0]);
    	Session::put('message','Hiển thị danh mục sản phẩm thành công!');
    	return Redirect::to('all-category-product');
    }

    public function edit_category_product($category_product_id){
        $this -> AuthLogin();
    	$edit_category_product = DB::table('tbl_category_product')->where('category_product_id', $category_product_id)->get();

    	return view('admin.categoryproduct.edit_category_product')->with('edit_category_product', $edit_category_product);
    }

    public function update_category_product(Request $request, $category_product_id){
        $this -> AuthLogin();

        $category_product_name = $request -> category_product_name;

        $result = DB::table('tbl_category_product')->where('category_product_name', $category_product_name)->first();

    	$data = array();
    	$data['category_product_name'] = $category_product_name;
    	$data['category_product_slug'] = $request->category_product_slug;
    	$data['category_product_desc'] = $request->category_product_desc;

        DB::table('tbl_category_product')->where('category_product_id', $category_product_id)->update($data);

        Session::put('message', 'Cập nhật danh mục sản phẩm thành công!');

        return Redirect::to('all-category-product');
        
    }

/*    public function delete_category_product($category_product_id){
        $this -> AuthLogin();
    	DB::table('tbl_category_product')->where('category_product_id', $category_product_id)->delete();

    	Session::put('message', 'Xoá danh mục sản phẩm thành công!');

    	return Redirect::to('all-category-product');
    }*/

    public function delete_category_product($category_product_id){
        $this -> AuthLogin();
        $all_product = DB::table('tbl_product')->join('tbl_category_product', 'tbl_category_product.category_product_id', '=' , 'tbl_product.category_product_id')
             ->where('tbl_product.category_product_id', $category_product_id)->exists();

        if($all_product){
            Session::put('message','Danh mục sản phẩm đang được liên kết, Xoá không thành công!');
            return Redirect::to('all-category-product');
        }else{
            DB::table('tbl_category_product')->where('category_product_id', $category_product_id)->delete();
            Session::put('message','Xoá danh mục sản phẩm thành công!');
            return Redirect::to('all-category-product');
        }

    }

    public function search_category_product(Request $request){
        $this -> AuthLogin();
        $keywords = $request->keywords_submits;

/*        $all_category = DB::table('tbl_category_coueses')->paginate(5);
*/        
        $search_category_product = DB::table('tbl_category_product')->where('category_product_name', 'like', '%'.$keywords.'%')->orderby('tbl_category_product.category_product_id', 'desc')->get();

       return view('admin.categoryproduct.search_category_product')->with('search_category_product', $search_category_product);
    }
}
