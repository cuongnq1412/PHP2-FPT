<div class="w-11/12">
    <p class="text-[#0957CB] font-semibold  text-2xl py-4">Danh sách sản phẩm</p>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm </th>
                <th>Mô tả</th>
                <th>Số lượng</th>
                <th>Danh mục</th>
                <th>Hình ảnh</th>
                <th>Giá</th>
                <th>Chỉnh sửa</th>
                <th>Xóa</th>
            </tr>
            <img src="" alt="" srcset="">
        </thead>
        <tbody>
            <?php
        global $url;
 // Kiểm tra xem biến $data đã được khởi tạo chưa
 if (isset($data) && is_array($data)) {
    foreach ($data as $product) {
        echo "<tr>";
        echo "<td>P-" . $product['product_id'] . "</td>";
        echo "<td>" . $product['product_name'] . "</td>";
        echo "<td>" . $product['description'] . "</td>";
        echo "<td>" . $product['stock_quantity'] . "</td>";
        echo "<td>" . $product['category_name'] . "</td>";
        echo "<td> <img src='".$url."" . $product['image_path'] . " ' width='50' height='50'></td>";
        echo "<td>" . $product['price'] . "</td>";
        echo "<td><a href='updateproduct/" . $product['product_id'] . "'><i class='fa-regular fa-pen-to-square'></i></a></td>";
        echo "<td><a href='javascript:void(0)'onclick='confirmDelete(\"deleteproduct\", \"" . $product['product_id'] . "\")'><i class='fa-solid fa-trash'></i></a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>Không có dữ liệu.</td></tr>";
}
?>

            <script>
            confirmDelete(deleteUrl, Id);
            </script>

        </tbody>
    </table>
</div>