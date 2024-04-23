@extends('admin.admin_layout')
@section('admin_content')
	<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Thêm thương hiệu</h5>
              <div class="card">
                <div class="card-body">
                  <?php
                    $message = Session::get('message');
                    if($message){
                      echo '<span class="text-alert" style="font-weight: bold;">'.$message.'</span>';
                      Session::put('message', null);
                    }
                  ?>
                  <form role="form" action="{{URL::to('/save-brand')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field()}}

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Tên thương hiệu</label>
                      <input type="text" class="form-control" data-validation="length" data-validation-length="min2" data-validation-error-msg="Điền ít nhất 2 ký tự" name="brand_name" onkeyup="ChangeToSlug();" id="slug">
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Slug</label>
                      <input type="text" class="form-control" name="brand_slug" id="convert_slug" placeholder="Slug">
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Hình ảnh</label>
                      <input type="file" class="form-control" name="brand_image" id="exampleInputEmail1">
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Mô tả thương hiệu</label>
                      <textarea style="resize: none;" rows="5" type="text" class="form-control" id="exampleInputEmail1" name="brand_desc" data-validation="length" data-validation-length="min1" data-validation-error-msg="Điền ít nhất 1 ký tự"></textarea>
                    </div>

                    <div class="mb-3">
                      <label for="disabledSelect" class="form-label">Trạng thái</label>
                      <select name="brand_status" id="disabledSelect" class="form-select">
                        <option value="0">Hiển thị</option>
                        <option value="1">Ẩn</option>
                      </select>
                    </div>
                    
                    <button type="submit" name="add_brand" class="btn btn-primary">Thêm thương hiệu</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection