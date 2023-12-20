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