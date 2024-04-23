@extends('admin.admin_layout')
@section('admin_content')
	<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Thêm sản phẩm</h5>
              <div class="card">
                <div class="card-body">
                  <?php
                    $message = Session::get('message');
                    if($message){
                      echo '<span class="text-alert" style="font-weight: bold;">'.$message.'</span>';
                      Session::put('message', null);
                    }
                  ?>
                  <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field()}}

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Tên sản phẩm</label>
                      <input type="text" class="form-control" data-validation="length" data-validation-length="min2" data-validation-error-msg="Điền ít nhất 2 ký tự" name="product_name" onkeyup="ChangeToSlug();" id="slug">
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Slug</label>
                      <input type="text" class="form-control" name="product_slug" id="convert_slug">
                    </div>

                    <div class="mb-3">
                      <label for="disabledSelect" class="form-label">Danh mục sản phẩm</label>
                      <select name="category_product_id" id="disabledSelect" class="form-select">
                        @foreach($category_product as $key => $category)
                        <option value="{{$category->category_product_id}}">{{$category->category_product_name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="mb-3">
                      <label for="disabledSelect" class="form-label">Thương hiệu</label>               
                      <select name="brand_id" id="disabledSelect" class="form-select">
                        @foreach($brand as $key => $brand)
                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                        @endforeach
                      </select> 
                    </div>
                    
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Mô tả sản phẩm</label>
                      <textarea style="resize: none;" rows="5" type="text" class="form-control" id="exampleInputEmail1" name="product_desc" data-validation="length" data-validation-length="min1" data-validation-error-msg="Điền ít nhất 1 ký tự"></textarea>
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Mô tả nội dung</label>
                      <textarea style="resize: none;" type="text" class="form-control" id="abc" name="product_content" data-validation="length" data-validation-length="min1" data-validation-error-msg="Điền ít nhất 1 ký tự"></textarea>
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Hình ảnh</label>
                      <input type="file" class="form-control" name="product_image" id="exampleInputEmail1">
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Số lượng</label>
                      <input type="text" class="form-control" data-validation="number" data-validation-error-msg="Điền kiểu số" name="product_number" id="exampleInputEmail1">
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Giá tiền</label>
                      <input type="text" class="form-control" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" name="product_price" id="exampleInputEmail1">
                    </div>

                    <div class="mb-3">
                      <label for="disabledSelect" class="form-label">Trạng thái</label>
                      <select name="product_status" id="disabledSelect" class="form-select">
                        <option value="0">Hiển thị</option>
                        <option value="1">Ẩn</option>
                      </select>
                    </div>
                    
                    <button type="submit" name="add_product" class="btn btn-primary">Thêm sản phẩm</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection