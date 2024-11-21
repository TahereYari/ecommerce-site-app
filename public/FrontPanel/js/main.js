



const menuBtn =  document.querySelector('#menu-btn');
const closeBtn =  document.querySelector('#close-btn');
const sidebar =  document.querySelector('aside');

menuBtn.addEventListener('click', () => {
   sidebar.style.display = 'block';
})

closeBtn.addEventListener('click', () => {
    sidebar.style.display = 'none';
})


const themeBtn = document.querySelector('.theme-btn');

// Check if dark theme is already enabled in local storage
let isDarkTheme = localStorage.getItem('darkTheme') === 'true';

// Set initial theme state
if (isDarkTheme) {
  document.body.classList.add('dark-theme');
  themeBtn.querySelector('span:first-child').classList.add('active');
} else {
  document.body.classList.remove('dark-theme');
  themeBtn.querySelector('span:first-child').classList.remove('active');
}

// Toggle theme on button click
themeBtn.addEventListener('click', () => {
  document.body.classList.toggle('dark-theme');
  themeBtn.querySelector('span:first-child').classList.toggle('active');

  // Update local storage
  localStorage.setItem('darkTheme', document.body.classList.contains('dark-theme'));
});





document.querySelector('.profile').addEventListener('click', function() {
    var dropdown = document.getElementById('dropdownMenu');
    var expanded = this.getAttribute('aria-expanded') === 'true';
    this.setAttribute('aria-expanded', !expanded);
    dropdown.style.display = expanded ? 'none' : 'block';
});

function toggleMenu() {
    var menu = document.getElementById("languageMenu");
    var isExpanded = menu.getAttribute('aria-hidden') === 'true';
    menu.style.display = isExpanded ? 'block' : 'none';
    menu.setAttribute('aria-hidden', !isExpanded);
    document.querySelector('.img-trans').setAttribute('aria-expanded', isExpanded);
}


let number;

// Wait for the document to finish loading






    

function showLicenseFields(checkbox) {
    if (checkbox.checked) {
        document.getElementById("license-fields").style.display = "block";
    } else {
        document.getElementById("license-fields").style.display = "none";
    }
    }  
    
    

function showMoreFields(checkbox) {
    if (checkbox.checked) {
        document.getElementById("more-fields").style.display = "block";
    } else {
        document.getElementById("more-fields").style.display = "none";
    }
    }    



// Generate a random CAPTCHA
function generateCaptcha() {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let captcha = '';
    for (let i = 0; i < 6; i++) {
      captcha += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return captcha;
  }

  // Generate the CAPTCHA and display it
  const captchaText = generateCaptcha();
  document.getElementById('captcha-text').innerHTML = captchaText;
  document.getElementById('captcha-input').value = captchaText;

  // Add an event listener to the form submission
  document.getElementById('form').addEventListener('submit', (e) => {
    e.preventDefault();
    const userInput = document.getElementById('user-input').value;
    const captcha = document.getElementById('captcha-input').value;
    if (userInput !== captcha) {
      alert('Invalid CAPTCHA. Please try again.');
      return;
    }
    // If the CAPTCHA is valid, submit the form
    document.getElementById('form').submit();
  });    

const uploadInput = document.getElementById('upload');
const thumbnailContainer = document.getElementById('thumbnail-container');

uploadInput.addEventListener('change', (e) => {
    const file = uploadInput.files[0];
    const reader = new FileReader();

    reader.onload = (event) => {
    const thumbnail = document.createElement('img');
    thumbnail.src = event.target.result;
    thumbnail.width = 100; // adjust the width and height to your liking
    thumbnail.height = 100;
    thumbnailContainer.innerHTML = '';
    thumbnailContainer.appendChild(thumbnail);
    };

    reader.readAsDataURL(file);
});

const nationalCodeInput = document.getElementById('p-p');

nationalCodeInput.addEventListener('input', (e) => {
  const nationalCode = e.target.value;
  const isValid = nationalCode.length === 11 && /^\d+$/.test(nationalCode);

  if (!isValid) {
    nationalCodeInput.setCustomValidity('National Code must be 11 digits');
  } else {
    nationalCodeInput.setCustomValidity('');
  }
});

const emailInput = document.getElementById('n-m');

emailInput.addEventListener('input', (e) => {
  const email = e.target.value;
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  const isValid = emailRegex.test(email);

  if (!isValid) {
    emailInput.setCustomValidity('Please enter a valid email address');
  } else {
    emailInput.setCustomValidity('');
  }
});

const phoneNumberInput = document.getElementById('ph');

phoneNumberInput.addEventListener('input', (e) => {
  const phoneNumber = e.target.value;
  const isValid = phoneNumber.length === 11 && /^\d+$/.test(phoneNumber);

  if (!isValid) {
    phoneNumberInput.setCustomValidity('Phone Number must be 11 digits');
  } else {
    phoneNumberInput.setCustomValidity('');
  }
});


// Get the password fields
const pass = document.getElementById('pass');
const passc = document.getElementById('passc');

// Add an event listener to the second password field
passc.addEventListener('input', () => {
  // Check if the values are the same
  if (pass.value !== passc.value) {
    // If not, add an error message
    passc.setCustomValidity('Passwords do not match');
  } else {
    // If they are the same, remove the error message
    passc.setCustomValidity('');
  }
});




function showOptions(e) {
    let divOptions = document.getElementById("divOptions");
    if (divOptions.style.display == "none" || divOptions.style.display == "") {
        divOptions.style.display = "inline-block";
    } else {
        divOptions.style.display = "none";
    }
}

function updateInputCheckbox(checkbox) {
    let inputCheckbox = document.getElementById("inputCheckbox");
    let selectedOptions = [];
    let checkboxes = document.getElementsByName("options[]");
    for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            selectedOptions.push(checkboxes[i].value);
        }
    }
    inputCheckbox.value = selectedOptions.join(", ");
}

function hideOptions(e) {
    let divOptions = document.getElementById("divOptions");
    if (divOptions.contains(e.target)) {
        divOptions.style.display = "inline-block";
    } else {
        divOptions.style.display = "none";
    }
}


document.addEventListener("DOMContentLoaded", function () {
  let checkbox = document.querySelectorAll("#divOptions input");
  let inputCheckbox = document.getElementById("inputCheckbox");

  for (let i = 0; i < checkbox.length; i++) {
      checkbox[i].addEventListener("change", (e) => {
          if (e.target.checked == true) {
              if (inputCheckbox.value == "") {
                  inputCheckbox.value = checkbox[i].value;
              } else {
                  inputCheckbox.value += `,${checkbox[i].value}`;
              }
          } else {
              let values = inputCheckbox.value.split(",");

              for (let r = 0; r < values.length; r++) {
                  if (values[r] == e.target.value) {
                      values.splice(r, 1);
                  }
              }
              inputCheckbox.value = values;
          }
      });
  }
});



/* -==================== Categories ==================== */



