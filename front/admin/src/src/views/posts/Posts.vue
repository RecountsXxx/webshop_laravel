<template>
  <main class="p-3">
    <h1 class="text-black mt-2 mb-4">Posts</h1>
    <input class="input-group form-control mb-3" type="text" v-model="searchQuery" placeholder="Search..." @input="searchPosts">
    <div style="max-height: 800px; overflow-y: auto;">
      <table class="table table-striped w-100">
        <thead>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Text</th>
          <th>Image</th>
          <th>Created at</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="post in filteredPosts" :key="post.id">
          <td>{{ post.id }}</td>
          <td>{{ truncateString(post.title, 35) }}</td>
          <td>{{ truncateString(post.text, 35) }}</td>
          <td><img :src="post.image" width="35px" height="35px"></td>
          <td>{{ post.created_at }}</td>
          <td class="d-flex gap-3 flex-row">
            <button class="btn btn-danger" @click="deletePost(post.id)">Delete</button>
            <a :href="`http://localhost/post/${post.id}`"><button class="btn btn-success">View</button></a>
            <router-link :to="`/admin/edit-post/${post.id}`"><button class="btn btn-primary">Edit</button></router-link>
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
import PostService from "@/services/posts/PostService";

export default {
  name: 'postsView',
  data() {
    return {
      posts: [],
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
    filteredPosts() {
      return this.posts.filter(post => {
        return post.title.toLowerCase().includes(this.searchQuery.toLowerCase());
      });
    }
  },
  async created() {
    await this.fetchPosts();
  },
  methods: {
    async fetchPosts() {
        const response = await PostService.fetchPosts(this.currentPage);
        this.posts = response.posts.data;
        this.totalRows = response.posts.total;
    },
    async deletePost(postId) {
        await PostService.deletePost(postId);
        this.posts = this.posts.filter(item => item.id !== postId);
    },
    goToPage(page) {
      if (page !== this.currentPage) {
        this.currentPage = page;
        this.fetchPosts();
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.fetchPosts();
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
        this.fetchPosts();
      }
    },
    truncateString(str, maxLength) {
      if (str.length <= maxLength) {
        return str;
      } else {
        return str.slice(0, maxLength) + '...';
      }
    },
    searchPosts() {

    }
  }
};
</script>

<style>

</style>
