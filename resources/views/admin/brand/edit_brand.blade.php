@extends('admin.admin_layout')
@section('admin_content')
	<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Cập nhật thương hiệu</h5>
              <div class="card">
                @foreach($edit_brand as $key => $edit)
                <div class="card-body">
                  <?php
                    $message = Session::get('message');
                    if($message){
                      echo '<span class="text-alert" style="font-weight: bold;">'.$message.'</span>';
                      Session::put('message', null);
                    }
                  ?>
                  <form role="form" method="post" action="{{URL::to('/update-brand/'.$edit->brand_id)}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field()}}

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Tên thương hiệu</label>
                      <input type="text" value="{{$edit->brand_name}}" class="form-control" name="brand_name" onkeyup="ChangeToSlug();" id="slug" data-validation-length="min2" data-validation-error-msg="Điền ít nhất 2 ký tự">
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Slug</label>
                      <input type="text" value="{{$edit->brand_slug}}" class="form-control" name="brand_slug" id="convert_slug">
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Hình ảnh</label>
                      <input type="file" class="form-control" name="brand_image" id="exampleInputEmail1">
                      <img src="{{URL::to('public/upload/brand/'.$edit->brand_image)}}" height="50" width="50">
                    </div>                    

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Mô tả thương hiệu</label>
                      <textarea style="resize: none;" rows="5" type="text" class="form-control" id="exampleInputEmail1" name="brand_desc" data-validation-length="min1" data-validation-error-msg="Điền ít nhất 1 ký tự">{{$edit->brand_desc}}</textarea>
                    </div>
                    
                    <button type="submit" name="update_brand" class="btn btn-primary">Cập nhật thương hiệu</button>
                  </form>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection