<template>
  <div class="relative h-screen w-screen overflow-hidden bg-gradient-to-tr from-gray-950 to-gray-800">

    <!-- Modal de mídia -->
    <MediaModal v-if="selectedMedia" :mediaInfo="selectedMedia" />

    <!-- Sessões de mídias -->
    <MediaRoll v-if="mediaList.length" :mediaList="mediaList" title="New Series" />
    <MediaRoll v-if="mediaList.length" :mediaList="mediaList" title="Recommended for You" />

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { storeToRefs } from 'pinia'
import { useSelectedMediaStore } from '@/stores/selectedMedia.js'
import api from '../services/api.js'

import MediaRoll from '../components/MediaRoll.vue'
import MediaModal from '../components/MediaModal.vue'

const mediaList = ref([])

const select = useSelectedMediaStore()
const { selectedMedia } = storeToRefs(select)

onMounted(async () => {
  const res = await api.get('/media')
  mediaList.value = res.data
})
</script>
