<div class="w-11/12">
    <p class="text-[#0957CB] font-semibold  text-2xl py-4">Danh sách sản phẩm</p>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Mã bài viết</th>
                <th>Tên bài viết </th>
                <th>Mô tả</th>
                <th>Nội dung</th>
                <th>Hình ảnh</th>
                <th>Chỉnh sửa</th>
                <th>Xóa</th>
            </tr>
            <img src="" alt="" srcset="">
        </thead>
        <tbody> <?php
        global $url;
 // Kiểm tra xem biến $data đã được khởi tạo chưa
 if (isset($data) && is_array($data)) {
    foreach ($data as $post) {
        echo "<tr>";
        echo "<td>P-" . $post['post_id'] . "</td>";
        echo "<td>" . $post['title'] . "</td>";
        echo "<td> <p style='display: -webkit-box; -webkit-box-orient: vertical;-webkit-line-clamp: 2; overflow: hidden;'>" . $post['description'] . "</p></td>";
        echo "<td style='display: -webkit-box; -webkit-box-orient: vertical;-webkit-line-clamp: 3; overflow: hidden;'> " . $post['content'] . "</td>";
        echo "<td> <img src='".$url."" . $post['thumbnail'] . " ' width='50' height='50'></td>";
        echo "<td><a href='updatepost/" . $post['post_id'] . "'><i class='fa-regular fa-pen-to-square'></i></a></td>";
        echo "<td><a href='javascript:void(0)'onclick='confirmDelete(\"deletepost\", \"" . $post['post_id'] . "\")'><i class='fa-solid fa-trash'></i></a></td>";
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