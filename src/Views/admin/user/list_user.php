<div class="w-11/12">
    <p class="text-[#0957CB] font-semibold  text-2xl py-4">Danh sách người dùng</p>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Mã người dùng</th>
                <th>Tên người dùng</th>
                <th>Tên tài khoản </th>
                <th>Quyền</th>
                <th>Hình ảnh</th>


                <th>Xóa</th>
            </tr>
            <img src="" alt="" srcset="">
        </thead>
        <tbody>
            <?php
        global $url;
 // Kiểm tra xem biến $data đã được khởi tạo chưa
 if (isset($data) && is_array($data)) {
    foreach ($data as $user) {
        echo "<tr>";
        echo "<td>P-" . $user['user_id'] . "</td>";
        echo "<td>" . $user['user_name'] . "</td>";
        echo "<td>" . $user['user_username'] . "</td>";
        echo "<td>" . $user['role'] . "</td>";
        echo "<td> <img src='".$url."" . $user['profile_image'] . " ' width='50' height='50'></td>";
        echo "<td><a href='javascript:void(0)'onclick='confirmDelete(\"deleteuser\", \"" . $user['user_id'] . "\")'><i class='fa-solid fa-trash'></i></a></td>";
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