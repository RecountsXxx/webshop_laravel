<template>
  <div class="p-10">
    <div class="flex justify-between items-center mb-10">
      <h1 class="text-3xl font-bold">Shopping cart</h1>
      <h1 v-if="other_vendors" class="text-1xl"> Please note that you have different products from different sellers, there will be different parcels</h1>
    </div>
    <div v-if="products.length > 0" class="grid grid-cols-4 gap-10">
      <CardComponent v-for="product in products" :key="product.id"
                     :id="product.id"
                     :title="product.title"
                     :price="product.price"
                     :img="product.img"
                     :is-cart-element="true"
                     @productRemoved="removeProduct"
      ></CardComponent>
    </div>
    <div v-else class="flex justify-center items-center">
      <img src="/pusto.svg">
      <h1 class="text-2xl text-neutral-400">Empty! 😳</h1>
    </div>

    <div class="mt-10">
      <h2 class="text-xl font-bold mb-4">Checkout</h2>
      <form @submit.prevent="submitOrder" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="full_name">Full Name:</label>
          <input v-model="formData.full_name" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="full_name" type="text" placeholder="Enter your full name" required>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email:</label>
          <input v-model="formData.email" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Enter your email" required>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="city">Select City:</label>
          <select v-model="selectedCity" @change="fetchWarehouses" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <option value="" disabled>Select city</option>
            <option v-for="city in cities" :key="city.Ref" :value="city">{{ city.Description }}</option>
          </select>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="warehouse">Select Warehouse:</label>
          <select v-model="selectedWarehouse" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <option value="" disabled>Select warehouse</option>
            <option v-for="warehouse in warehouses" :key="warehouse.Ref" :value="warehouse">{{ warehouse.Description }}</option>
          </select>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="type_payment">Payment Type:</label>
          <select v-model="formData.type_payment" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <option value="" disabled>Select payment type</option>
            <option value="card">Payment by card</option>
            <option value="cash_on_delivery">Cash on delivery</option>
          </select>
        </div>
        <div class="flex items-center justify-between">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Place Order</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import ProductService from "@/Services/Product/ProductService";
import CardComponent from "@/components/Card.vue";
import NovaPoshtaService from "@/Services/Delivery/NovaPoshtaService";

export default {
  name: 'ShoppingCartComponent',
  components: {CardComponent},
  data() {
    return {
      products: ProductService.getAllCart(),
      formData: {
        vendor_id: '',
        product_id: '',
        type_payment: '',
        full_name: '',
        address: '',
        email: ''
      },
      other_vendors:false,
      cities: [],
      warehouses: [],
      selectedCity: '',
      selectedWarehouse: ''
    }
  },
  methods: {
    async fetchCities() {
      const response = await NovaPoshtaService.getCities();
      this.cities = response.data;
    },
    async fetchWarehouses() {
      if (this.selectedCity) {
        const response = await NovaPoshtaService.getWarehouses(this.selectedCity.Ref);
        this.warehouses = response.data;
      }
    },
    removeProduct(productId) {
      this.products = this.products.filter(product => product.id !== productId);
      this.check_other_vendors();
    },
    async submitOrder() {
      this.products.forEach((product) => {
        this.formData.vendor_id = product.vendor_id;
        this.formData.product_id = product.id;
        this.formData.address = this.selectedCity.Description + ' | ' + this.selectedWarehouse.Description;
        ProductService.sumbitOrder(this.formData);
      });
    },
    check_other_vendors() {
      if (this.products.length > 0) {
        const vendor_id = this.products[0].vendor_id;
        this.other_vendors = this.products.some(product => product.vendor_id !== vendor_id);
      } else {
        this.other_vendors = false;
      }
    }
  },
  mounted() {
    this.fetchCities();
    this.check_other_vendors();
  }
}
</script>
