<script setup>
import HeaderComponent from "@/components/Header.vue";
import {Notifications} from "@kyvg/vue3-notification";
</script>

<template>
  <notifications class="m-2" />
  <div class="bg-white w-3/5 m-auto rounded-xl shadow-xl shadow-grey-200 mt-20">
    <HeaderComponent />
    <router-view></router-view>
  </div>
</template>
