<template>
  <div class="bg-gray-800 rounded-3xl w-96 p-6 shadow-lg">

    
    <div class="flex flex-row justify-center items-center">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8f/Microsoft_Stream.svg/2048px-Microsoft_Stream.svg.png" class="h-8" alt="Flowbite Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Jetxd</span>
    </div>


    <div v-if="mode === 'login'">
      <div class="space-y-6">
        <div class="flex flex-col">
          <label for="username" class="text-gray-300 font-bold">Username:</label>
          <input
            id="username"
            type="text"
            placeholder="Username"
            v-model="username"
            class="text-white p-2 rounded-lg border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>
        <div class="flex flex-col">
          <label for="password" class="text-gray-300 font-bold">Password:</label>
          <input
            id="password"
            type="password"
            placeholder="Password"
            v-model="password"
            class="text-white p-2 rounded-lg border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>
      </div>
      <p class="text-center text-gray-400">
        Don't have an account? 
        <a
          class="text-blue-500 font-semibold cursor-pointer hover:underline"
          @click="mode = 'signup'"
        >
          Sign up
        </a>
      </p>

    <div class="flex flex-row justify-center items-center mt-5">
      <button @click="userStore.login(username, password)" class="bg-green-500 rounded-lg p-3 text-white font-semibold min-w-2/6 cursor-pointer ">Login</button>
    </div>

    </div>

    <div v-else>
      <div class="space-y-6">
        <div class="flex flex-col">
          <label for="name" class="text-gray-300 font-bold">Username:</label>
          <input
            id="name"
            type="text"
            placeholder="Username"
            v-model="username"
            class="text-white p-2 rounded-lg border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>
        <div class="flex flex-col">
          <label for="signup-username" class="text-gray-300 font-bold">Email:</label>
          <input
            id="signup-username"
            type="email"
            placeholder="Email"
            v-model="email"
            class="text-white p-2 rounded-lg border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>
        <div class="flex flex-col">
          <label for="signup-password" class="text-gray-300 font-bold">Password:</label>
          <input
            id="signup-password"
            type="password"
            placeholder="Password"
            v-model="password"
            class="text-white p-2 rounded-lg border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>
      </div>
      <p class="text-center text-gray-400">
        Already have an account? 
        <a
          class="text-blue-500 font-semibold cursor-pointer hover:underline"
          @click="mode = 'login'"
        >
          Login
        </a>
      </p>
          <div class="flex flex-row justify-center items-center mt-5">
      <button @click="userStore.signUp(username,email, password)" class="bg-green-500 rounded-lg p-3 text-white font-semibold min-w-2/6 cursor-pointer ">Register</button>
    </div>
    </div>
  </div>

</template>

<script setup>
import { ref } from 'vue';
import { useUserStore } from '@/stores/userStore';

const userStore = useUserStore();

const mode = ref('login');

const username = ref([]);

const password = ref([]);

const email = ref([]);



</script>
