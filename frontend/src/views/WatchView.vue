<template>
  <div class="fixed inset-0 bg-black flex items-center justify-center z-50">
    <video
      v-if="videoUrl"
      :src="videoUrl"
      class="w-full h-full object-contain"
      controls
      autoplay
      @ended="handleEnded"
    ></video>

    <div
      class="absolute top-4 left-4 text-white text-2xl cursor-pointer hover:opacity-80"
      @click="goBack"
    >
      ← Voltar
    </div>

    <div v-if="loading" class="text-white text-lg">Carregando vídeo...</div>
    <div v-if="error" class="text-red-400">{{ error }}</div>
  </div>
</template>

<script setup>
import { onMounted, onBeforeUnmount, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useSelectedMediaStore } from '../stores/selectedMedia.js' // ajuste se o nome for diferente

const route = useRoute()
const router = useRouter()
const mediaStore = useSelectedMediaStore()

const videoUrl = ref(null)
const loading = ref(true)
const error = ref(null)

const goBack = () => {
  router.back()
}

const handleEnded = () => {
  router.back()
}

onMounted(async () => {
  const id = route.params.id

  try {
    const blob = await mediaStore.stream(id)
    videoUrl.value = URL.createObjectURL(blob)
  } catch (err) {
    console.error('Erro ao carregar vídeo:', err)
    error.value = 'Não foi possível carregar o vídeo.'
  } finally {
    loading.value = false
  }
})

onBeforeUnmount(() => {
  if (videoUrl.value) {
    URL.revokeObjectURL(videoUrl.value)
  }
})
</script>

<style scoped>
video::-webkit-media-controls-panel {
  background-color: rgba(0, 0, 0, 0.6);
}
</style>
