// Input Validation Script{green,0}
const inputs = document.querySelectorAll("input");

inputs.forEach((input) => {
  input.addEventListener("blur", (event) => {
    if (event.target.value) {
      input.classList.add("is-valid");
    } else {
      input.classList.remove("is-valid");
    }
  });
});


// loader for navigating login to register and vice versa{green,0}
document.addEventListener('DOMContentLoaded', () => {
  const links = document.querySelectorAll('a.to-login, a.to-register');
  const loadingScreen = document.getElementById('loadingScreen');

  links.forEach(link => {
    link.addEventListener('click', (event) => {
      event.preventDefault();

      loadingScreen.classList.remove('d-none');
      setTimeout(() => {
        window.location.href = link.href;
      }, 500);
    });
  });
});