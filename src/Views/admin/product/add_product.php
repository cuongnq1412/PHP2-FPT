<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<div class="w-11/12">
    <p class="text-[#0957CB] font-semibold  text-2xl py-4">Thêm sản phẩm</p>
    <form method="POST" enctype="multipart/form-data" class="text-black">
        <div class="grid md:grid-cols-2 grid-cols-1 md:gap-x-4 md:gap-y-0 gap-4">
            <div class="w-full flex flex-col py-2 ">
                <label for="product_name" class="text-black  font-semibold pb-1 capitalize">Product Name:</label>
                <input type="text" id="product_name" class="p-2  border border-[#a5abb5] rounded" name="product_name">
            </div>
            <div class="w-full flex flex-col py-2 md:row-start-2 ">
                <label for="price" class="text-black  font-semibold pb-1 capitalize">Price:</label>
                <input type="text" id="price" class="p-2  border border-[#a5abb5] rounded" name="price">
            </div>
            <div class="w-full flex flex-col py-2 ">
                <label for="stock_quantity" class="text-black  font-semibold pb-1 capitalize">Stock Quantity:</label>
                <input type="text" id="stock_quantity" class="p-2  border border-[#a5abb5] rounded"
                    name="stock_quantity">
            </div>
            <div class="w-full flex flex-col py-2 ">

                <label for="category_id" class="text-black  font-semibold pb-1 capitalize">Category ID:</label>
                <select id="category" name="category" class="p-2  border border-[#a5abb5] rounded" required>

                    <?php
                     if (isset($data) && is_array($data)) {
                    foreach ($data as $category) {
                        echo "<option value=".$category['category_id'].">".$category['category_name']."</option>";
                    }}
                    else{

                    }
        ?>
                </select>
            </div>
            <div class="w-full flex flex-col py-2 ">

                <label for="manufacturer" class="text-black  font-semibold pb-1 capitalize">Manufacturer:</label>
                <input type="text" id="manufacturer" class="p-2  border border-[#a5abb5] rounded" name="manufacturer">

            </div>

            <div class="w-full flex flex-col py-2  md:row-span-2 md:row-start-1 md:col-start-2">
                <label for="description" class="text-black  font-semibold pb-1 capitalize">Description:</label>
                <textarea id="description" class="p-2 h-[8.5rem]  border border-[#E8F0FC] rounded"
                    name="description"></textarea>
            </div>

        </div>
        <div class="w-full flex flex-col py-2 ">
            <label for="product_details" class="text-black  font-semibold pb-1 capitalize">Product
                Details:</label>

            <textarea id="product_details" class="p-2  border border-[#a5abb5] rounded"
                name="product_details"></textarea>

        </div>

        <div class="w-full flex flex-col py-2 mt-10">
            <label for="product_photo" class="text-black   font-semibold pb-1 capitalize"> <i
                    class="fa-solid fa-file-image fa-2xl"></i> Tải lên ảnh sản phẩm </label>
            <input type="file" class="product_photo" name="product_photo[]" id="product_photo"
                class="p-2  hidden border border-[#E8F0FC] rounded" style="display:none" multiple>
        </div>
        <div class="w-full flex justify-end">
            <input type="submit"
                class="hover:text-[#0957CB] bg-[#0957CB] text-white rounded-lg p-3 text-sm font-semibold"
                value="Thêm sản Phẩm">
        </div>
</div>
</form>