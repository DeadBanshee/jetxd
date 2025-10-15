<template>

  <div class="relative h-screen w-screen overflow-hidden bg-gradient-to-tr from-gray-950 to-gray-800">

    <div class="flex flex-row min-h-screen justify-center items-center">
      <LoginForm/>
    </div>

  </div>

</template>

<script setup>
import { ref, onMounted } from 'vue'
import { storeToRefs } from 'pinia'
import { useSelectedMediaStore } from '@/stores/selectedMedia.js'
import api from '../services/api.js'

import LoginForm from '../components/LoginForm.vue'



</script>
