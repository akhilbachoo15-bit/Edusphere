/* =========================================================
   EduSphere — main.js
   Handles: mobile nav, scroll reveal, testimonial slider,
   course search/filter, client-side form validation,
   animated progress bars.
   ========================================================= */

document.addEventListener('DOMContentLoaded', () => {

  /* ---------- Mobile navigation toggle ---------- */
  const navToggle = document.getElementById('navToggle');
  const navLinks = document.getElementById('navLinks');
  const navActions = document.getElementById('navActions');

  if (navToggle) {
    navToggle.addEventListener('click', () => {
      navToggle.classList.toggle('open');
      navLinks.classList.toggle('open');
      navActions.classList.toggle('open');
    });
  }

  /* ---------- Scroll reveal animation ---------- */
  const revealEls = document.querySelectorAll('.reveal');
  if (revealEls.length) {
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('in-view');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });
    revealEls.forEach(el => revealObserver.observe(el));
  }

  /* ---------- Animated progress bars (dashboard) ---------- */
  const bars = document.querySelectorAll('.progress-bar-fill');
  if (bars.length) {
    const barObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const target = entry.target.dataset.progress || 0;
          entry.target.style.width = target + '%';
          barObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.3 });
    bars.forEach(bar => barObserver.observe(bar));
  }

  /* ---------- Testimonial slider ---------- */
  const slides = document.querySelectorAll('.testimonial-slide');
  const dots = document.querySelectorAll('.dot');
  let current = 0;

  function showSlide(index) {
    slides.forEach((s, i) => s.classList.toggle('active', i === index));
    dots.forEach((d, i) => d.classList.toggle('active', i === index));
    current = index;
  }

  if (slides.length) {
    showSlide(0);
    dots.forEach((dot, i) => dot.addEventListener('click', () => showSlide(i)));
    setInterval(() => {
      showSlide((current + 1) % slides.length);
    }, 5500);
  }

  /* ---------- Course search & filter ---------- */
  const searchInput = document.getElementById('courseSearch');
  const chips = document.querySelectorAll('.chip');
  const courseCards = document.querySelectorAll('.course-card');
  let activeCategory = 'All';

  function filterCourses() {
    const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
    let visibleCount = 0;

    courseCards.forEach(card => {
      const title = card.dataset.title.toLowerCase();
      const category = card.dataset.category;
      const matchesSearch = title.includes(query);
      const matchesCategory = activeCategory === 'All' || category === activeCategory;

      const show = matchesSearch && matchesCategory;
      card.style.display = show ? 'flex' : 'none';
      if (show) visibleCount++;
    });

    const emptyState = document.getElementById('coursesEmpty');
    if (emptyState) {
      emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
    }
  }

  if (searchInput) searchInput.addEventListener('input', filterCourses);

  if (chips.length) {
    chips.forEach(chip => {
      chip.addEventListener('click', () => {
        chips.forEach(c => c.classList.remove('active'));
        chip.classList.add('active');
        activeCategory = chip.dataset.category;
        filterCourses();
      });
    });
  }

  /* ---------- Client-side form validation ---------- */
  function validateField(field, rule, message) {
    const group = field.closest('.form-group');
    const errorEl = group.querySelector('.form-error');
    const isValid = rule(field.value.trim());
    group.classList.toggle('invalid', !isValid);
    if (errorEl) errorEl.textContent = message;
    return isValid;
  }

  const forms = document.querySelectorAll('form[data-validate]');
  forms.forEach(form => {
    form.addEventListener('submit', (e) => {
      let valid = true;

      form.querySelectorAll('[data-rule]').forEach(field => {
        const rule = field.dataset.rule;
        let ok = true;
        let message = 'This field is required.';

        if (rule === 'required') {
          ok = field.value.trim().length > 0;
        } else if (rule === 'email') {
          ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value.trim());
          message = 'Please enter a valid email address.';
        } else if (rule === 'minlength') {
          const min = parseInt(field.dataset.min || 6, 10);
          ok = field.value.trim().length >= min;
          message = `Must be at least ${min} characters.`;
        } else if (rule === 'match') {
          const target = document.querySelector(field.dataset.matchTarget);
          ok = target && field.value === target.value;
          message = 'Passwords do not match.';
        }

        if (!validateField(field, () => ok, message)) valid = false;
      });

      if (!valid) e.preventDefault();
    });
  });

});
