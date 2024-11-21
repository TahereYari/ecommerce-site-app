document.addEventListener('DOMContentLoaded', function() {
    const uploadInput = document.getElementById('upload');
    const fileDescription = document.getElementById('fileDescription');
    const fileProgress = document.getElementById('fileProgress');
    const progressIndicator = document.querySelector('.progress-indicator');
    const uploadButton = document.querySelector('.uploadButton');
    const cancelButton = document.querySelector('.cancelButton');
    let interval; // Declare 'interval' in a shared scope

    uploadInput.onchange = function() {
        if (uploadInput.files.length > 0) {
            const file = uploadInput.files[0];
            fileDescription.textContent = file.name;
            fileDescription.classList.remove('hidden');
            uploadButton.disabled = false; // Enable the upload button when a file is selected
        } else {
            fileDescription.textContent = 'No file selected';
            fileDescription.classList.add('hidden');
            uploadButton.disabled = true; // Disable the upload button if no file is selected
        }
    };

    uploadButton.onclick = function() {
        if (uploadInput.files.length === 0) {
            alert('The video slot is empty');
            return; // Prevent upload if no file is selected
        }
        let load = 0;
        uploadButton.style.display = 'none'; // Hide the upload button when upload starts
        interval = setInterval(function() {
            if (load >= 100) {
                clearInterval(interval);
                progressIndicator.textContent = 'Upload completed';
                cancelButton.classList.add('hidden');
            } else {
                load++;
                fileProgress.value = load;
                progressIndicator.textContent = `${load}% - Uploading`;
            }
        }, 100);
        cancelButton.classList.remove('hidden');
    };

    cancelButton.onclick = function() {
        clearInterval(interval);
        fileProgress.value = 0;
        progressIndicator.textContent = 'Upload canceled';
        cancelButton.classList.add('hidden');
        uploadButton.style.display = 'inline-block'; // Show the upload button again when canceled
    };
});


const fileButton = document.getElementById('fileButton');
const fileInput = document.getElementById('fileInput');

fileButton.addEventListener('click', () => {
  fileInput.click();
});

fileInput.addEventListener('change', () => {
  const file = fileInput.files[0];
  // Upload the file using AJAX or the Fetch API
  const formData = new FormData();
  formData.append('file', file);

  fetch('/upload', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => console.log(data))
  .catch(error => console.error(error));
});

const fileButton2 = document.getElementById('fileButton-2');
const fileInput2 = document.getElementById('fileInput-2');

fileButton2.addEventListener('click', () => {
  fileInput2.click();
});

fileInput2.addEventListener('change', () => {
  const file = fileInput2.files[0];
  // Upload the file using AJAX or the Fetch API
  const formData = new FormData();
  formData.append('file', file);

  fetch('/upload', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => console.log(data))
  .catch(error => console.error(error));
});