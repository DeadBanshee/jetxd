<template>

  <div class="relative h-screen w-screen overflow-hidden bg-gradient-to-tr from-gray-950 to-gray-800">

    <div class="flex flex-row min-h-screen justify-center items-center">
      <div class="bg-gray-600 rounded-2xl min-w-2/4 min-h-3/4 text-white p-6 gap-y-5 space-y-5">
        <h1 class="font-bold text-3xl">Congratulations, you are now a member!</h1>
        <p>
          With your new plan, you'll get full access to all content on the platform.
        </p>
        <p>
          Thank you for supporting Jetxd.
        </p>
            <div class="flex flex-row justify-center items-center">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8f/Microsoft_Stream.svg/2048px-Microsoft_Stream.svg.png" class="h-8" alt="Flowbite Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Jetxd</span>
    </div>

      </div>
    </div>

  </div>

</template>

<script setup>
/*
import { onMounted } from 'vue';
import axios from 'axios';
import { useUserStore } from '@/stores/userStore';

const userStore = useUserStore();

onMounted(async () => {
  const sessionId = new URLSearchParams(window.location.search).get('session_id')
  await axios.post('http://localhost:8000/api/membership/confirm', { session_id: sessionId }, {
    headers: { Authorization: `Bearer ${userStore.userToken}` }
  })
})*/
</script>
