@extends('welcome')
@section('content')
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <?php
                $content = Cart::content();
                ?>
                <table class="table table-bordered text-center mb-0" style="margin-top: 15px;">
                    <?php
                      $message = Session::get('message');
                      if($message){
                        echo '<span class="text-alert" style="font-weight: bold;">'.$message.'</span>';
                        Session::put('message', null);
                      }
                    ?>
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá tiền</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Xoá</th>
                        </tr>
                    </thead>
                    @foreach($content as $key => $product)
                    <tbody class="align-middle">
                        <tr>
                            <td class="align-middle" style="text-align: left;"><img src="{{URL::to('public/upload/product/'.$product->options->image)}}" alt="" width="50">{{$product->name}}</td>
                            <td class="align-middle">{{number_format($product->price)}} VND</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <form action="{{URL::to('/update-cart')}}" method="post">
                                        {{csrf_field()}}

                                        <input type="text" class="form-control form-control-sm bg-secondary text-center" name="quantity_cart" value="{{$product->qty}}">
                                        <input type="hidden" value="{{$product->rowId}}" name="rowId_cart">
                                        <input type="submit" value="Cập nhật" class="btn btn-primary" name="update_qty">

                                    </form>
                                </div>
                            </td>
                            <td class="align-middle">
                                <?php
                                $subtotal = $product->price * $product->qty;
                                echo number_format($subtotal). ' '.'VND';
                                ?>
                            </td>
                            <td class="align-middle">
                                <a onclick="return confirm('Bạn chắc muốn xoá danh mục sản phẩm này?')" class="btn btn-sm btn-primary" href="{{URL::to('/delete-cart/'.$product->rowId)}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Tổng</h6>
                            <h6 class="font-weight-medium">{{Cart::subtotal()}} VND</h6>
                        </div>
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Thuế</h6>
                            <h6 class="font-weight-medium">{{Cart::tax()}} VND</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Phí vận chuyển</h6>
                            <h6 class="font-weight-medium">Free</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Tổng tiền</h5>
                            <h5 class="font-weight-bold">{{Cart::total()}} VND</h5>
                        </div>
                        <button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection