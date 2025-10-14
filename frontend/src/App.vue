<template>
  <div class="min-h-screen bg-gray-50 text-gray-800 overflow-hidden">
    <Navbar />
    <router-view />
  </div>
</template>

<script setup>
import Navbar from './components/Navbar.vue'
</script>
