<template>
  <div class="flex flex-wrap justify-center gap-6">
    <div
      v-for="plan in membershipStore.plans"
      :key="plan.id"
      class="bg-gray-800 rounded-3xl w-80 sm:w-96 p-6 shadow-lg transform hover:scale-105 transition-transform duration-300"
    >
      <!-- Título -->
      <h2 class="text-2xl font-bold text-white text-center mb-4">{{ plan.title }}</h2>

      <!-- Descrição -->
      <p class="text-gray-300 text-center mb-6">{{ plan.description || 'No description available' }}</p>

      <!-- Valor -->
      <div class="text-center">
        <span class="text-white text-xl font-semibold">${{ plan.value }}</span>
      </div>

      <!-- Botão de Assinar (opcional) -->
      <div class="mt-6 flex justify-center">
        <button @click="startSubscribe(plan.stripe_id)"
          class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-full shadow-md transition-colors duration-300 cursor-pointer"
        >
          Subscribe
        </button>
      </div>
    </div>
  </div>
</template>


<script setup>
import { onMounted, ref } from 'vue';
import { useUserStore } from '@/stores/userStore';
import { useMembershipStore } from '@/stores/membershipStore';

const userStore = useUserStore();

const membershipStore = useMembershipStore();

const startSubscribe = async(price_id) =>{
  const res = await membershipStore.subscribe(price_id)
  window.location.href = res.url
}


onMounted(async () => {
  membershipStore.fetchPlans();
})
</script>
