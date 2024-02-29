<!-- ===================== -->
<!--    P-Header Section   -->
<!-- ===================== -->

<section id="page-header">
    <h2>#shopfromhome</h2>

    <p>Save more with coupons & up to 70% off!</p>
</section>

<!-- ===================== -->
<!--    Products Section   -->
<!-- ===================== -->
<section id="product1" class="section-p1">
    <div class="pro-container">
        <?php
         if (isset($data) && is_array($data)) {
            // Lấy ra chỉ 20 sản phẩm đầu tiên
            $first_20_products = array_slice($data, 0, 20);
            foreach ($first_20_products as $product) {
                echo '
        <div class="pro" onclick="window.location.href=\'Sproduct/'. $product['product_id'] . '\';">
            <img src="' . $product['image_path'] . '" alt="" />
            <div class="des">
                <span>'.$product['manufacturer'].'</span>
                <h5>'.$product['product_name'].'</h5>
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <h4>'.intval($product['price']).'  EGP</h4>
                <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
            </div>
        </div>';
            }
        }
        ?>
    </div>
</section>
<!-- ===================== -->
<!--    Paginition Section   -->
<!-- ===================== -->
<section id="paginition" class="section-p1">
    <a href="#">1</a>
    <a href="#">2</a>
    <a href="#"><i class="fa-solid fa-arrow-right"></i></a>
</section>
<!-- ===================== -->
<!--   Newsletter    -->
<!-- ===================== -->
<section id="newsletter" class="section-p1 section-m1">
    <div class="newstext">
        <h4>Sign Up For Newsletters</h4>
        <p>
            Get E-mail updates about our latest shop and
            <span>special offers.</span>
        </p>
    </div>
    <div class="form">
        <input type="text" placeholder="Your email adress" />
        <button class="normal">Sign Up</button>
    </div>
</section>

<!-- ===================== -->
<!-----       Footer -------->
<!-- ===================== -->