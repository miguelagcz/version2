let current = 0;
const testimonials = document.querySelectorAll('.testimonial');

setInterval(() => {
  testimonials[current].classList.add('hidden');
  current = (current + 1) % testimonials.length;
  testimonials[current].classList.remove('hidden');
}, 4500);
