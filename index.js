// let counter = 1;
// const totalSlides = 2; // Adjust this number based on the total number of slides

// function moveSlide(n) {
//     counter += n;
//     if (counter > totalSlides) {
//         counter = 1;
//     }
//     if (counter < 1) {
//         counter = totalSlides;
//     }
//     document.getElementById('radio' + counter).checked = true;
// }

// // Automatic sliding
// setInterval(function(){
//     moveSlide(1);
// }, 1000);
const slides = document.querySelectorAll('.slide');
let currentSlide = 0;

function showSlide(n) {
  slides[currentSlide].classList.remove('active');
  currentSlide = (n + slides.length) % slides.length;
  slides[currentSlide].classList.add('active');
}

function nextSlide() {
  showSlide(currentSlide + 1);
}

setInterval(nextSlide, 1000); // Auto-slide every 5 seconds

document.querySelectorAll('.slide').forEach((slide, index) => {
  slide.addEventListener('click', () => {
    showSlide(index);
  });
});