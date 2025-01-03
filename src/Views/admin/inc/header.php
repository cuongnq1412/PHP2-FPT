<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- gom link -->
    <script src="https://kit.fontawesome.com/aa64dc9752.js" crossorigin="anonymous"></script>
    <!-- gom link -->

    <title>SB Admin 2 - Other Utilities</title>

    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />


    <!-- Custom styles for this template-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
    <link href="<?php echo $url;?>public/css/product.css" rel="stylesheet" />
    <script src="<?php echo $url;?>public/js/alert.js"></script>
    <link href="<?php echo $url;?>public/css/sb-admin-2.min.css" rel="stylesheet" />


    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0" />

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">Interface</div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <!-- <i class="fas fa-fw fa-cog"></i> -->
                    <i class="fa-solid fa-star"></i>
                    <span>Sản phẩm</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Lựa chọn sản phẩm :</h6>
                        <a class="collapse-item" href="<?php echo BASE_URL;?>/admin/addproduct">Thêm sản phẩm</a>
                        <a class="collapse-item" href="<?php echo BASE_URL;?>/admin/listproducts">Tất cả sản phẩm</a>
                        <a class="collapse-item" href="<?php echo BASE_URL;?>/admin/addcategory">Danh mục sản phẩm</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsenew"
                    aria-expanded="true" aria-controls="collapsenew">
                    <i class="fa-solid fa-pen"></i>

                    <span>Bài viết</span>
                </a>
                <div id="collapsenew" class="collapse" aria-labelledby="headingnew" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Lựa chọn bài viết :</h6>
                        <a class="collapse-item" href="<?php echo BASE_URL;?>/admin/listpost">Tất cả bài viết</a>
                        <a class="collapse-item" href="<?php echo BASE_URL;?>/admin/addpost">Thêm bài viết</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecart"
                    aria-expanded="true" aria-controls="collapsecart">
                    <i class="fa-solid fa-cart-shopping"></i>

                    <span>Đơn hàng</span>
                </a>
                <div id="collapsecart" class="collapse" aria-labelledby="headingcart" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Lựa chọn đơn hàng :</h6>
                        <a class="collapse-item" href="#">Đơn hàng hoàn thành</a>
                        <a class="collapse-item" href="#">Đơn hàng chưa duyệt
                        </a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL;?>/admin/listuser">
                    <i class="fa-solid fa-user"></i>
                    <span>Người dùng</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block" />

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $_SESSION['user']['user_username']; ?>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo BASE_URL.$_SESSION['user']['profile_image'];?>" />
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item"
                                    href="<?php echo BASE_URL;?>/admin/profile/<?php echo $_SESSION['user']['user_id']?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>


                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo BASE_URLC;?>Logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <!-- <div class="container-fluid"> -->
                <div class="w-full">

                    <div class="flex justify-center xl:w-11/13">
                        <div class="w-11/12 xl:w-11/13 mt-4 mb-8">
                            <div class="w-full bg-white rounded-lg min-h-screen">
                                <div class="w-full flex justify-center h-auto">