<template>
  <div 
    class="fixed inset-0 bg-black/80 backdrop-blur-sm flex justify-center items-center z-50 transition-opacity duration-500"
  >
    <div 
      class="relative bg-[#141414] text-white rounded-2xl overflow-hidden w-full max-w-3xl shadow-2xl transform scale-100 animate-fadeIn"
    >
      <!-- Botão de fechar -->
      <button 
        class="absolute top-4 right-4 bg-black/60 hover:bg-black text-white rounded-full w-10 h-10 flex items-center justify-center text-lg font-bold transition z-50 cursor-pointer"
        @click="select.resetState"
      >
        ✕
      </button>

      <!-- Imagem de destaque -->
      <div class="relative">
        <img
          :src="select.selectedMedia.image_url"
          :alt="select.selectedMedia.name"
          class="w-full h-72 object-cover brightness-90"
        />
        <div class="absolute inset-0 bg-gradient-to-t from-[#141414] via-transparent"></div>
      </div>

      <!-- Informações da mídia -->
      <div class="p-6 space-y-4">
        <h2 class="text-3xl font-bold">{{ select.selectedMedia.name }}</h2>
        <p class="text-gray-300 text-sm leading-relaxed line-clamp-4">
          {{ select.selectedMedia.description || 'Sem descrição disponível.' }}
        </p>

        <!-- Botões de ação -->
        <div class="flex space-x-3 mt-4">
          <button 
            class="bg-white text-black font-semibold px-6 py-2 rounded-md hover:bg-gray-300 transition"
            @click="select.stream(select.selectedMedia.id)"
          >

            <div class="play-btn">
              <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26">
                  <polygon points="9.33 6.69 9.33 19.39 19.3 13.04 9.33 6.69"/>
                  <path d="M26,13A13,13,0,1,1,13,0,13,13,0,0,1,26,13ZM13,2.18A10.89,10.89,0,1,0,23.84,13.06,10.89,10.89,0,0,0,13,2.18Z"/>
                </svg> 
              </a>
            </div> Assistir

          </button>

          <button 
            class="bg-gray-700 text-white font-semibold px-6 py-2 rounded-md hover:bg-gray-600 transition"
          >
            + Minha Lista
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useSelectedMediaStore } from '@/stores/selectedMedia'

const select = useSelectedMediaStore()
</script>

<style scoped>
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: scale(0.95);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

.animate-fadeIn {
  animation: fadeIn 0.3s ease-out;
}

/* Caso queira limitar o texto */
.line-clamp-4 {
  display: -webkit-box;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>