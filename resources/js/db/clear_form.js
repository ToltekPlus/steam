export function clearForm(form, classInputFile) {
    form.reset();
    document.getElementById("file").value = "";
    const fileName = document.querySelector(classInputFile);
    fileName.textContent = 'Ничего не добавлено';
}