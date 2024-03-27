<template>
  <div class="p-3">
    <div class="container">
      <h1>Add post</h1>
      <form @submit.prevent="addPost">
        <div class="mb-3">
          <label for="categoryName" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" v-model="post.title" required>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Text</label>
          <quill-editor style="height: 500px;" id="editor" ref="editor" v-model="post.text" :options="editorOptions"/>
        </div>
        <div class="mb-3 d-flex flex-column">
          <label for="image" class="form-label">Image</label>
          <img :src="post.image" width="250px" height="250px" v-if="post.image">
          <input class="form-control mt-3" type="file" id="image" ref="imageInput">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Add post</button>
      </form>
    </div>
  </div>
</template>

<script>
import PostService from "@/services/posts/PostService";
import { quillEditor } from "@vueup/vue-quill";

export default {
  components: {
    quillEditor
  },
  data() {
    return {
      post: {
        title: '',
        text: '',
        image: ''
      },
      editorOptions: {
        modules: {
          toolbar: [
            ['bold', 'italic', 'underline', 'strike'],        // базовые инструменты редактора
            [{ 'header': 1 }, { 'header': 2 }],               // заголовки h1 и h2
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],     // списки
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // отступы
            [{ 'color': [] }, { 'background': [] }],          // выбор цвета текста и фона
            ['image']                                         // добавляем инструмент для загрузки изображений
          ]
        },
        theme: 'snow'                                         // выбор темы
      }
    };
  },
  methods: {
    async addPost() {
     this.post.text = this.extractPlainText();
      const formData = new FormData();
      formData.append('title', this.post.title);
      formData.append('text', this.post.text);
      formData.append('image', this.$refs.imageInput.files[0]);
      console.log(formData);
      await PostService.addPost(formData);
    },
    extractPlainText() {
      const temp = document.getElementsByClassName('ql-editor');
      return temp[0].innerHTML;
    }
  }
};
</script>

<style>

</style>
