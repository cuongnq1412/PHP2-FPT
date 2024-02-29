<!-- ===================== -->
<!--   Prodetails Section    -->
<!-- ===================== -->
<section id="prodetails" class="section-p1">
    <div class="single-pro-image">
        <img src="<?php echo BASE_URLC. $images[0];?>" width="100%" id="MainImg" alt="" />

        <div class="small-img-group">
            <?php if (isset($images) && is_array($images)) {
                    foreach ($images as $img) {
                      echo'
            <div class="small-img-col">
                <img src="'.BASE_URLC.''.$img.'" width="100%" class="small-img" alt="" />
            </div>';
                    }}
            ?>

        </div>
    </div>

    <div class="single-pro-details">
        <h6>Home / Shirt</h6>
        <h4><?php echo $product['product_name']; ?></h4>
        <h2><?php echo intval($product['price']); ?> EGP</h2>
        <form method="POST">

            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
            <input type="hidden" name="user_id"
                value="<?php echo isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : ''; ?>">

            <select name="size">
                <option value="S">Small</option>
                <option value="M">Medium</option>
                <option value="L">Large</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
            </select>
            <input type="number" name="quantity" value="1" />


            <?php
                // Kiểm tra xem session 'user' có tồn tại không
                if(isset($_SESSION['user'])) {
                    // Nếu session tồn tại, hiển thị nút Add To Cart
                    echo '<button type="submit" name="submit" class="normal">Add To Cart</button>';
                } else {
                    // Nếu không, vô hiệu hóa nút Add To Cart
                    echo '<button type="submit" name="submit"   class="normal" disabled >Add To Cart</button>';
                }
            ?>
        </form>
        <h4>Product Details</h4>
        <span><?php echo $product['product_details']; ?></span>
    </div>
</section>

<section id="product1" class="section-p1">
    <h2>Featured Products</h2>
    <p class="heading">Summer Collection New Modern Design</p>
    <div class="pro-container">
        <?php
         if (isset($data) && is_array($data)) {
            // Lấy ra chỉ 20 sản phẩm đầu tiên
            $first_20_products = array_slice($data, 0, 4);
            foreach ($first_20_products as $product) {
                echo '
        <div class="pro" onclick="window.location.href=\''.BASE_URLC.'Sproduct/'. $product['product_id'] . '\';">
            <img src="'.BASE_URLC.'' . $product['image_path'] . '" alt="" />
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

<!-- ===================== -->
<!-----     Replacing images  -------->
<!-- ===================== -->

<script>
var MainImg = document.getElementById("MainImg");
var smallimg = document.getElementsByClassName("small-img");

smallimg[0].onclick = function() {
    MainImg.src = smallimg[0].src;
};
smallimg[1].onclick = function() {
    MainImg.src = smallimg[1].src;
};

smallimg[2].onclick = function() {
    MainImg.src = smallimg[2].src;
};

smallimg[3].onclick = function() {
    MainImg.src = smallimg[3].src;
};
</script>
<!-- ============================================================================================================ -->
<script src="/public/js/script.js"></script>
</body>

</html>