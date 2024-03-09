<template>
  <header class="flex justify-between border-b border-slate-200 px-10 py-8">
    <router-link to="/">
      <div class="flex items-center gap-4">
        <img src="/logo.png" alt="Logo" class="w-11" />
        <div>
          <h2 class="font-bold text-xl uppercase">Vue Sneakers</h2>
          <p class="text-slate-400">Shop best sneakers</p>
        </div>
      </div>
    </router-link>

    <ul class="flex items-center gap-10">
      <router-link to="/shopping-cart">
        <li class="flex items-center gap-3 cursor-pointer">
          <img src="/cart.svg" alt="Cart" />
          <b>1205 $</b>
        </li>
      </router-link>
      <router-link to="/bookmarks">
        <li class="flex items-center gap-3 cursor-pointer">
          <img src="/heart.svg" alt="Favorite" />
          <span>Bookmarks</span>
        </li>
      </router-link>
      <router-link to="/account">
        <li class="flex items-center gap-3 cursor-pointer">
          <img src="/profile.svg" alt="Favorite" />
          <span>Account</span>
        </li>
      </router-link>
    </ul>
  </header>
</template>


<script>
export default{
  name:'headerComponent',
}
</script>
