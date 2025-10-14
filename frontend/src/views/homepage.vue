<template>
    <div class="relative h-screen w-screen overflow-hidden bg-gradient-to-tr from-gray-950 to-gray-800">


        <MediaRoll v-if="mediaList.length" :mediaList="mediaList" :title="'New Series'"/>

        <MediaRoll v-if="mediaList.length" :mediaList="mediaList" :title="'Reccomended for You'"/>

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../services/api.js'
import MediaRoll from '../components/MediaRoll.vue'

const mediaList = ref([])

onMounted(async () => {
  const res = await api.get('/media')
  mediaList.value = res.data
})
</script>