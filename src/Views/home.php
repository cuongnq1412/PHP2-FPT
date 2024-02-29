<!-- ===================== -->
<!--    Hero Section   -->
<!-- ===================== -->

<section id="hero">
    <h4>Trade-in-offer</h4>
    <h2>Super value deals</h2>
    <h1>On all products</h1>
    <p>Save more with coupons & up to 70% off!</p>
    <button>Shop Now</button>
</section>
<!-- ===================== -->
<!--    Features Section   -->
<!-- ===================== -->
<section id="feature" class="section-p1">
    <div class="fe-box">
        <img src="./public/img/features/f1.png" alt="">
        <h6>Free Shipping</h6>
    </div>
    <div class="fe-box">
        <img src="./public/img/features/f2.png" alt="">
        <h6>Online Order</h6>
    </div>
    <div class="fe-box">
        <img src="./public/img/features/f3.png" alt="">
        <h6>Save Money</h6>
    </div>
    <div class="fe-box">
        <img src="./public/img/features/f4.png" alt="">
        <h6>Promotions</h6>
    </div>
    <div class="fe-box">
        <img src="./public/img/features/f5.png" alt="">
        <h6>xHsrcy Sell</h6>
    </div>
    <div class="fe-box">
        <img src="./public/img/features/f6.png" alt="">
        <h6>F24/7 Support</h6>
    </div>
</section>
<!-- ===================== -->
<!--    Products Section   -->
<!-- ===================== -->
<section id="product1" class="section-p1">
    <h2>Featured Products</h2>
    <p class="heading">Summer Collection New Modern Design</p>
    <div class="pro-container">
        <?php
         if (isset($data) && is_array($data)) {
            // Lấy ra chỉ 20 sản phẩm đầu tiên
            $first_8_products = array_slice($data, 0, 8);
            foreach ($first_8_products as $product) {
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
<!--    Products Section   -->
<!-- ===================== -->
<section id="banner" class="section-m1">
    <h4>Repair Services</h4>
    <h2>Up to <span>70% off</span> - All T-shirts & Accessories</h2>
    <button class="normal">Explore More</button>
</section>
<!-- ===================== -->
<!--    New Arrivals   -->
<!-- ===================== -->
<section id="product1" class="section-p1">
    <h2>New Arrivals</h2>
    <p class="heading">Summer Collection New Modern Design</p>
    <div class="pro-container">
        <?php
         if (isset($data) && is_array($data)) {
            // Lấy ra chỉ 20 sản phẩm đầu tiên
            $first_10_products = array_slice($data, 2, 8);
            foreach ($first_10_products as $product) {
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
    </div>
</section>
<!-- ===================== -->
<!--    Banner 2   -->
<!-- ===================== -->
<section id="sm-banner" class="section-p1">
    <div class="banner-box">
        <div class="overlay"></div>
        <div class="banner-content content">
            <h4>Crazy Deals</h4>
            <h2>Buy 1 Get 1 Free</h2>
            <span>The best classic dress is on sale at cara</span>
            <button class="white">Learn More</button>
        </div>
    </div>
    <div class="banner-box">
        <div class="overlay"></div>
        <div class="banner-content content">
            <h4>Spring/Summer </h4>
            <h2>Upcoming Season</h2>
            <span>The best classic dress is on sale at cara</span>
            <button class="white">Collection</button>
        </div>
    </div>
</section>
<section id="banner3" class="section-p1">
    <div class="banner-box">
        <div class="overlay"></div>
        <div class="content">
            <h2> Seasonal Sale</h2>
            <h3>Winter Collection 50% Off</h3>
        </div>

    </div>
    <div class="banner-box">
        <div class="overlay"></div>
        <div class="content">
            <h2> Elegant Collection</h2>
            <h3>Elegant collection with special prices</h3>
        </div>
    </div>
    <div class="banner-box">
        <div class="overlay"></div>
        <div class="content">
            <h2>New Women Collection</h2>
            <h3>New Summer Collection For Women </h3>
        </div>
    </div>
</section>
<!-- ===================== -->
<!--   Newsletter    -->
<!-- ===================== -->
<section id="newsletter" class="section-p1 section-m1">
    <div class="newstext">
        <h4>Sign Up For Newsletters</h4>
        <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
    </div>
    <div class="form">
        <input type="text" placeholder="Your email adress">
        <button class="normal">Sign Up</button>
    </div>
</section>
<!-- ===================== -->
<!-----       Footer -------->
<!-- ===================== -->