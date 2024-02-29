<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<div class="w-11/12">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/super-build/ckeditor.js"></script>
    <p class="text-[#0957CB] font-semibold  text-2xl py-4">Thêm Bài viết</p>
    <form method="POST" enctype="multipart/form-data" class="text-black">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['user_id'];?>">
        <div class="w-full flex flex-col py-2 ">

            <label for="title" class="text-black  font-semibold pb-1 capitalize">Tiêu đề:</label>
            <input type="text" id="title" class="p-2  border border-[#a5abb5] rounded" name="title">

        </div>
        <div class="w-full flex flex-col py-2 ">
            <label for="description" class="text-black  font-semibold pb-1 capitalize">Mô tả:</label>

            <textarea id="description" class="p-2  border border-[#a5abb5] rounded" name="description"></textarea>

        </div>
        <div class="w-full flex flex-col py-2 ">
            <label for="content" class="text-black  font-semibold pb-1 capitalize">Nội dung:</label>

            <textarea id="editor" class="p-2  border border-[#a5abb5] rounded" name="content"></textarea>

        </div>
        <div class="w-full flex flex-col py-2 mt-10">
            <label for="product_photo" class="text-black   font-semibold pb-1 capitalize"> <i
                    class="fa-solid fa-file-image fa-2xl"></i> Tải lên ảnh sản phẩm </label>
            <input type="file" class="product_photo" name="imgpost" id="product_photo"
                class="p-2  hidden border border-[#E8F0FC] rounded" style="display:none">
        </div>
        <div class="w-full flex justify-end">
            <input type="submit"
                class="hover:text-[#0957CB] bg-[#0957CB] text-white rounded-lg p-3 text-sm font-semibold"
                value="Thêm bài viết">
        </div>
    </form>
    <script src="<?php echo BASE_URLC;?>public/js/ckeditor.js"></script>


</div>