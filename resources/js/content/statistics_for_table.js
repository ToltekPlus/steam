export function addNewValueToCountContent()
{
    let count = document.getElementById('count_values').innerText;

    if (count != null) { document.getElementById('count_values').innerHTML = parseInt(count) + 1};
}
