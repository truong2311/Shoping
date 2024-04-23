@extends('admin.admin_layout')
@section('admin_content')
	<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Cập nhật sản phẩm</h5>
              <div class="card">
                @foreach($edit_product as $key => $edit)
                <div class="card-body">
                  <?php
                    $message = Session::get('message');
                    if($message){
                      echo '<span class="text-alert" style="font-weight: bold;">'.$message.'</span>';
                      Session::put('message', null);
                    }
                  ?>
                  <form role="form" action="{{URL::to('/update-product/'.$edit->product_id)}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field()}}

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Tên sản phẩm</label>
                      <input type="text" class="form-control" data-validation="length" data-validation-length="min2" data-validation-error-msg="Điền ít nhất 2 ký tự" name="product_name" onkeyup="ChangeToSlug();" id="slug" value="{{$edit->product_name}}">
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Slug</label>
                      <input type="text" class="form-control" name="product_slug" id="convert_slug" value="{{$edit->product_slug}}">
                    </div>

                    <div class="mb-3">
                      <label for="disabledSelect" class="form-label">Danh mục sản phẩm</label>
                      <select name="category_product_id" id="disabledSelect" class="form-select">
                        @foreach($category_product as $key => $category)
                          @if($category->category_product_id==$edit->category_product_id)
                          <option selected value="{{$category->category_product_id}}">{{$category->category_product_name}}</option>
                          @else
                          <option selected value="{{$category->category_product_id}}">{{$category->category_product_name}}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>

                    <div class="mb-3">
                      <label for="disabledSelect" class="form-label">Thương hiệu</label>               
                      <select name="brand_id" id="disabledSelect" class="form-select">
                        @foreach($brand as $key => $brand)
                          @if($brand->brand_id==$edit->brand_id)
                          <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                          @else
                          <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                          @endif
                        @endforeach
                      </select> 
                    </div>
                    
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Mô tả sản phẩm</label>
                      <textarea style="resize: none;" rows="5" type="text" class="form-control" id="exampleInputEmail1" name="product_desc" data-validation="length" data-validation-length="min1" data-validation-error-msg="Điền ít nhất 1 ký tự">{{$edit->product_desc}}</textarea>
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Mô tả nội dung</label>
                      <textarea style="resize: none;" type="text" class="form-control" id="abc" name="product_content" data-validation="length" data-validation-length="min1" data-validation-error-msg="Điền ít nhất 1 ký tự">{{$edit->product_content}}</textarea>
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Hình ảnh</label>
                      <input type="file" class="form-control" name="product_image" id="exampleInputEmail1">
                      <img src="{{URL::to('public/upload/product/'.$edit->product_image)}}" height="50" width="50">
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Số lượng</label>
                      <input type="text" class="form-control" data-validation="number" data-validation-error-msg="Điền kiểu số" name="product_number" id="exampleInputEmail1" value="{{$edit->product_number}}">
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Giá tiền</label>
                      <input type="text" class="form-control" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" name="product_price" id="exampleInputEmail1" value="{{$edit->product_price}}">
                    </div>

                    <button type="submit" name="edit_product" class="btn btn-primary">Cập nhật sản phẩm</button>
                  </form>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection