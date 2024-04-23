<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_brand(){
        $this -> AuthLogin();
    	return view('admin.brand.add_brand');

    }

    public function all_brand(Request $request){
        $this -> AuthLogin();
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by == 'all'){
                $all_brand = DB::table('tbl_brand')->orderby('brand_id', 'desc')->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'az') {

                $all_brand = DB::table('tbl_brand')->orderby('brand_name', 'asc')->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'za') {
                $all_brand = DB::table('tbl_brand')->orderby('brand_name', 'desc')->paginate(5)->appends(request()->query());
            }

        }else{
            $all_brand = DB::table('tbl_brand')->orderby('brand_id', 'desc')->paginate(5);
        }

    	return view('admin.brand.all_brand')->with('all_brand', $all_brand);
    }

    public function save_brand(Request $request){
        $this -> AuthLogin();

        $brand_name = $request -> brand_name;

        $result = DB::table('tbl_brand')->where('brand_name', $brand_name)->first();

    	$data = array();
    	$data['brand_name'] = $brand_name;
    	$data['brand_slug'] = $request->brand_slug;
    	$data['brand_desc'] = $request->brand_desc;
    	$data['brand_status'] = $request->brand_status;

        $get_image = $request->file('brand_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99). '.' .$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/brand', $new_image);
            $data['brand_image'] = $new_image;
        } 

    	if (isset($result)) {
    		Session::put('message', 'Thương hiệu đã có!');
    		return Redirect::to('add-brand');
    	} else {
            $data['brand_image'] = '';
    		DB::table('tbl_brand')->insert($data);

    		Session::put('message', 'Thêm thương hiệu thành công!');

    		return Redirect::to('all-brand');
    	}
    }

    public function unactive_brand($brand_id){
        $this -> AuthLogin();
    	DB::table('tbl_brand')->where('brand_id', $brand_id)->update(['brand_status'=>1]);
    	Session::put('message','Ẩn thương hiệu thành công!');
    	return Redirect::to('all-brand');
    }

    public function active_brand($brand_id){
        $this -> AuthLogin();
    	DB::table('tbl_brand')->where('brand_id', $brand_id)->update(['brand_status'=>0]);
    	Session::put('message','Hiển thị thương hiệu thành công!');
    	return Redirect::to('all-brand');
    }

    public function edit_brand($brand_id){
        $this -> AuthLogin();
    	$edit_brand = DB::table('tbl_brand')->where('brand_id', $brand_id)->get();

    	return view('admin.brand.edit_brand')->with('edit_brand', $edit_brand);
    }

    public function update_brand(Request $request, $brand_id){
        $this -> AuthLogin();

        $brand_name = $request -> brand_name;

        $result = DB::table('tbl_brand')->where('brand_name', $brand_name)->first();

    	$data = array();
    	$data['brand_name'] = $request->brand_name;
    	$data['brand_slug'] = $request->brand_slug;
    	$data['brand_desc'] = $request->brand_desc;

        $get_image = $request->file('brand_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99). '.' .$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/brand', $new_image);
            $data['brand_image'] = $new_image;
            DB::table('tbl_brand')->where('brand_id', $brand_id)->update($data);;
            Session::put('message','Cập nhật thương hiệu thành công!');
            return Redirect::to('all-brand');
        } 
        $data['brand_image'] = '';

    	DB::table('tbl_brand')->where('brand_id', $brand_id)->update($data);

    	Session::put('message', 'Cập nhật thương hiệu thành công!');

    	return Redirect::to('all-brand');
    }

/*    public function delete_brand($brand_id){
        $this -> AuthLogin();
    	DB::table('tbl_brand')->where('brand_id', $brand_id)->delete();

    	Session::put('message', 'Xoá thương hiệu thành công!');

    	return Redirect::to('all-brand');
    }*/

    public function delete_brand($brand_id){
        $this -> AuthLogin();
        $all_brand = DB::table('tbl_product')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('tbl_product.brand_id', $brand_id)->exists();

        if($all_brand){
            Session::put('message','Thương hiệu đang được liên kết, Xoá không thành công!');
            return Redirect::to('all-brand');
        }else{
            DB::table('tbl_brand')->where('brand_id', $brand_id)->delete();
            Session::put('message','Xoá thương hiệu thành công!');
            return Redirect::to('all-brand');
        }

    }

    public function search_brand(Request $request){
        $this -> AuthLogin();
        $keywords = $request->keywords_submits;

/*        $all_category = DB::table('tbl_category_coueses')->paginate(5);
*/        
        $search_brand = DB::table('tbl_brand')->where('brand_name', 'like', '%'.$keywords.'%')->orderby('tbl_brand.brand_id', 'desc')->get();

       return view('admin.brand.search_brand')->with('search_brand', $search_brand);
    }
}
