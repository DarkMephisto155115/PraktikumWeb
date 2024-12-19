<template>
    <div class="container-fluid bg-dark text-light py-4" style="padding: 50px;">
        <h1 class="mb-4">Product Catalog</h1>

        <!-- Filter & Search -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control bg-secondary text-light" placeholder="Search products"
                        v-model="searchQuery" @input="filterProducts" />
                    <button class="btn btn-outline-light" type="button" @click="filterProducts">Search</button>
                </div>
            </div>
            <div class="col-md-4">
                <select class="form-select bg-secondary text-light" v-model="selectedBrand" @change="filterProducts">
                    <option value="">All Brands</option>
                    <option v-for="brand in brands" :key="brand" :value="brand">{{ brand }}</option>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-select bg-secondary text-light" v-model="sortBy" @change="sortProducts">
                    <option value="name">Sort by Name</option>
                    <option value="price_asc">Price: Low to High</option>
                    <option value="price_desc">Price: High to Low</option>
                </select>
            </div>
        </div>

        <!-- Product Display -->
        <div class="row g-4">
            <div v-for="product in paginatedProducts" :key="product.id" class="col-md-3 col-sm-6">
                <div class="product-card" @click="goToProductDetail(product.id)">
                    <div class="card h-100">
                        <div class="card-img-container">
                            <img :src="product.image" class="card-img-top" :alt="product.name">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ product.name }}</h5>
                            <p class="card-text brand">{{ product.brand }}</p>
                            <p class="card-text flex-grow-1">{{ truncateDescription(product.description) }}</p>
                            <p class="card-text price"><strong>Rp{{ formatPrice(product.price) }}</strong></p>
                            <button class="btn btn-success w-100" @click.stop="addToCart(product)">
                                Masukkan Keranjang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <nav v-if="totalPages > 1" aria-label="Product navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                    <a class="page-link bg-secondary text-light" href="#" @click.prevent="changePage(currentPage - 1)">
                        Previous
                    </a>
                </li>
                <li v-for="page in totalPages" :key="page" class="page-item" :class="{ active: currentPage === page }">
                    <a class="page-link bg-secondary text-light" href="#" @click.prevent="changePage(page)">
                        {{ page }}
                    </a>
                </li>
                <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                    <a class="page-link bg-secondary text-light" href="#" @click.prevent="changePage(currentPage + 1)">
                        Next
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Overlay -->
        <div v-if="showOverlay" class="overlay">
            <div class="overlay-content">
                <button class="close-button" @click="closeOverlay">&times;</button>
                <p v-if="!isLoggedIn">{{ overlayMessage }}</p>
                <div v-else>
                    <h5>{{ overlayMessage }}</h5>
                    <div class="quantity-control mt-3">
                        <button class="btn btn-sm btn-outline-light" @click="decreaseQuantity">-</button>
                        <span class="mx-3">{{ selectedProductQuantity }}</span>
                        <button class="btn btn-sm btn-outline-light" @click="increaseQuantity">+</button>
                    </div>
                    <button class="btn btn-primary btn-sm mt-3" @click="confirmAddToCart">
                        Confirm Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import api from "../api";

export default {
    name: "Catalog",
    data() {
        return {
            idUser: localStorage.getItem("idUser") || "",
            products: [],
            displayedProducts: [],
            brands: [],
            searchQuery: "",
            selectedBrand: "",
            sortBy: "name",
            currentPage: 1,
            productsPerPage: 12,
            isLoggedIn: !!localStorage.getItem("token"),
            showOverlay: false,
            overlayMessage: "",
            selectedProduct: null,
            selectedProductQuantity: 1,
        };
    },
    computed: {
        totalPages() {
            return Math.ceil(this.displayedProducts.length / this.productsPerPage);
        },
        paginatedProducts() {
            const start = (this.currentPage - 1) * this.productsPerPage;
            const end = start + this.productsPerPage;
            return this.displayedProducts.slice(start, end);
        },
    },
    created() {
        this.fetchProducts();
    },
    methods: {
        async fetchProducts() {
            try {
                const response = await api.get("/api/product");
                this.products = response.data.data;
                this.displayedProducts = [...this.products];
                this.brands = [...new Set(this.products.map((product) => product.brand))];
                this.sortProducts();
            } catch (error) {
                console.error("Error fetching products:", error);
                this.overlayMessage = "Failed to fetch products. Please try again.";
                this.showOverlay = true;
            }
        },
        filterProducts() {
            this.displayedProducts = this.products.filter((product) => {
                const matchesSearch =
                    product.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    product.description.toLowerCase().includes(this.searchQuery.toLowerCase());
                const matchesBrand = this.selectedBrand === "" || product.brand === this.selectedBrand;
                return matchesSearch && matchesBrand;
            });
            this.sortProducts();
            this.currentPage = 1;
        },
        sortProducts() {
            switch (this.sortBy) {
                case "name":
                    this.displayedProducts.sort((a, b) => a.name.localeCompare(b.name));
                    break;
                case "price_asc":
                    this.displayedProducts.sort((a, b) => a.price - b.price);
                    break;
                case "price_desc":
                    this.displayedProducts.sort((a, b) => b.price - a.price);
                    break;
            }
        },
        formatPrice(price) {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },
        truncateDescription(description) {
            return description.length > 50 ? description.substring(0, 47) + "..." : description;
        },
        addToCart(product) {
            if (this.isLoggedIn) {
                this.selectedProduct = product;
                this.selectedProductQuantity = 1;
                this.overlayMessage = `Add ${product.name} to cart?`;
            } else {
                this.overlayMessage = "You must log in to add products to your cart.";
            }
            this.showOverlay = true;
        },
        async confirmAddToCart() {
            const payload = {
                customer_id: parseInt(this.idUser),
                product_id: parseInt(this.selectedProduct.id),
                quantity: parseInt(this.selectedProductQuantity),
            };

            console.log("Payload yang dikirim:", payload);

            try {
                const response = await api.post("/api/cart", payload);
                alert("Product added to cart successfully!");
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    alert("Validation error: " + JSON.stringify(error.response.data));
                    console.error(error);
                } else {
                    alert("Failed to add product to cart. Please try again.");
                }
            } finally {
                this.closeOverlay();
            }
        },
        closeOverlay() {
            this.showOverlay = false;
        },
        increaseQuantity() {
            if (this.selectedProductQuantity < this.selectedProduct.stock) {
                this.selectedProductQuantity++;
            }
        },
        decreaseQuantity() {
            if (this.selectedProductQuantity > 1) {
                this.selectedProductQuantity--;
            }
        },
        changePage(page) {
            if (page >= 1 && page <= this.totalPages) {
                this.currentPage = page;
            }
        }, goToProductDetail(productId) {
            if (!productId) {
                console.error("Invalid product ID:", productId);
                return;
            }
            this.$router.push({ path: '/product-detail', query: { id: productId } });
        },
    },
};
</script>

<style scoped>
.product-card {
    cursor: pointer;
    transition: transform 0.3s;
}

.product-card:hover {
    transform: scale(1.03);
}

.card {
    background-color: #333333;
    border-radius: 10px;
    overflow: hidden;
    height: 100%;
}

.card-img-container {
    background-color: white;
    padding: 10px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.card-img-top {
    width: 100%;
    height: 200px;
    object-fit: contain;
}

.card-body {
    color: white;
    padding: 15px;
}

.card-title {
    font-size: 14px;
    margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.card-text {
    font-size: 12px;
    color: #cccccc;
}

.card-text.brand {
    font-weight: bold;
    margin-bottom: 5px;
}

.card-text.price {
    font-size: 14px;
    color: white;
    margin-top: 10px;
}

.btn-success {
    background-color: #4CAF50;
    color: black;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 25px;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease;
}

.btn-success:hover {
    background-color: #45a049;
    color: black;
}

.btn-success:active {
    background-color: #3d8b40;
    color: black;
}

.pagination .page-link {
    background-color: #343a40;
    border-color: #6c757d;
}

.pagination .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
}

.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.overlay-content {
    background-color: #343a40;
    color: #fff;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    width: 90%;
    max-width: 400px;
}

.close-button {
    position: absolute;
    top: 10px;
    right: 15px;
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #fff;
    cursor: pointer;
}

.close-button:hover {
    color: #ffc107;
}
</style>