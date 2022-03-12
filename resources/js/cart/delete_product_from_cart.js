export function deleteFromLocaleStorage(id)
{
    let productsInCart = JSON.parse(localStorage.getItem('steamCart'));
    const filtered = productsInCart.filter(item => item.id !== id);
    localStorage.setItem('steamCart', JSON.stringify(filtered));
}