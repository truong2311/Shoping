@extends('admin.admin_layout')
@section('admin_content')
	<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Thêm danh mục sản phẩm</h5>
              <div class="card">
                <div class="card-body">
                  <?php
                    $message = Session::get('message');
                    if($message){
                      echo '<span class="text-alert" style="font-weight: bold;">'.$message.'</span>';
                      Session::put('message', null);
                    }
                  ?>
                  <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                    {{ csrf_field()}}

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Tên danh mục</label>
                      <input type="text" class="form-control" data-validation="length" data-validation-length="min2" data-validation-error-msg="Điền ít nhất 2 ký tự" name="category_product_name" onkeyup="ChangeToSlug();" id="slug">
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Slug</label>
                      <input type="text" class="form-control" name="category_product_slug" id="convert_slug" placeholder="Slug">
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Mô tả danh mục</label>
                      <textarea style="resize: none;" rows="5" type="text" class="form-control" id="exampleInputEmail1" name="category_product_desc" data-validation="length" data-validation-length="min1" data-validation-error-msg="Điền ít nhất 1 ký tự"></textarea>
                    </div>

                    <div class="mb-3">
                      <label for="disabledSelect" class="form-label">Trạng thái</label>
                      <select name="category_product_status" id="disabledSelect" class="form-select">
                        <option value="0">Hiển thị</option>
                        <option value="1">Ẩn</option>
                      </select>
                    </div>
                    
                    <button type="submit" name="add_category_product" class="btn btn-primary">Thêm danh mục sản phẩm</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection