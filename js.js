const poll = {
  binhchon: [0, 0, 0, 0],
  registerNewAnswer: function () {
    const binhchonyeuthich = prompt(
      "Đâu là ngôn ngữ lập trình yêu thích của bạn \n0: JavaScript\n1: Python\n2: Rust\n3: C++"
    );
    if (
      binhchonyeuthich != null &&
      binhchonyeuthich <= 3 &&
      binhchonyeuthich >= 0
    ) {
      this.binhchon[binhchonyeuthich]++;
      //   console.log(this.binhchon);
      //   console.log(123);
    } else {
      console.log("khong hop le ");
    }
    poll.displayResults();
  },
  displayResults: function (type) {
    // console.log(poll.binhchon);
    // const hienthiketqua = document.getElementById("hienthi");
    // hienthiketqua.innerHTML = `Các kết quả bình chọn là:" ${this.binhchon}"`;
    if (type === Array) {
      console.log(poll.binhchon);
    } else  {
      const hienthiketqua = document.getElementById("hienthi");
      hienthiketqua.innerHTML = `Các kết quả bình chọn là:" ${this.binhchon}"`;
      
    }
  },
};

document.getElementById("binhchon").addEventListener("click", function () {
  poll.registerNewAnswer();
});
