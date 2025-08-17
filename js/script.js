document.addEventListener("DOMContentLoaded", function () {
  const loginForm = document.querySelector("form");
  if (loginForm) {
    loginForm.addEventListener("submit", function (event) {
      const username = document.getElementById("username");
      const password = document.getElementById("password");
      if (username.value === "" || password.value === "") {
        alert("Please fill out all fields.");
        event.preventDefault();
      }
    });
  }
});

document.addEventListener('scroll', function () {
  const images = document.querySelectorAll('.hero-img'); 
  const scrollPosition = window.scrollY; 

  images.forEach(image => {
    const imagePosition = image.getBoundingClientRect().top; 
    const windowHeight = window.innerHeight;

    if (imagePosition < windowHeight && imagePosition > 0) {
      const speed = 0.5;
      const offset = scrollPosition * speed;

      image.style.transform = `translateY(-${offset}px)`;
    } else {
      image.style.transform = 'translateY(0)';
    }
  });
});








