export function addNewValueToCountContent()
{
    let count = document.getElementById('count_values').innerText;

    document.getElementById('count_values').innerHTML = parseInt(count) + 1;
}
