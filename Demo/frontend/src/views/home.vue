<template>
  <div class="container py-4">
    <section class="mb-5">
      <h2 class="mb-4 text-light text-center">Produk Terbaru</h2>
      <div class="row g-4 justify-content-center">
        <div
          v-for="product in latestProducts"
          :key="product.id"
          class="col-md-3 product-card"
          @click="goToProductDetail(product.id)"
        >
          <div class="card h-100 text-center">
            <div class="card-img-container">
              <img :src="product.image" class="card-img-top" :alt="product.name">
            </div>
            <div class="card-body">
              <h5 class="card-title">{{ product.name }}</h5>
              <p class="card-text">Stok: {{ product.stock }}</p>
              <button @click.stop="addToCart(product)" class="btn btn-success">
                Masukkan Keranjang
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <h2 class="mb-4 text-light text-center">Produk Populer</h2>
      <div class="row g-4 justify-content-center">
        <div
          v-for="product in bestSellers"
          :key="product.id"
          class="col-md-3 product-card"
          @click="goToProductDetail(product.id)"
        >
          <div class="card h-100 text-center">
            <div class="card-img-container">
              <img :src="product.image" class="card-img-top" :alt="product.name">
            </div>
            <div class="card-body">
              <h5 class="card-title">{{ product.name }}</h5>
              <p class="card-text">Stok: {{ product.stock }}</p>
              <button @click.stop="addToCart(product)" class="btn btn-success">
                Masukkan Keranjang
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import api from '../api';

export default {
  data() {
    return {
      latestProducts: [],
      bestSellers: [],
    };
  },
  methods: {
    async fetchProducts() {
      try {
        const latestResponse = await api.get('/api/home?sort_by=year&order=desc');
        const bestSellersResponse = await api.get('/api/home?sort_by=bought&order=asc');

        this.latestProducts = latestResponse.data.data.data;
        this.bestSellers = bestSellersResponse.data.data.data;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    goToProductDetail(productId) {
      if (!productId) {
        console.error("Invalid product ID:", productId);
        return;
      }
      this.$router.push({ path: '/product-detail', query: { id: productId } });
    },
    addToCart(product) {
      console.log('Adding to cart:', product);
    },
  },
  mounted() {
    this.fetchProducts();
  },
};
</script>

<style scoped>
/* General styling */
body {
  background-color: #181818;
  color: white;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
}

/* Section Titles */
h2 {
  font-size: 24px;
  margin-bottom: 20px;
  font-weight: bold;
  color: #ffffff;
}

/* Card Styling */
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
  color: white;
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
  padding: 15px;
}

.card-title {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 10px;
}

.card-text {
  font-size: 14px;
  margin-bottom: 15px;
}

/* Button Styling */
.btn-success {
  background-color: #4CAF50;
  color: black;
  border: none;
  padding: 10px 15px;
  font-size: 14px;
  border-radius: 25px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-success:hover {
  background-color: #45a049;
}

.btn-success:active {
  background-color: #3d8b40;
}
</style>
