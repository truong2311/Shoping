@extends('admin.admin_layout')
@section('admin_content')
    <div class="d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Danh sách danh mục sản phẩm</h5>
                <div class="row w3-res-tb">
                  <div class="col-sm-3" style="margin-left:840px;">
                    <form action="{{URL::to('/search-category-product')}}" method="POST">
                      {{csrf_field()}}
                    <div class="input-group">
                      <input type="text" class="form-control" name="keywords_submits" placeholder="Nhập thông tin">
                      <span class="input-group-btn" style="margin-left: 5px;">
                        <button class="btn btn-primary" name="search_items" type="submit">Tìm kiếm</button>
                      </span>
                    </div>
                    </form>

                  </div>
                </div>
                <div class="table-responsive">
                <?php
                  $message = Session::get('message');
                  if($message){
                    echo '<span class="text-alert" style="font-weight: bold;">'.$message.'</span>';
                    Session::put('message', null);
                  }
                ?>
                  <table class="table text-nowrap mb-0 align-middle">
			             <thead>
                      <tr>
                        <th>Tên danh mục</th>
                        <th>Slug</th>
                        <th>Mô tả</th>
                        <th>Ẩn - Hiển thị</th>

                        <th style="width:30px;"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($search_category_product as $key => $cate_pro)
                      <tr>
                        <td>{{$cate_pro->category_product_name}}</td>
                        <td>{{$cate_pro->category_product_slug}}</td>
                        <td>{{$cate_pro->category_product_desc}}</td>

                        <td><span class="text-ellipsis">
                          <?php
                            if($cate_pro->category_product_status==0){
                          ?>
                            <a href="{{URL::to('/unactive-category-product/'.$cate_pro->category_product_id)}}"><span class="fa-toggle-styling fa fa-toggle-on"></sapn></a>
                          <?php
                            }else{
                          ?>
                            <a href="{{URL::to('/active-category-product/'.$cate_pro->category_product_id)}}"><span class="fa-toggle-styling fa fa-toggle-off"></sapn></a>
                          <?php
                          }
                          ?>
                        </span></td>

                        <td>
                          <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_product_id)}}" style="font-size: 20px;" ui-toggle-class="">
                            <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                          <a onclick="return confirm('Bạn chắc muốn xoá danh mục sản phẩm này?')" href="{{URL::to('/delete-category-product/'.$cate_pro->category_product_id)}}"  ui-toggle-class="" style="font-size: 22px;">
                            <i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
@endsection