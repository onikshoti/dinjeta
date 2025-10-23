document.addEventListener('DOMContentLoaded', function() {
    const addProductForm = document.getElementById('add-product-form');
    const removeProductForm = document.getElementById('remove-product-form');
    const productList = document.getElementById('product-list');

    // Function to add a product
    if (addProductForm) {
        addProductForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(addProductForm);
            fetch('api/add-product.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Product added successfully!');
                    location.reload(); // Reload the page to see the new product
                } else {
                    alert('Error adding product: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    // Function to remove a product
    if (removeProductForm) {
        removeProductForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(removeProductForm);
            fetch('api/remove-product.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Product removed successfully!');
                    location.reload(); // Reload the page to see the updated product list
                } else {
                    alert('Error removing product: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    // Function to fetch and display products
    function fetchProducts() {
        fetch('api/get-products.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    productList.innerHTML = '';
                    data.products.forEach(product => {
                        const li = document.createElement('li');
                        li.textContent = product.name + ' - ' + product.price;
                        productList.appendChild(li);
                    });
                } else {
                    alert('Error fetching products: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    fetchProducts(); // Initial fetch of products
});