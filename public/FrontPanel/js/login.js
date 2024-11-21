const themeButton = document.getElementById('theme-button');
const darkTheme = 'dark-theme';
const iconTheme = 'ri-sun-line';

// Check if dark theme is already enabled in local storage
let isDarkTheme = localStorage.getItem('darkTheme') === 'true';

// Set initial theme state
if (isDarkTheme) {
  document.body.classList.add(darkTheme);
  themeButton.classList.add(iconTheme);
} else {
  document.body.classList.remove(darkTheme);
  themeButton.classList.remove(iconTheme);
}

// Toggle theme on button click
themeButton.addEventListener('click', () => {
  document.body.classList.toggle(darkTheme);
  themeButton.classList.toggle(iconTheme);

  // Update local storage
  localStorage.setItem('darkTheme', document.body.classList.contains(darkTheme));
});



const container = document.getElementById('container-login');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

function toggleMenu() {
    var menu = document.getElementById("languageMenu");
    var isExpanded = menu.getAttribute('aria-hidden') === 'true';
    menu.style.display = isExpanded ? 'block' : 'none';
    menu.setAttribute('aria-hidden', !isExpanded);
    document.querySelector('.img-trans').setAttribute('aria-expanded', isExpanded);
}