<template>
  <section class="breadcrumb-blog set-bg" style="background: url('https://themewagon.github.io/malefashion/img/hero/hero-1.jpg')">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Our Blog</h2>
        </div>
      </div>
    </div>
  </section>
  <section class="blog spad">
    <div class="container">
      <div class="row">
        <BlogItem v-for="post in posts" :key="post.id" :id="post.id" :title="post.title" :text="post.text" :image="post.image" :created_at="post.created_at">
        </BlogItem>
      </div>
    </div>

    <ul class="pagination flex justify-center mt-4">
      <li :class="{ 'opacity-50 pointer-events-none': currentPage === 1 }">
        <button @click="prevPage"
                class="py-2 px-4 border border-gray-300 rounded-l hover:bg-gray-200 focus:outline-none">
          Previous
        </button>
      </li>
      <li v-for="page in totalPages" :key="page"
          :class="{ 'opacity-50 pointer-events-none': page === currentPage }">
        <button @click="goToPage(page)"
                class="py-2 px-4 border-t border-b border-gray-300 hover:bg-gray-200 focus:outline-none">
          {{ page }}
        </button>
      </li>
      <li :class="{ 'opacity-50 pointer-events-none': currentPage === totalPages }">
        <button @click="nextPage"
                class="py-2 px-4 border border-gray-300 rounded-r hover:bg-gray-200 focus:outline-none">
          Next
        </button>
      </li>
    </ul>
  </section>
</template>

<script>
import BlogService from "@/services/blog/BlogService";
import BlogItem from "@/components/blog/BlogItem.vue";
export default{
  components: {BlogItem},
  data(){
    return{
      posts:[],
      currentPage: 1,
      perPage: 12,
      totalRows: 0
    }
  },
  computed: {
    totalPages() {
      return Math.ceil(this.totalRows / this.perPage);
    },
  },
  async created(){
    await this.fetchPosts();
  },
  methods:{
    async fetchPosts(){
      const response = await BlogService.getPosts(this.currentPage);
      this.posts = response.posts.data;
      this.totalRows = response.posts.total;
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
  }
}
</script>