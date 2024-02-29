function confirmDelete(deleteUrl, Id) {
  Swal.fire({
    title: "Bạn có chắc không?",
    text: "Bạn sẽ không thể khôi phục điều này !",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      // Hiển thị thông báo xóa thành công, sau đó chuyển hướng
      showDeleteSuccessMessage(() => {
        window.location.href = deleteUrl + "/" + Id;
      });
    }
  });
}

// Hàm hiển thị thông báo xóa thành công và gọi hàm callback khi hoàn thành
function showDeleteSuccessMessage(callback) {
  Swal.fire({
    position: "top-end",
    icon: "success",
    title: "Xóa thành công!",
    showConfirmButton: false,
    timer: 1500,
  }).then(() => {
    if (callback && typeof callback === "function") {
      callback(); // Gọi hàm callback
    }
  });
}

function showLoginWarning() {
  Swal.fire({
    position: "center",
    icon: "warning",
    title: "Vui lòng đăng nhập !",
    showConfirmButton: false,
    timer: 1500,
  });
}
