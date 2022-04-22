const fileInput = document.querySelector('#file-js-example input[type=file]');
fileInput.addEventListener('change', () => {
  if (fileInput.files.length > 0) {
    const fileName = document.querySelector('#file-js-example .file-name');
    fileName.textContent = fileInput.files[0].name;
  }
});
