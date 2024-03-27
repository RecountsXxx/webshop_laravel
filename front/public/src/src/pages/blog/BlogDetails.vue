<template>
  <section class="blog-hero spad">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-9 text-center">
          <div class="blog__hero__text">
            <h2>{{post.title}}</h2>
            <ul>
              <li>By MaleFashion</li>
              <li>{{formatDate(post.created_at)}}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="blog-details spad">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-12">
          <div class="blog__details__pic">
            <img :src="post.image" alt="">
          </div>
        </div>
        <div class="col-lg-9">
          <div class="blog__details__content">
            <div class="blog__details__share">
              <span>share</span>
              <ul>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#" class="youtube"><i class="fa fa-youtube-play"></i></a></li>
                <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
              </ul>
            </div>
            <div class="blog__details__text">
              <div v-html="post.text"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import BlogService from "@/services/blog/BlogService";

export default{
  name:'blogDetails',
  data(){
    return{
      post: '',
      post_id: this.$route.params.id
    }
  },
  async created(){
    this.post = await BlogService.getPost(this.post_id);
  },
  methods: {
    formatDate(dateTimeString) {
      const date = new Date(dateTimeString);
      const day = String(date.getDate()).padStart(2, '0');
      const month = String(date.getMonth() + 1).padStart(2, '0');
      const year = date.getFullYear();
      const hours = String(date.getHours()).padStart(2, '0');
      const minutes = String(date.getMinutes()).padStart(2, '0');
      const seconds = String(date.getSeconds()).padStart(2, '0');
      return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
    },
  }
}
</script>

<style>

</style>