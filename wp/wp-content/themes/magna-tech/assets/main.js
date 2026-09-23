document.addEventListener('DOMContentLoaded', function () {
  const toggle = document.querySelector('.menu-toggle');
  const mobile = document.querySelector('.mobile-nav');
  if (toggle && mobile) {
    toggle.addEventListener('click', function () {
      mobile.classList.toggle('open');
      toggle.setAttribute('aria-expanded', mobile.classList.contains('open') ? 'true' : 'false');
    });
    mobile.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () { mobile.classList.remove('open'); });
    });
  }
});
