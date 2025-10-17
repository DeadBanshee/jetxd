<template>
  <div class="py-4 px-5">
    <!-- Título da seção -->
    <h1 class="text-white text-3xl font-bold mb-4">{{ title }}</h1>

    <!-- Scroll horizontal dos itens -->
    <div class="flex overflow-x-auto space-x-4 pb-2">
      <div v-for="media in mediaList" :key="media.id" class="flex-shrink-0 w-48">
        <img
          :src="media.image_url"
          :alt="media.name"
          @click="handleClick(media.id)"
          class="w-full h-64 object-cover rounded-lg transition-transform duration-300 hover:scale-110 cursor-pointer"
        />
        <h3 class="mt-2 text-center font-semibold text-white text-lg">{{ media.name }}</h3>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'
import { useSelectedMediaStore } from '@/stores/selectedMedia';
import { useUserStore } from '@/stores/userStore';
import  router  from '@/router'

const selectedMedia = useSelectedMediaStore();
const userStore = useUserStore();

const handleClick = (media_id) => {
  if(userStore.user.membership_plan_id != 0){
    selectedMedia.selectMedia(media_id)
  }else{
    router.push('/membership');
  }
}

const props = defineProps({
  mediaList: {
    type: Array,
    required: true,
  },
  title: {
    type: String,
    required: true,
  },
})
</script>
