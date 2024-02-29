<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



?>
<link href="<?php echo BASE_URLC;?>public/css/profile_admin.css" rel="stylesheet" />

<div class="w-full">

    <div class="flex justify-center xl:w-11/13">
        <div class="w-11/12 xl:w-11/13 mt-4 mb-8">
            <div class="w-full  rounded-lg min-h-screen">
                <div class="w-full flex justify-center h-auto">
                    <div class="w-11/12">
                        <div>
                            <div class=" px-6 mx-auto">

                                <div
                                    class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 mt-16 overflow-hidden break-words border-0 shadow-blur rounded-2xl bg-white/80 bg-clip-border backdrop-blur-2xl backdrop-saturate-200">
                                    <div class="flex">
                                        <div class="flex-none w-auto max-w-full px-3">
                                            <div
                                                class="text-base ease-soft-in-out h-18.5 w-18.5 relative inline-flex items-center justify-center rounded-xl text-white transition-all duration-200">
                                                <form method="post" enctype="multipart/form-data" id="avataForm2">
                                                    <label for="profileImage" class="cursor-pointer">
                                                        <input type="file" id="profileImage" name="profileImage"
                                                            style="display: none;" onchange="uploadImage()" />
                                                        <img src="<?php echo BASE_URLC.$_SESSION['user']['profile_image'] ?>"
                                                            id="previewImage" alt="profile_image"
                                                            class="w-full shadow-soft-sm rounded-xl" />
                                                    </label>

                                                    <input type="submit" id="submitBtn" class="hidden" name="addavatar">
                                                </form>

                                                <script>
                                                function uploadImage() {

                                                    document.getElementById('submitBtn').click();
                                                }
                                                </script>




                                            </div>
                                        </div>
                                        <div class="flex-none w-auto max-w-full px-3 my-auto">
                                            <div class="h-full">
                                                <h5 class="mb-1"><?php echo  $_SESSION['user']['user_name'] ?> </h5>
                                                <p class="mb-0 font-semibold leading-normal text-sm">
                                                    <?php echo  $_SESSION['user']['role'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="w-full max-w-full mt-4 ml-20 sm:my-auto sm:mr-0  "
                                            style="padding-left:300px">
                                            <div class=" w-full">
                                                <ul class="flex list-none bg-transparent justify-between w-full">
                                                    <li class="z-30 flex-auto text-center w-full">
                                                        <button data-section="info"
                                                            class="section-button z-30 block w-full px-0 py-1 mb-0 transition-all hover:no-underline border-0 rounded-lg bg-inherit text-slate-700">
                                                            <i class="fa-solid fa-user"></i>
                                                            <span class="ml-1"> Thông tin </span>
                                                        </button>
                                                    </li>
                                                    <li class="z-30 flex-auto text-center w-full">
                                                        <button data-section="editInfo"
                                                            class="section-button z-30 block w-full px-0 py-1 mb-0 transition-all hover:no-underline border-0 rounded-lg bg-inherit text-slate-700">
                                                            <i class="fa-solid fa-user-pen"></i>
                                                            <span class="ml-1"> Chỉnh sửa </span>
                                                        </button>
                                                    </li>
                                                    <li class="z-30 flex-auto text-center w-full">
                                                        <button data-section="changePassword"
                                                            class="section-button z-30 block w-full px-0 py-1 mb-0 transition-all border-0 rounded-lg bg-inherit text-slate-700">
                                                            <i class="fa-solid fa-key"></i>
                                                            <span class="ml-1"> Đổi mật khẩu </span>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full p-6 mx-auto">
                                <div class="flex flex-wrap -mx-3  section" id="info">
                                    <div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-5/12">
                                        <div
                                            class="relative flex flex-col  min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                                            <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                                                <div class="flex flex-wrap -mx-3">
                                                    <div
                                                        class="flex items-center  max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                                                        <h6 class="mb-0">Hồ sơ </h6>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="flex-auto pl-4 mb-6">
                                                <p class="leading-normal text-sm">
                                                    Chào mừng bạn đến với trang quản trị hãy cố gắng mỗi ngày nhé !
                                                </p>
                                                <hr
                                                    class="h-px my-3 bg-transparent bg-gradient-to-r from-transparent via-white to-transparent" />
                                                <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                                    <li
                                                        class="relative block px-4 py-2 pt-0 pl-0 leading-normal bg-white border-0 rounded-t-lg text-sm text-inherit">
                                                        <strong class="text-slate-700">Họ và tên :</strong> &nbsp;
                                                        <?php echo  $_SESSION['user']['user_username'] ?>
                                                    </li>

                                                    <li
                                                        class="relative block px-4 py-2 pb-0 pl-0 bg-white border-0 border-t-0 rounded-b-lg text-inherit">
                                                        <strong
                                                            class="leading-normal text-sm text-slate-700">Social:</strong>
                                                        &nbsp;
                                                        <a class="inline-block py-0 pl-1 pr-2 mb-0 font-bold text-center text-blue-800 align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-none"
                                                            href="javascript:;">
                                                            <i class="fab fa-facebook fa-lg"></i>
                                                        </a>
                                                        <a class="inline-block py-0 pl-1 pr-2 mb-0 font-bold text-center align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-none text-sky-600"
                                                            href="javascript:;">
                                                            <i class="fab fa-twitter fa-lg"></i>
                                                        </a>
                                                        <a class="inline-block py-0 pl-1 pr-2 mb-0 font-bold text-center align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-none text-sky-900"
                                                            href="javascript:;">
                                                            <i class="fab fa-instagram fa-lg"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 hidden section" id="changePassword">
                                    <div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-5/12">
                                        <div
                                            class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                                            <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                                                <div class="flex flex-wrap -mx-3">
                                                    <div
                                                        class="flex items-center  max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                                                        <h6 class="mb-0">Đổi mật khẩu</h6>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="flex-auto pl-4 ">
                                                <form action="" method="POST" class="mb-6 mr-4">
                                                    <div
                                                        class="grid md:grid-cols-2 grid-cols-1 md:gap-x-4 md:gap-y-0 gap-4">
                                                        <div class="w-full flex flex-col py-2">
                                                            <label for="current-password"
                                                                class="text-black font-semibold pb-1 capitalize"> Mật
                                                                khẩu hiện tại </label>
                                                            <input type="password" id="current-password"
                                                                class="p-2 border border-[#a5abb5] rounded"
                                                                name="current-password">
                                                        </div>
                                                        <div class="w-full flex flex-col py-2">
                                                            <label for="new-password"
                                                                class="text-black font-semibold pb-1 capitalize"> Mật
                                                                khẩu mới </label>
                                                            <input type="password" id="new-password"
                                                                class="p-2 border border-[#a5abb5] rounded"
                                                                name="new-password">
                                                        </div>
                                                        <div class="w-full flex flex-col py-2">
                                                            <label for="confirm-password"
                                                                class="text-black font-semibold pb-1 capitalize"> Nhập
                                                                lại </label>
                                                            <input type="password" id="confirm-password"
                                                                class="p-2 border border-[#a5abb5] rounded"
                                                                name="confirm-password">
                                                        </div>
                                                        <div class="w-full flex justify-center items-center h-1/2 py-2">
                                                            <input type="submit" name="editpassword"
                                                                class="hover:text-[#0957CB] bg-[#0957CB] text-white rounded-lg p-3 text-sm font-semibold"
                                                                value="Thay đổi">
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 hidden section" id="editInfo">
                                    <div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-5/12">
                                        <div
                                            class="relative flex flex-col  min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                                            <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                                                <div class="flex flex-wrap -mx-3">
                                                    <div
                                                        class="flex items-center  max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                                                        <h6 class="mb-0">Chỉnh sửa thông tin</h6>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="flex-auto pl-4 ">
                                                <form class="mb-6 mr-4" method="POST">
                                                    <div
                                                        class="grid md:grid-cols-2 grid-cols-1 md:gap-x-4 md:gap-y-0 gap-4">
                                                        <div class="w-full flex flex-col py-2">
                                                            <label for="fullname"
                                                                class="text-black font-semibold pb-1 capitalize"> Họ và
                                                                tên </label>
                                                            <input type="fullname" id="fullname"
                                                                class="p-2 border border-[#a5abb5] rounded"
                                                                name="user_username"
                                                                value=" <?php echo  $_SESSION['user']['user_username'] ?>">
                                                        </div>

                                                        <div
                                                            class="w-full flex justify-center items-center h-1/2  mt-auto py-2">
                                                            <input type="submit" name="editinfo"
                                                                class="hover:text-[#0957CB] bg-[#0957CB] text-white rounded-lg p-3 text-sm font-semibold"
                                                                value="Thay đổi">
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Lắng nghe sự kiện click cho các button
                    var buttons = document.querySelectorAll('.section-button');

                    buttons.forEach(function(button) {
                        button.addEventListener('click', function() {
                            // Lấy sectionId từ thuộc tính data-section của button
                            var sectionId = button.dataset.section;

                            // Lấy tất cả các section
                            var sections = document.getElementsByClassName("section");

                            // Ẩn tất cả các section
                            for (var i = 0; i < sections.length; i++) {
                                sections[i].style.display = "none";
                            }

                            // Hiển thị section được chọn
                            var selectedSection = document.getElementById(sectionId);
                            if (selectedSection) {
                                selectedSection.style.display = "block";
                            }
                        });
                    });

                    // Hiển thị trang info khi tải trang
                    var infoSection = document.getElementById('info');
                    if (infoSection) {
                        infoSection.style.display = 'block';
                    }
                });
                </script>