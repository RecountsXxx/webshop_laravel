<template>
  <div class="col-lg-4 col-md-6 col-sm-6">
    <div class="blog__item">
      <div :style="{ backgroundImage: 'url(' + image + ')' }" class="blog__item__pic set-bg"></div>
      <router-link :to="'/blog/' + id">
        <div class="blog__item__text">
          <div class="flex flex-row gap-1">
            <img style="width: 15px; height: 15px;" src="../../assets/img/icon/calendar.png" alt="">
            <span>{{ formatDate(created_at)}}</span>
          </div>
          <h5>{{title}}</h5>
          <label>Read More</label>
        </div>
      </router-link>
    </div>
  </div>
</template>

<script>
export default{
  name:'blogItem',
  props:{
    id:String,
    image:String,
    title:String,
    created_at:String,
  },
  data(){
    return{
      formattedDate: '',
    }
  },
  mounted() {

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


<style scoped>

</style>