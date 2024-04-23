@extends('admin.admin_layout')
@section('admin_content')
    <div class="d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Danh sách sản phẩm</h5>
                <div class="row w3-res-tb">

                  <div class="col-sm-5 m-b-xs">
                    {{csrf_field()}}
                    <select class="input-sm form-control w-sm inline v-middle" name="sort" id="sort">
                      <option value="">Sắp xếp</option>
                      <option value="{{Request::url()}}?sort_by=all">Hiển thị tất cả</option>
                      <option value="{{Request::url()}}?sort_by=az">Tên từ A đến Z</option>
                      <option value="{{Request::url()}}?sort_by=za">Tên từ Z đến A</option>
                    </select>
                  </div>

                  <div class="col-sm-3" style="margin-left:366px;">
                    <form action="{{URL::to('/search-product')}}" method="POST">
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
                        <th>Tên sản phẩm</th>
                        <th>Slug</th>
                        <th>Danh mục sản phẩm</th>
                        <th>Thương hiệu</th>
                        <th>Hình ảnh</th>
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
                        <th>Ẩn - Hiển thị</th>

                        <th style="width:30px;"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($all_product as $key => $product)
                      <tr>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->product_slug}}</td>
                        <td>{{$product->category_product_name}}</td>
                        <td>{{$product->brand_name}}</td>
                        <td><img src="public/upload/product/{{$product->product_image}}" height="50" width="50"> </td>
                        <td>{{$product->product_number}} cái</td>
                        <td>{{number_format($product->product_price)}} VND</td>

                        <td><span class="text-ellipsis">
                          <?php
                            if($product->product_status==0){
                          ?>
                            <a href="{{URL::to('/unactive-product/'.$product->product_id)}}"><span class="fa-toggle-styling fa fa-toggle-on"></sapn></a>
                          <?php
                            }else{
                          ?>
                            <a href="{{URL::to('/active-product/'.$product->product_id)}}"><span class="fa-toggle-styling fa fa-toggle-off"></sapn></a>
                          <?php
                          }
                          ?>
                        </span></td>

                        <td>
                          <a href="{{URL::to('/edit-product/'.$product->product_id)}}" style="font-size: 20px;" ui-toggle-class="">
                            <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                          <a onclick="return confirm('Bạn chắc muốn xoá sản phẩm này?')" href="{{URL::to('/delete-product/'.$product->product_id)}}"  ui-toggle-class="" style="font-size: 22px;">
                            <i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <footer class="panel-footer">
                  <div class="row" style="padding-top: 20px; padding-left: 500px;">
                    <div class="" >                
                        {!!$all_product->links('pagination::bootstrap-4')!!}
                    </div>
                  </div>
                </footer>
            </div>
        </div>
    </div>
@endsection