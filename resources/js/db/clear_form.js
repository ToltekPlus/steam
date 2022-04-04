export function clearForm(form, classInputFile) {
  form.reset();
  document.querySelector('#file').value = '';
  const fileName = document.querySelector(classInputFile);
  fileName.textContent = 'Ничего не добавлено';
}
