
let currentIndex = 0;
const slide = document.querySelectorAll('.carousel-slide')
const totalSlides = slide.length;

function moveSlide(direction) {
    currentIndex += direction;

    // Loop around the slides
    if (currentIndex < 0) {
        currentIndex = totalSlides - 1;
    } else if (currentIndex >= totalSlides) {
        currentIndex = 0;
    }

    updateSlides();
}

function updateSlides() {
    const slidesContainer = document.querySelector('.carousel-slides');
    const slideWidth = slide[0].clientWidth;
    slidesContainer.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
}

// Set the initial position of the slides
updateSlides();
