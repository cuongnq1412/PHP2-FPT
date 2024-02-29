<!DOCTYPE html>
<html lang="en">
<!-- =================================================================================== -->
<!--        Home Page   -->
<!-- =================================================================================== -->

<head>
    <script src="https://kit.fontawesome.com/bcb2c05d90.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!-- <link rel="stylesheet" href="css/all.min.css" /> -->
    <!-- Css -->
    <link rel="stylesheet" href="<?php echo BASE_URLC;?>/public/css/style.css">


</head>

<body>
    <header>
        <a href="index.html" class="logo"><img src="<?php echo BASE_URLC;?>/public/img/logo.svg" alt=""
                class="logo"></a>
        <nav>
            <ul id="navbar">
                <li><a href="<?php echo BASE_URLC;?>Home" class="active">Home</a></li>
                <li><a href="<?php echo BASE_URLC;?>Shop">Shop</a></li>
                <li><a href="<?php echo BASE_URLC;?>Blog">Blog</a></li>
                <li><a href="<?php echo BASE_URLC;?>About">About</a></li>
                <li><a href="<?php echo BASE_URLC;?>Contact">Contact</a></li>
                <li id="lg-bag">
                    <?php
                    if(isset($_SESSION['user'])) {
                    echo '<a href="'.BASE_URLC.'Cart/'.$_SESSION['user']['user_id'].'"><i class="fa fa-bag-shopping"></i></a>';
                        }else{
                        echo '
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                       
                        <div  onclick="showLoginWarning()"><i class="fa fa-bag-shopping"></i></div>';
                    }
                    ?>
                </li>
                <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                    crossorigin="anonymous"></script>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
                    crossorigin="anonymous">
                <div class="dropdown-center">
                    <!-- <img src="https://www.invert.vn/media/uploads/uploads/2022/12/03191809-2.jpeg"
                        class="dropdown-toggle rounded-circle" style="width: 30px; height: 30px;" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false" alt="Dropdown button"> -->
                    <?php 
                     if(isset($_SESSION['user'])) {
                        echo '<img src="'.BASE_URLC.''.$_SESSION['user']['profile_image'].'"
                        class="dropdown-toggle rounded-circle" style="width: 30px; height: 30px;" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false" alt="Dropdown button">';
                     }else{
                        echo '<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                       Hãy đăng nhập để trải nghiệm !
                      </button>';

                     }
                    ?>
                    <ul class="dropdown-menu">
                        <?php if(isset($_SESSION['user'])) {
                            if($_SESSION['user']['role']=='admin'){
                                echo '  <li><a class="dropdown-item" href="'.BASE_URLC.'admin/addcategory">Admin</a></li>';
    
                            }
                        echo '     <li><a class="dropdown-item" href="#">User</a></li>
                        <li><a class="dropdown-item" href="#">Order History</a></li>
                        <li><a class="dropdown-item" href="'.BASE_URLC.'Logout">Logout</a></li>
                        ';
                        }else{
                        echo '
                        <li><a class="dropdown-item" href="'.BASE_URLC.'login">Đăng Nhập</a></li>
                        <li><a class="dropdown-item" href="'.BASE_URLC.'Register">Đăng Ký</a></li>
                        ';
                        }
                        ?>


                    </ul>
                </div>



            </ul>
        </nav>
        <div id="mobile">
            <a href="./src/Views/cart.html"><i class="fa fa-bag-shopping"></i></a>
            <i id="bar" class="fas fa-outdent"></i>

        </div>
        <script>
        function showLoginWarning() {
            Swal.fire({
                position: "center",
                icon: "warning",
                title: "Vui lòng đăng nhập !",
                showConfirmButton: false,
                timer: 1500
            });
        }
        </script>
    </header>