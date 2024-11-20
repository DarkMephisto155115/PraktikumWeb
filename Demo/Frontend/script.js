const apiBase = 'http://localhost:8000/api';

// Fetch all products
async function fetchProducts() {
    try {
        const response = await fetch(`${apiBase}/allProducts`);
        const products = await response.json();
        displayProducts(products);
    } catch (error) {
        console.error('Error fetching products:', error);
    }
}

// Display products
function displayProducts(products) {
    const productList = document.getElementById('product-list');
    productList.innerHTML = '';

    products.forEach(product => {
        const productDiv = document.createElement('div');
        productDiv.className = 'product';
        productDiv.innerHTML = `
            <h3>${product.name}</h3>
            <p>Brand: ${product.brand}</p>
            <p>Price: $${product.price}</p>
            <button onclick="deleteProduct(${product.id})">Delete</button>
        `;
        productList.appendChild(productDiv);
    });
}

// Add product
async function addProduct(event) {
    event.preventDefault();

    const productData = {
        name: "RTX 4090",
        brand: "ROG",
        description: "RTX 4090 the best graphic card",
        price: 42000000,
        category: "GPU",
        stok: 2,
        muchBought: 0,
        image: "",
    };

    try {
        const response = await fetch('http://localhost:8000/api/addProduct', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(productData),
        });

        console.log(JSON.stringify(productData));

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const result = await response.json();
        console.log('Product added successfully:', result);
    } catch (error) {
        console.error('Error adding product:', error);
    }
}


// Delete product
async function deleteProduct(productId) {
    try {
        const response = await fetch(`${apiBase}/delete/${productId}`, {
            method: 'DELETE',
        });
        if (response.ok) {
            alert('Product deleted successfully');
            fetchProducts();
        } else {
            console.error('Error deleting product:', await response.text());
        }
    } catch (error) {
        console.error('Error deleting product:', error);
    }
}

// Event listeners
document.getElementById('add-product-form').addEventListener('submit', addProduct);

// Initial fetch
fetchProducts();
