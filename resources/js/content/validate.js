/**
 * варидатор по всем текстовым инпутам и текстовым зонам
 *
 * @returns {boolean}
 */
export function validate()
{
    let inputs = document.querySelectorAll('input[type="text"]');
    let textareas = document.querySelectorAll('textarea');

    let resultInputs = validateIterator(inputs, inputs.length);
    console.log(resultInputs);
    let resultTextareas = validateIterator(textareas, textareas.length);
    console.log(resultTextareas);

    if (!resultInputs || !resultTextareas) return false;

    return true;
}

/**
 * цикл-обработчик
 *
 * @param block
 * @param blocksLength
 * @returns {boolean}
 */
function validateIterator(block, blocksLength)
{
    if (block.length === 0) return true;

    for (let i = 0; i < blocksLength; ++i) {
        let v = block[i];
        if (!v.value) {
            return false;
        }
    }

    return true;
}