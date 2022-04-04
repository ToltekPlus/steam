export function addNewValueToCountContent() {
  const count = document.querySelector('#count_values').innerText;

  if (count != undefined) {
    document.querySelector('#count_values').innerHTML =
      Number.parseInt(count) + 1;
  }
}
