<style>
.img-property {
    width: 50px !important;

}

.inputWithIcon {
    position: relative;
}

.i {
    width: 50px;
    height: 20px;
    object-fit: cover;
}


.inputWithIcon span {
    position: absolute !important;
    right: 11px;
    bottom: 9px;
    color: #57c97d;

    transition: 0.3s;
    font-size: 14px;
}
</style>
<section>


    <div class="container">
        <main>
            <div class="py-2 text-center">


            </div>

            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Chi tiết </span>

                    </h4>

                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Tên Sản Phẩm</h6>
                                <?php 
                                 foreach ($_SESSION['selected_products'] as $productId => $value) {
                                   
                                    if (isset($products[$productId])) {
                                       echo' <small class="text-muted">' . $products[$productId] . '</small>';
                                    }else {
                                        echo "Không có sản phẩm nào được chọn.";
                                
                                }}
                                ?>
                                <small class="text-muted"></small>
                            </div>
                            <span class="text-muted fw-bold">
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Số tiền đặt cọc</h6>
                                <small class="text-muted">30%</small>
                            </div>
                            <span class="text-muted fw-bold"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Số tiền phải thanh toán</h6>
                                <small></small>
                            </div>
                            <span class="text-success fw-bold"></span>
                        </li>

                    </ul>


                    <div class=" p-2" style="display: block;">
                        <div class="house-card">
                            <div class="house__thumb">
                                <img src="./assets/images/house-03.jpeg" alt="house-03">
                                <div class="house__meta">
                                    <a href="">Biệt thự</a>
                                </div>
                            </div>
                            <div class="house__content">

                                <div class="house__content__main">
                                    <h3 class="title"><a href="#"></a>
                                    </h3>
                                    <p class="location">
                                        <span class="icon"><i class="fa-solid fa-location-dot"></i></span>
                                        <span>
                                        </span>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Thông tin thanh toán</h4>

                    <div class="alert alert-success h-full m-0	ml-2"
                        style="background-color: #5cb85c; display: <?php echo $success ?>">
                        <i class="text-white fas fa-circle-check"></i>&nbsp;<strong class="text-white">Đặt cọc thành
                            công!</strong>
                    </div>
                    <form class="needs-validation" method="post">
                        <input type="hidden" name="propertyid" value="">
                        <input type="hidden" name="customerid" value="<?php echo  $_SESSION['user']['user_id'] ?>">
                        <input type="hidden" name="sellerid" value="">
                        <input type="hidden" name="transaction_type" value="">
                        <input type="hidden" name="payment" value="">

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="firstName" name="fullname" placeholder=""
                                    value="<?php echo  $_SESSION['user']['user_username'] ?> " required>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">UserName</label>
                                <input type="text" class="form-control" id="lastName" placeholder=""
                                    value="<?php echo  $_SESSION['user']['user_name'] ?> " name="username" required
                                    readonly>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>




                            <div class="col-12">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address_user" value=""
                                    placeholder="" required>
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>







                        </div>

                        <hr class="my-4">





                        <div class="row gy-3">
                            <div class="col-md-6">

                                <label for="cc-name" class="form-label">Tên chủ thẻ</label>
                                <div class="inputWithIcon">
                                    <input type="text" class="form-control" id="cc-name" placeholder="" required>


                                    <span><i class="fa-solid fa-user"></i></span>
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <label for="cc-number" class="form-label">Mã số thẻ</label>
                                <div class="inputWithIcon">
                                    <input type="text" class="form-control" id="cc-number" placeholder="" required>
                                    <span class="">
                                        <img class="i"
                                            src="https://www.freepnglogos.com/uploads/mastercard-png/mastercard-logo-logok-15.png"
                                            alt="" /></span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-expiration" class="form-label">Hết hạn</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="zip" class="form-label">Zip</label>
                                <input type="text" class="form-control" id="zip" placeholder="" required>
                                <div class="invalid-feedback">
                                    Zip code required.
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <input class="w-100 btn btn-primary btn-lg" type="submit">
                    </form>
                </div>
            </div>
        </main>


    </div>



</section>