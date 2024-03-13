<template>
  <div>
    <h2>Добавить новый продукт</h2>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label for="title">Заголовок:</label>
        <input type="text" id="title" v-model="formData.title" class="form-control">
      </div>
      <div class="form-group">
        <label for="description">Описание:</label>
        <textarea id="description" v-model="formData.description" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label for="price">Цена:</label>
        <input type="number" id="price" v-model="formData.price" class="form-control">
      </div>
      <div class="form-group">
        <label for="category_id">Категория:</label>
        <select v-model="formData.category_id" class="form-control">
          <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
        </select>
      </div>
      <div class="form-group">
        <label for="vendor_id">Поставщик:</label>
        <select v-model="formData.vendor_id" class="form-control">
          <option v-for="vendor in vendors" :key="vendor.id" :value="vendor.id">{{ vendor.name }}</option>
        </select>
      </div>
      <div class="form-group">
        <label for="brand_id">Бренд:</label>
        <select v-model="formData.brand_id" class="form-control">
          <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.name }}</option>
        </select>
      </div>
      <div class="form-group">
        <label for="image">Изображение:</label>
        <input type="file" id="image" ref="image" class="form-control" @change="handleFileChange">
      </div>
      <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
  </div>
</template>

<script>
export default {
  name:'addProductComponent',
  data() {
    return {
      formData: {
        title: '',
        description: '',
        price: null,
        category_id: null,
        vendor_id: null,
        brand_id: null,
        image: null
      },
      categories: [], // массив объектов категорий
      vendors: [], // массив объектов поставщиков
      brands: [] // массив объектов брендов
    };
  },
  methods: {
    submitForm() {
      // Отправка данных на сервер
      // Данные будут доступны в formData
    },
    handleFileChange(event) {
      this.formData.image = event.target.files[0];
    }
  }
}
</script>

<style>
.form-group {
  margin-bottom: 20px;
}
</style>
