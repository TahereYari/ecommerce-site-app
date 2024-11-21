// const chart = document.querySelector('#chart').getContext('2d');

// new Chart(chart, {
//     type: 'line',
//     data: {
//         labels : ['Jan', 'Feb' , 'Mar' , 'Apr', 'May' , 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov'],

//         datasets: [
//             {
//                 label: 'BTC',
//                 data: [29374, 33537, 49631, 59095,57828, 36684, 33572, 39974, 48847, 48116 , 61004],
//                 borderColor: 'red',
//                 borderWidth: 2
//             },
//             {
//                 label: 'ETH',
//                 data: [31500, 41000, 88800, 26000,46000, 32698, 5000, 3000, 18656, 23832 , 36844],
//                 borderColor: 'blue',
//                 borderWidth: 2
//             }

//         ]
//     },
//     options: {
//         responsive: true
//     }
// })

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






    

// function showLicenseFields(checkbox) {
//     if (checkbox.checked) {
//         document.getElementById("license-fields").style.display = "block";
//     } else {
//         document.getElementById("license-fields").style.display = "none";
//     }
//     }  


function showLicenseFields(checkbox) {
    
    var typeInput = document.querySelector('input[name="type[]"]');
    var costInput = document.querySelector('input[name="cost[]"]');

    if (checkbox.checked) {
        document.getElementById("license-fields").style.display = "block";
        typeInput.setAttribute('required', 'required');
        costInput.setAttribute('required', 'required');
    } else {
        
        document.getElementById("license-fields").style.display = "none";
        typeInput.removeAttribute('required');
        costInput.removeAttribute('required');
    }
}

    
document.getElementById('add-moree').addEventListener('click', function() {
    var container = document.getElementById('license-fields');
    var newFields = document.getElementById('more-fields').cloneNode(true);
    newFields.removeAttribute('id');
    newFields.style.display = 'block';

    // پاک کردن مقادیر اینپوت‌ها
    var inputs = newFields.querySelectorAll('input');
    inputs.forEach(function(input) {
        input.value = '';
    });

    container.appendChild(newFields);
    container.appendChild(document.createElement('hr'));
});




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

const nationalCodeInput = document.getElementById('national-code');

nationalCodeInput.addEventListener('input', (e) => {
  const nationalCode = e.target.value;
  const isValid = nationalCode.length === 11 && /^\d+$/.test(nationalCode);

  if (!isValid) {
    nationalCodeInput.setCustomValidity('National Code must be 11 digits');
  } else {
    nationalCodeInput.setCustomValidity('');
  }
});

const emailInput = document.getElementById('email');

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

const phoneNumberInput = document.getElementById('Phone');

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
const passc = document.getElementById('pass-confirm');

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


    function separateNum(value, input) {
        /* seprate number input 3 number */
        var nStr = value + '';
        nStr = nStr.replace(/\,/g, "");
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        if (input !== undefined) {

            input.value = x1 + x2;
        } else {
            return x1 + x2;
        }
}
    
    
// tinymce.init({
//     selector: 'textarea#description-of-competiotion',
//     plugins : 'advlist autolink link lists preview table code pagebreak',
//     menubar: false,
//     language: 'fa',
//     height: 300,
//     relative_urls: false,
//     toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link',
// });
// $(function () {
// // Replace the <textarea id="editor1"> with a CKEditor
// // instance, using default configuration.
// CKEDITOR.replace('editor1')
// //bootstrap WYSIHTML5 - text editor
// $('.description-of-competiotion').wysihtml5()
// })



// document.addEventListener("DOMContentLoaded", function() {
//     const descriptionCells = document.querySelectorAll('.description-cell');

//     descriptionCells.forEach(cell => {
//     cell.addEventListener('click', function() {
//         cell.classList.toggle('expanded');
//     });
//     });
// });


// document.getElementById('competition-date').addEventListener('input', function (e) {
//     var input = e.target;
//     var value = input.value;

//     // Regex برای اعتبارسنجی تاریخ به فرمت yyyy/mm/dd
//     var pattern = /^\d{4}\/\d{2}\/\d{2}$/;

//     if (!pattern.test(value)) {
//         input.setCustomValidity('فرمت تاریخ نادرست است. لطفا فرمت yyyy/mm/dd را وارد کنید.');
//     } else {
//         input.setCustomValidity('');
//     }
// });







