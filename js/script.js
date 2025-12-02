let menu = document.querySelector("#menu-btn");
let navbar = document.querySelector(".header .navbar");

menu.onclick = () => {
  menu.classList.toggle("fa-times");
  navbar.classList.toggle("active");
};

window.onscroll = () => {
  menu.classList.remove("fa-times");
  navbar.classList.remove("active");
};

var swiper = new Swiper(".home-slider", {
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

var swiper = new Swiper(".reviews-slider", {
  grabCursor: true,
  loop: true,
  autoHeight: true,
  spaceBetween: 20,
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    700: {
      slidesPerView: 2,
    },
    1000: {
      slidesPerView: 3,
    },
  },
});

let loadMoreBtn = document.querySelector(".packages .load-more .btn");
let boxes = [...document.querySelectorAll(".packages .box-container .box")];
let currentItem = 6;

// Sembunyikan semua elemen setelah indeks `currentItem` saat halaman dimuat
boxes.forEach((box, index) => {
  if (index >= currentItem) {
    box.style.display = "none"; // Sembunyikan elemen
  }
});

loadMoreBtn.onclick = () => {
  for (var i = currentItem; i < currentItem + 6 && i < boxes.length; i++) {
    boxes[i].style.display = "inline-block"; // Tampilkan elemen
  }
  currentItem += 6;

  // Sembunyikan tombol jika semua elemen telah ditampilkan
  if (currentItem >= boxes.length) {
    loadMoreBtn.style.display = "none";
  }
};
