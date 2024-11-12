<template>
  <div class="max-w-md mx-auto p-4 border border-gray-300 rounded-md">
    <form @submit.prevent="handleRegister">
      <div class="mb-4">
        <label for="name" class="block mb-2">Name:</label>
        <input
          type="text"
          id="name"
          v-model="name"
          required
          class="w-full p-2 border border-gray-300 rounded-md text-gray-900"
        />
      </div>
      <div class="mb-4">
        <label for="email" class="block mb-2">Email:</label>
        <input
          type="email"
          id="email"
          v-model="email"
          required
          class="w-full p-2 border border-gray-300 rounded-md text-gray-900"
        />
      </div>
      <div class="mb-4">
        <label for="password" class="block mb-2">Password:</label>
        <input
          type="password"
          id="password"
          v-model="password"
          required
          class="w-full p-2 border border-gray-300 rounded-md text-gray-900"
        />
      </div>
      <div class="mb-4">
        <label for="confirmPassword" class="block mb-2"
          >Confirm Password:</label
        >
        <input
          type="password"
          id="confirmPassword"
          v-model="confirmPassword"
          required
          class="w-full p-2 border border-gray-300 rounded-md text-gray-900"
        />
      </div>
      <div class="flex flex-row space-x-3">
        <button
          type="submit"
          class="w-full p-3 bg-green-500 text-white rounded-md hover:bg-green-700"
        >
          Submit Registration
        </button>
        <button
          type="button"
          @click="handleLogin()"
          class="w-full p-3 bg-blue-500 text-white rounded-md hover:bg-blue-700"
        >
          Go Back
        </button>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router'
import { ref } from 'vue'
import { register } from '@/api/auth'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

const name = ref('')
const email = ref('')
const password = ref('')
const confirmPassword = ref('')

const router = useRouter()

const handleLogin = () => {
  router.push('/login')
}

const handleRegister = async () => {
  // Add your registration logic here
  const data = await register({
    name: name.value,
    email: email.value,
    password: password.value,
    password_confirmation: confirmPassword.value,
  })

  if (data.token !== undefined) {
    toast('Account registered', {
      theme: 'auto',
      autoClose: 3000,
      type: 'default',
    })
  }

  router.push('/login')
}
</script>
