<template>
  <div class="p-5">
    <section class="shop spad">
      <div class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <section class="account-info mb-4">
          <h2 class="text-xl font-semibold mb-2">Account Information</h2>
          <p><span class="font-semibold">Email:</span> {{ user.email }}</p>
          <p><span class="font-semibold">Nickname:</span> {{ user.name }}</p>
        </section>
        <section class="become-seller">
          <h2 class="text-xl font-semibold mb-2">Become a Seller</h2>
          <form @submit.prevent="submitForm">
            <div class="mb-4">
              <label for="shopName" class="block text-gray-700 text-sm font-bold mb-2">Shop Name:</label>
              <input type="text" id="shopName" v-model="shopName" required
                     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-6">
              <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
              <textarea id="description" rows="5" v-model="description" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>
            <div class="flex items-center justify-between">
              <div class="w-100 product__details__cart__option">
                <label @click="submitForm" class="w-100 primary-btn text-center">Stay vendor</label>
              </div>
            </div>
          </form>
        </section>
      </div>
    </section>
  </div>

</template>

<script>
import UserService from "@/services/user/UserService";

export default {
  data()
  {
    return {
      user: UserService.getUser(),
      shopName: '',
      description: ''
    }
  },
  methods: {
    submitForm()
    {
      const formData = {
        shopName: this.shopName,
        description: this.description,
        email: this.user.email
      };

      console.log(UserService.getUser().user);

      console.log(formData); // Временный вывод данных формы в консоль
    }
  }
}
</script>



<style scoped>

</style>