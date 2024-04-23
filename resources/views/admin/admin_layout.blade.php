<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TL-Shop</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('public/backend/images/logos/favicon.png')}}" />
  <link rel="stylesheet" href="{{asset('public/backend/css/styles.min.css')}}" />
  <link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
  <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 

</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <p style="text-align: center; font-size: 25px; font-weight: bold; margin-bottom: 2px; margin-left: 60px;">TL-Shop</p>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav" style="height: 350px;">
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{URL::to('/dashboard')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
              
            <li class="sidebar-item dropdown">
              <a class="sidebar-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Danh mục sản phẩm</span>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                <div class="message-body">
                  <a href="{{URL::to('/add-category-product')}}" class="d-flex dropdown-item">
                    <p class="mb-0 fs-3">Thêm danh mục</p>
                  </a>
                  <a href="{{URL::to('/all-category-product')}}" class="d-flex dropdown-item">
                    <p class="mb-0 fs-3">Danh sách danh mục</p>
                  </a>
                </div>
              </div>
            </li>

            <li class="sidebar-item dropdown">
              <a class="sidebar-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Thương hiệu</span>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                <div class="message-body">
                  <a href="{{URL::to('/add-brand')}}" class="d-flex dropdown-item">
                    <p class="mb-0 fs-3">Thêm thương hiệu</p>
                  </a>
                  <a href="{{URL::to('/all-brand')}}" class="d-flex dropdown-item">
                    <p class="mb-0 fs-3">Danh sách thương hiệu</p>
                  </a>
                </div>
              </div>
            </li>

            <li class="sidebar-item dropdown">
              <a class="sidebar-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Sản phẩm</span>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                <div class="message-body">
                  <a href="{{URL::to('/add-product')}}" class="d-flex dropdown-item">
                    <p class="mb-0 fs-3">Thêm sản phẩm</p>
                  </a>
                  <a href="{{URL::to('/all-product')}}" class="d-flex dropdown-item">
                    <p class="mb-0 fs-3">Danh sách sản phẩm</p>
                  </a>
                </div>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">

            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                                  <span class="username" style="font-size: 20px; margin-right: 10px; font-weight: bold" >
                  <?php
          $name = Session::get('admin_name');
          if($name){
          echo $name;
          }
          ?>


                </span>
                  <img src="{{asset('public/backend/images/profile/user-1.jpg')}}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="{{URL::to('/log-out')}}" class="btn btn-outline-primary mx-3 mt-2 d-block">Đăng xuất</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <div class="container-fluid">
        @yield('admin_content')
      </div>
    </div>
  </div>
  <script src="{{asset('public/backend/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('public/backend/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('public/backend/js/sidebarmenu.js')}}"></script>
  <script src="{{asset('public/backend/js/app.min.js')}}"></script>
  <script src="{{asset('public/backend/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{asset('public/backend/libs/simplebar/dist/simplebar.js')}}"></script>
  <script src="{{asset('public/backend/js/dashboard.js')}}"></script>
  <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>


<script type="text/javascript">
    CKEDITOR.replace('abc');
    CKEDITOR.replace('ckeditor1', {
        
       filebrowserImageUploadUrl : "{{url('uploads-ckeditor?_token='.csrf_token())}}", 
/*        filebrowserBrowseUrl : "{{url('file-browser?_token='.csrf_token())}}",
*/        filebrowserUploadMethod: 'form'
    });

</script>

<script type="text/javascript">
 
    function ChangeToSlug()
        {
            var slug;
         
            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
</script>

  <script type="text/javascript">
    $(document).ready(function(){

        $('#sort').on('change', function(){

            var url = $(this).val();
            if(url){
                window.location = url;
            }

            return false;
        });
    });
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script type="text/javascript">
    $.validate({

    });

</script>

</body>

</html>