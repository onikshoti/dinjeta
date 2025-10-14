document.addEventListener('DOMContentLoaded', function() {
    const cart = [];

    function updateCartDisplay() {
        const cartContainer = document.getElementById('cart-items');
        cartContainer.innerHTML = '';
        cart.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.textContent = `${item.name} - $${item.price}`;
            const removeButton = document.createElement('button');
            removeButton.textContent = 'Remove';
            removeButton.onclick = () => removeItemFromCart(item.id);
            itemElement.appendChild(removeButton);
            cartContainer.appendChild(itemElement);
        });
    }

    function addItemToCart(id, name, price) {
        cart.push({ id, name, price });
        updateCartDisplay();
    }

    function removeItemFromCart(id) {
        const index = cart.findIndex(item => item.id === id);
        if (index > -1) {
            cart.splice(index, 1);
            updateCartDisplay();
        }
    }

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const price = parseFloat(this.dataset.price);
            addItemToCart(id, name, price);
        });
    });

    document.getElementById('checkout-button').addEventListener('click', function() {
        // Implement checkout functionality here
        alert('Proceeding to checkout...');
    });
});