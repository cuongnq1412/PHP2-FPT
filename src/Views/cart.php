    <!-- ===================== -->
    <!--    P-Header Section   -->
    <!-- ===================== -->
    <section id="page-header" class="about-header">
        <h2>#let's_talk</h2>

        <p> leave a messege , we love to hear from you! </p>
    </section>

    <!-- ===================== -->
    <!---     cart details    --->
    <!-- ===================== -->
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>


                </tr>
            </thead>
            <tbody>
                <form method="post">

                    <?php  
                $totalPriceAll = 0;
                $mergedProducts = array();
                
                foreach ($data as $product) {
                    $found = false;
                
                    foreach ($mergedProducts as &$mergedProduct) {
                        // Nếu sản phẩm đã tồn tại trong giỏ hàng
                        if ($mergedProduct['product_id'] == $product['product_id']) {
                            // Tăng giá trị của quantity lên
                            $mergedProduct['quantity'] += $product['quantity'];
                            $found = true;
                            break;
                        }
                    }
                
                    // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới vào mảng
                    if (!$found) {
                        $mergedProducts[] = $product;
                    }
                }
        
            
                // Hiển thị dữ liệu trong bảng
                foreach ($mergedProducts as $product) {

                    $subtotal = $product['price'] * $product['quantity']; // Tính giá trị con số cho từng sản phẩm
                    $totalPriceAll += $subtotal; // Cập nhật tổng giá của toàn bộ sản phẩm
                    echo '<tr>';
                    echo '<td style="display: flex; justify-content: space-evenly; align-items: center;">';
                    echo '<input style="margin-top: 15px;" type="checkbox" name="selectedProducts['.$product['product_id'].'][id]" value="' . $product['product_id'] . '"';
                        echo ' data-name="' . $product['product_name'] . '"';
                        echo ' data-price="' . $product['price'] . '"';
                        echo ' data-quantity="' . $product['quantity'] . '"';
                        echo '>'; 

                
                   
                    echo '<a style="align-items: center; padding-top: 15px;" href="'.BASE_URLC.'DeleteProductOutCart/'.$product['product_id'].'"><i class="far fa-times-circle"></i></a>';
                    echo '</td>';
                    echo '<td><img src="'.BASE_URLC.'' . $product['image_path'] . '" alt="' . $product['product_name'] . '"></td>';
                    echo '<td>' . $product['product_name'] . '</td>';
                    echo '<td class="price-column">' . $product['price'] . ' EGP</td>';
                    echo '<td><input class="quantity-input" type="number" value="' . $product['quantity'] . '" min="1"></td>';
                    echo '<td class="subtotal-column">' . $subtotal . ' EGP</td>';
                    echo '</tr>';
                }
                
                    ?>

                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script>
                    $(document).ready(function() {
                        // Lắng nghe sự kiện thay đổi trong ô input số lượng
                        $('.quantity-input').on('input', function() {
                            // Lấy giá trị số lượng mới
                            var quantity = $(this).val();

                            // Lấy giá trị giá của sản phẩm từ cột giá
                            var price = parseFloat($(this).closest('tr').find('.price-column').text());

                            // Tính toán lại tổng giá (subtotal)
                            var subtotal = quantity * price;

                            // Cập nhật giá trị trong cột tổng giá
                            $(this).closest('tr').find('.subtotal-column').text(subtotal + ' EGP');
                        });
                    });
                    </script>

            </tbody>
        </table>
    </section>


    <!-- ===================== -->
    <!--     cart add details    -->
    <!-- ===================== -->
    <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Apply Coupon</h3>
            <div>
                <input type="text" placeholder="Enter Your Coupon">
                <button class="normal">Apply</button>
            </div>
        </div>
        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td>
                        <?php echo $totalPriceAll;?>
                        EGP</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>50 EGP</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong> <?php echo $totalPriceAll;?> EGP</strong></td>
                </tr>
            </table>
            <button type="submit" class="normal" name="checkout">Proceed to checkout</button>
            </form>
        </div>
    </section>
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