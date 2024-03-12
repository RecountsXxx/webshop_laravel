<template>
  <main class="mt-2 ms-2 d-flex flex-column gap-3">
    <div class="d-flex flex-col gap-5">
    <h1>Dashboard</h1>
    </div>
  </main>
</template>

<script>
import axios from "axios";

export default {
  name: 'homeView',
  data() {
    return {
      posts_count:'1',
      users_count:'1',
      admins_count:'1',
      category_count:'1',
      report_post_count:'1',
      report_comment_count:'1',
    };
  },
  created() {

  },
  methods: {

  },
}
</script>

<style scoped>

</style>
