
<template>

  <nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8f/Microsoft_Stream.svg/2048px-Microsoft_Stream.svg.png" class="h-8" alt="Flowbite Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Jetxd</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>


        <input
      v-model="searchQuery"
      @input="debouncedSearch"
      type="text"
      placeholder="Search series..."
      class="px-3 py-2 rounded bg-gray-800 focus:outline-none focus:ring-2 text-white focus:ring-blue-500"
    />

  <template v-if="!userStore.userToken">
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li>
            <RouterLink to="/" class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</RouterLink>
          </li>
          <li>
            <RouterLink to="/login" class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Login</RouterLink>
          </li>
        </ul>
      </div>
  </template>

    <template v-else>
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li>
            <RouterLink to="/" class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</RouterLink>
          </li>

          <!-- <li>
                  <button
                    @click="ping"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg"
                  >
                    Test Auth Ping
                  </button>
          </li> -->

          <li>
            
            <div class="z-50 relative inline-block text-left dropdown">

              <span class="rounded-md shadow-sm"
                ><button class="block py-2 px-3 cursor-pointer text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" 
                type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">

                  <div class="flex items-center">
                    <span>Profile <img v-if="userStore.user.membership_plan_id != 0" class="h-5 ml-2 inline-block" src="/crown.png"></img></span>
                  </div>

                  </button>
              </span>

              <div class="hidden dropdown-menu">
                <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                  <div class="px-4 py-3">
                    <p class="text-sm leading-5">Signed in as</p>
                    <p class="text-sm font-medium leading-5 text-gray-900 truncate">{{ userStore.user.name }}</p>
                  </div>

                  <div class="py-1">
                    <RouterLink to="/profile" class="text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left" aria-current="page">My Account</RouterLink>
                  </div>
                  
                  <div class="py-1">
                    <RouterLink to="/membership" class="text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left" aria-current="page">Membership</RouterLink>
                  </div>

                  <div class="py-1">
                    <button @click="userStore.logout()" class="text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left cursor-pointer" role="menuitem" >Sign out</button>
                  </div>


                </div>
              </div>
            </div>
          </li>

        </ul>
      </div>
    </template>






  </div>
</nav>





<div v-if="searchQuery && results.length" class="absolute left-1/2 transform -translate-x-1/2 mt-4 z-50 w-full max-w-4xl px-4">
  <div class="bg-gray-900/90 backdrop-blur-sm rounded-2xl shadow-2xl border border-gray-700">
    <h2 class="text-lg font-semibold text-white px-6 pt-4">Results:</h2>

    <ul class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 p-6">
      <li
        v-for="item in results"
        :key="item.id"
        class="relative group cursor-pointer transition-transform duration-300 hover:scale-105"
      >
        <img
          :src="item.image_url"
          :alt="item.name"
          class="w-full h-48 object-cover rounded-lg shadow-md"
        />
        <div
          class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center rounded-lg"
        >
          <span class="text-white font-semibold text-center px-2">{{ item.name }}</span>
        </div>
      </li>
    </ul>
  </div>
</div>

</template>



<script setup>
import { ref, computed } from 'vue'
import axios from 'axios'
import { debounce } from 'lodash'
import { useUserStore } from '@/stores/userStore'

const searchQuery = ref('')
const results = ref([])
const userStore = useUserStore();

computed(() => userStore.isAuthenticated)

const ping = () => {
  userStore.ping()
}

// Função real de busca
const searchMedia = async () => {
  const query = searchQuery.value.trim()
  if (query.length < 1) return // Evita buscas muito curtas
  try {
    const response = await axios.get('http://localhost:8000/api/media/search', {
      params: { q: query },
    })
    results.value = response.data
    console.log(results.value)
  } catch (error) {
    console.error('Erro na busca:', error)
  }
}

// Cria uma versão "com atraso" da função
const debouncedSearch = debounce(searchMedia, 400)
</script>

<style>
.dropdown:focus-within .dropdown-menu {
  /* @apply block; */
  display:block;
}
</style>