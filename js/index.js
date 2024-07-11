
document.addEventListener('DOMContentLoaded', function () {
    var products = [
        
        { id: 1, name: 'Apple', price: 1000.00, category: 'Fruits',  },
        { id: 2, name: 'Banana', price: 20000.00, category: 'Fruits' },
        { id: 3, name: 'Carrot', price: 1500.00, category: 'Vegetables' },
        { id: 4, name: 'Broccoli', price: 3000.00, category: 'Vegetables' },
        { id: 5, name: 'Milk', price: 6000.00, category: 'Dairy' },
        { id: 6, name: 'Cheese', price: 12000.000, category: 'Dairy' }
    ];
    var cart = [];
    var cartCountElement = document.getElementById('cart-count');
    var cartItemsElement = document.getElementById('cart-items');
    var cartTotalElement = document.getElementById('cart-total');
    var cartNotification = document.getElementById('cart-notification');
    var productListElement = document.getElementById('product-list');

    function showCartNotification() {
        cartNotification.style.display = 'block';
        setTimeout(function () {
            cartNotification.style.display = 'none';
        }, 2000);
    }

    function updateCart() {
        cartItemsElement.innerHTML = '';

        if (cart.length === 0) {
            cartItemsElement.innerHTML = '<li class="list-group-item">Your cart is empty.</li>';
        } else {
            var total = 0;

            cart.forEach(function (item) {
                var listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                listItem.innerHTML = `
                    ${item.name} - UGX${item.price.toFixed(2)} x 
                    <input type="number" class="quantity-input" min="1" value="${item.quantity}" data-product-id="${item.id}">
                    <span>UGX ${(item.price * item.quantity).toFixed(2)}</span>
                    <button class="btn btn-sm btn-danger remove-from-cart" data-product-id="${item.id}">&times;</button>
                `;
                cartItemsElement.appendChild(listItem);
                total += item.price * item.quantity;
            });

            cartTotalElement.textContent = total.toFixed(2);

            document.querySelectorAll('.quantity-input').forEach(function (input) {
                input.addEventListener('change', function () {
                    var productId = input.getAttribute('data-product-id');
                    var newQuantity = parseInt(input.value, 10);
                    updateQuantity(productId, newQuantity);
                });
            });

            document.querySelectorAll('.remove-from-cart').forEach(function (button) {
                button.addEventListener('click', function () {
                    var productId = button.getAttribute('data-product-id');
                    removeFromCart(productId);
                });
            });
        }

        cartCountElement.textContent = cart.reduce(function (total, item) {
            return total + item.quantity;
        }, 0);
    }

    function addToCart(productId, productName, productPrice) {
        var existingItem = cart.find(function (item) {
            return item.id === productId;
        });

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                id: productId,
                name: productName,
                price: productPrice,
                quantity: 1
            });
        }

        showCartNotification();
        updateCart();
    }

    function updateQuantity(productId, quantity) {
        var item = cart.find(function (item) {
            return item.id === productId;
        });

        if (item && quantity > 0) {
            item.quantity = quantity;
            updateCart();
        }
    }

    function removeFromCart(productId) {
        cart = cart.filter(function (item) {
            return item.id !== productId;
        });

        updateCart();
    }

    function loadProducts(category) {
        productListElement.innerHTML = '';

        var filteredProducts = products.filter(function (product) {
            return product.category === category;
        });

        filteredProducts.forEach(function (product) {
            var card = document.createElement('div');
            card.className = 'col-md-4 mb-4';
            card.innerHTML = `
                <div class="card">
                    <img src="https://via.placeholder.com/350x250" class="card-img-top" alt="${product.name}">
                    <div class="card-body">
                        <h5 class="card-title">${product.name}</h5>
                        <p class="card-text">UGX${product.price.toFixed(2)}</p>
                        <button class="btn btn-outline-primary add-to-cart" data-product-id="${product.id}" data-product-name="${product.name}" data-product-price="${product.price}">Add to Cart</button>
                    </div>
                </div>
            `;
            productListElement.appendChild(card);
        });

        document.querySelectorAll('.add-to-cart').forEach(function (button) {
            button.addEventListener('click', function () {
                var productId = button.getAttribute('data-product-id');
                var productName = button.getAttribute('data-product-name');
                var productPrice = parseFloat(button.getAttribute('data-product-price'));
                addToCart(productId, productName, productPrice);
            });
        });
    }

    document.querySelectorAll('.category-list').forEach(function (categoryElement) {
        categoryElement.addEventListener('click', function () {
            var category = categoryElement.getAttribute('data-category');
            loadProducts(category);
        });
    });

    // Load products for the initial category (e.g., Fruits)
    loadProducts('Dairy');
});



    
   