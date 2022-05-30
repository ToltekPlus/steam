/**
 * варидатор по всем текстовым инпутам и текстовым зонам
 *
 * @returns {boolean}
 */
export function validate() {
  const inputs = document.querySelectorAll('input[type="text"]:not(.search-block)');
  const textareas = document.querySelectorAll('textarea');

  const resultInputs = validateIterator(inputs, inputs.length);
  const resultTextareas = validateIterator(textareas, textareas.length);

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
function validateIterator(block, blocksLength) {
  if (block.length === 0) return true;

  for (let i = 0; i < blocksLength; ++i) {
    const v = block[i];
    if (!v.value) {
      return false;
    }
  }

  return true;
}
