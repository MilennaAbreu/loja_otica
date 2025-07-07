document.getElementById('btn-hamburger').addEventListener('click', function(){
  document.querySelector('.main-nav').classList.toggle('open');
});
const filterToggleBtns = document.querySelectorAll('.filter-toggle');
filterToggleBtns.forEach(btn => btn.addEventListener('click', () => {
  document.querySelector('.filters-panel').classList.toggle('open');
}));
let index = 0;
const slides = document.querySelectorAll('.slide');
const prev = document.querySelector('.prev');
const next = document.querySelector('.next');
function showSlide(i) {
  slides.forEach(slide => slide.classList.remove('active'));
  slides[i].classList.add('active');
}
prev.addEventListener('click', () => {
  index = (index > 0) ? index - 1 : slides.length - 1;
  showSlide(index);
});
next.addEventListener('click', () => {
  index = (index < slides.length - 1) ? index + 1 : 0;
  showSlide(index);
});