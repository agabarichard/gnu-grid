document.addEventListener('DOMContentLoaded', () => {
    loadProducts();
    document.getElementById('uploadForm').addEventListener('submit', uploadProduct);
});

async function loadProducts() {
    const response = await fetch('fetchProducts.php');
    const products = await response.json();
    
    const uploadTable = document.getElementById('uploadTable');
    uploadTable.innerHTML = '';

    products.forEach((product, index) => {
        const row = `
            <tr>
                <th scope="row">${index + 1}</th>
                <td>${product.name}</td>
                <td>${product.category}</td>
                <td>${product.price}</td>
                <td><img src="${product.image}" style="height: 50px; border-radius: 10px;"></td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="editRow('${product.id}')">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="deleteRow('${product.id}')">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        uploadTable.insertAdjacentHTML('beforeend', row);
    });

    document.getElementById('totalProducts').innerText = products.length;
    document.getElementById('totalIncome').innerText = products.reduce((acc, product) => acc + product.price * product.stock, 0);
    document.getElementById('totalSold').innerText = products.filter(product => product.stock === 0).length;
}

async function uploadProduct(event) {
    event.preventDefault();
    const formData = new FormData(event.target);

    const product = {
        name: formData.get('name'),
        description: formData.get('description'),
        category: formData.get('category'),
        price: formData.get('price'),
        stock: formData.get('stock'),
        image: formData.get('image'),
        location: formData.get('location')
    };
    
    const response = await fetch('addProduct.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(product)
    });

    if (response.ok) {
        loadProducts();
    }
}

async function editRow(id) {
    const response = await fetch(`fetchProduct.php?id=${id}`);
    const product = await response.json();

    document.getElementById('editRowId').value = product.id;
    document.getElementById('editName').value = product.name;
    document.getElementById('editCategory').value = product.category;
    document.getElementById('editPrice').value = product.price;
    document.getElementById('editImage').value = product.image;

    new bootstrap.Modal(document.getElementById('editModal')).show();
}

async function saveEdit() {
    const id = document.getElementById('editRowId').value;
    const product = {
        id,
        name: document.getElementById('editName').value,
        category: document.getElementById('editCategory').value,
        price: document.getElementById('editPrice').value,
        image: document.getElementById('editImage').value
    };

    await fetch('updateProduct.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(product)
    });

    loadProducts();
    bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
}

async function deleteRow(id) {
    await fetch(`deleteProduct.php?id=${id}`, {
        method: 'GET'
    });

    loadProducts();
}
