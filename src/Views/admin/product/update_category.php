<div class="w-11/12">
    <p class="text-[#0957CB] font-semibold  text-2xl py-4">Sửa danh mục</p>
    <form method="post">
        <div class="grid md:grid-cols-2 grid-cols-1 md:gap-x-4 md:gap-y-0 gap-4">
            <div class="w-full flex flex-col py-2 ">
                <label for="category">Tên danh mục</label>
                <input type="hidden" name="categoryid" value="<?php echo $category['category_id']; ?>">
                <input type="text" name="category" id="category" class="p-2  border border-[#a5abb5] rounded"
                    value="<?php echo $category['category_name']; ?>"><br>
                <div class="w-full flex justify-end">
                    <input type="submit"
                        class="hover:text-[#0957CB] bg-[#0957CB] text-white rounded-lg p-3 text-sm font-semibold"
                        value="Sửa danh mục">
                </div>
            </div>
        </div>
    </form>
    <script>
    new DataTable('#example');
    </script>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Id danh mục</th>
                <th>Tên danh mục </th>
                <th>Chỉnh sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php
        
        
 // Kiểm tra xem biến $data đã được khởi tạo chưa
if (isset($data) && is_array($data)) {
    foreach ($data as $category) {
        echo "<tr>";
        echo "<td>M-" . $category['category_id'] . "</td>";
        echo "<td>" . $category['category_name'] . "</td>";
        echo "<td><a href='" . $category['category_id'] . "'><i class='fa-regular fa-pen-to-square'></i></a></td>";
        echo "<td><a href='javascript:void(0)'onclick='confirmDelete(\"".BASE_URL."deletecategory\", \"" . $category['category_id'] . "\")'><i class='fa-solid fa-trash'></i></a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>Không có dữ liệu.</td></tr>";
}
?>


        </tbody>
    </table>
</div>
<!-- Nạp các file JavaScript của DataTables -->