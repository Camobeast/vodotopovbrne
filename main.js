var cards = document.querySelectorAll('.card');

[...cards].forEach((card)=>{
  card.addEventListener( 'click', function() {
    card.classList.toggle('is-flipped');
  });
});

const btn = document.querySelector('.cta-button');

btn.addEventListener('click', () => {
  document.getElementById('contact').scrollIntoView({behavior: 'smooth'});
});

let currentSlide = 0;
showSlide(currentSlide);

function showSlide(n) {
    let i;
    let slides = document.getElementsByClassName("carousel-images")[0].getElementsByTagName("img");
    if (n >= slides.length) { currentSlide = 0; }
    if (n < 0) { currentSlide = slides.length - 1; }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[currentSlide].style.display = "block";
}

function moveSlide(n) {
    showSlide(currentSlide += n);
}
