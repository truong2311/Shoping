@extends('admin.admin_layout')
@section('admin_content')
	<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Cập nhật danh mục sản phẩm</h5>
              <div class="card">
                @foreach($edit_category_product as $key => $edit)
                <div class="card-body">
                  <?php
                    $message = Session::get('message');
                    if($message){
                      echo '<span class="text-alert" style="font-weight: bold;">'.$message.'</span>';
                      Session::put('message', null);
                    }
                  ?>
                  <form role="form" method="post" action="{{URL::to('/update-category-product/'.$edit->category_product_id)}}" method="post">
                    {{ csrf_field()}}

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Tên danh mục</label>
                      <input type="text" value="{{$edit->category_product_name}}" class="form-control" name="category_product_name" onkeyup="ChangeToSlug();" id="slug" data-validation-length="min2" data-validation-error-msg="Điền ít nhất 2 ký tự">
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Slug</label>
                      <input type="text" value="{{$edit->category_product_slug}}" class="form-control" name="category_product_slug" id="convert_slug">
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Mô tả danh mục</label>
                      <textarea style="resize: none;" rows="5" type="text" class="form-control" id="exampleInputEmail1" name="category_product_desc" data-validation-length="min1" data-validation-error-msg="Điền ít nhất 1 ký tự">{{$edit->category_product_name}}</textarea>
                    </div>
                    
                    <button type="submit" name="update_category_product" class="btn btn-primary">Cập nhật danh mục sản phẩm</button>
                  </form>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection