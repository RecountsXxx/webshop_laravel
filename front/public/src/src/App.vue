<script setup>
import HeaderComponent from "@/components/General/Header.vue";
import {Notifications} from "@kyvg/vue3-notification";
import FooterComponent from "@/components/General/Footer.vue";

</script>

<template>
  <notifications class="m-2" />
  <div class="bg-white">
    <HeaderComponent />
    <router-view></router-view>
    <FooterComponent/>
  </div>
</template>

<style>
@import "style.css";
body, h1, h2, h3, p, label
{
  font-family: 'Roboto', sans-serif;
}
</style>


