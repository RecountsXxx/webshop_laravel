<template>
  <div class="p-3">
    <div class="container">
      <h1>Edit post</h1>
      <form @submit.prevent="editPost">
        <div class="mb-3">
          <label for="categoryName" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" v-model="post.title" required>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Text</label>
          <quill-editor style="height: 500px;" id="editor"   v-html="post.text" v-model="post.text"  ref="editor" :options="editorOptions"/>
        </div>
        <div class="mb-3 d-flex flex-column">
          <label for="image" class="form-label">Image</label>
          <img :src="post.image" width="250px" height="250px" v-if="post.image">
          <input class="form-control mt-3" type="file" id="image" ref="imageInput">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Edit post</button>
      </form>
    </div>
  </div>
</template>

<script>
import PostService from "@/services/posts/PostService";

export default {
  data() {
    return {
      post_id: this.$route.params.id,
      post: {},
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
  async created() {
    this.post = await PostService.getPost(this.post_id);
  },
  methods: {
    async editPost() {
      this.post.text = this.extractPlainText();
      const formData = new FormData();
      formData.append('title', this.post.title);
      formData.append('text', this.post.text);
      if (this.$refs.imageInput.files[0]) {
        formData.append('image', this.$refs.imageInput.files[0]);
      }

      await PostService.editPost(formData, this.post_id);
    },
    extractPlainText() {
      const temp = document.getElementById('editor');
      return temp.innerHTML;
    }
  }
};
</script>

<style>

</style>
