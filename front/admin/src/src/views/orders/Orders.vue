<template>
  <main class="p-3">
    <h1 class="text-black mt-2 mb-4">Orders</h1>
    <input class="input-group form-control mb-3" type="text" v-model="searchQuery" placeholder="Search..." @input="searchOrders">
    <div style="max-height: 800px; overflow-y: auto;">
      <table class="table table-striped w-100">
        <thead>
        <tr>
          <th>Id</th>
          <th>Product title</th>
          <th>Vendor name</th>
          <th>FullName</th>
          <th>Address</th>
          <th>Email</th>
          <th>Type payment</th>
          <th>Created at</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="order in filteredOrders" :key="order.id">
          <td>{{ order.id }}</td>
          <td>{{ order.product.title }}</td>
          <td>{{ order.vendor.vendor_name }}</td>
          <td>{{ order.full_name }}</td>
          <td>{{ order.address }}</td>
          <td>{{ order.email }}</td>
          <td>{{ order.type_payment }}</td>
          <td>{{ order.created_at }}</td>
          <td class="d-flex gap-3 flex-row">
            <button class="btn btn-danger" @click="deleteOrder(order.id)">Delete</button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <ul class="pagination">
      <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
        <button class="page-link" @click="prevPage">Previous</button>
      </li>
      <li class="page-item" v-for="page in totalPages" :key="page" :class="{ 'active': page === currentPage }">
        <button class="page-link" @click="goToPage(page)">{{ page }}</button>
      </li>
      <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
        <button class="page-link" @click="nextPage">Next</button>
      </li>
    </ul>
  </main>
</template>

<script>
import OrderService from "@/services/orders/OrderService";

export default {
  name: 'OrdersView',
  data() {
    return {
      orders: [],
      searchQuery: '',
      currentPage: 1,
      perPage: 10,
      totalRows: 0
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.totalRows / this.perPage);
    },
    filteredOrders() {
      return this.orders.filter(order => {
        return order.product.title.toLowerCase().includes(this.searchQuery.toLowerCase());
      });
    }
  },
  async created() {
    await this.fetchOrders();
  },
  methods: {
    async fetchOrders() {
        const response = await OrderService.fetchOrders(this.currentPage);
        this.orders = response.orders.data;
        this.totalRows = response.orders.total;
    },
    async deleteOrder(orderId) {
        await OrderService.deleteOrder(orderId);
        this.orders = this.orders.filter(item => item.id !== orderId);
    },
    goToPage(page) {
      if (page !== this.currentPage) {
        this.currentPage = page;
        this.fetchOrders();
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.fetchOrders();
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
        this.fetchOrders();
      }
    },
    truncateString(str, maxLength) {
      if (str.length <= maxLength) {
        return str;
      } else {
        return str.slice(0, maxLength) + '...';
      }
    },
    searchOrders() {

    }
  }
};
</script>

<style>

</style>
