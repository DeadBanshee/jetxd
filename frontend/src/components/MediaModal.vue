<template>
  <div class="fixed inset-0 bg-black/60 flex justify-center items-center z-50">
    <div class="relative bg-slate-800 text-white p-6 rounded-xl w-full max-w-md shadow-2xl">
      <button class="bg-red-500 rounded-2xl font-semibold px-3 py-1" @click="select.resetState()">X</button>
      <!-- <p>{{ select.selectedMedia }}</p> -->
      <p>{{ select.selectedMedia.name }}</p>
        <img
          :src="select.selectedMedia.image_url"
          :alt="select.selectedMedia.name"
          class="w-full h-64 object-cover rounded-lg transition-transform duration-300 hover:scale-110 cursor-pointer"
        />
    </div>
  </div>
</template>

<script setup>
import { useSelectedMediaStore } from '@/stores/selectedMedia'

const select = useSelectedMediaStore()
</script>