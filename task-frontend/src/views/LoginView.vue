<template>
  <div class="max-w-md mx-auto p-4 border border-gray-300 rounded-md">
    <form @submit.prevent="handleSubmit">
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
      <div class="flex flex-row space-x-3">
        <button
          type="submit"
          class="w-full p-3 bg-blue-500 text-white rounded-md hover:bg-blue-700"
        >
          Login
        </button>
        <button
          type="button"
          class="w-full p-3 bg-green-500 text-white rounded-md hover:bg-green-400"
          @click="handleRegister()"
        >
          Register
        </button>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { login } from '@/api/auth'
import { useRouter } from 'vue-router'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

const email = ref('')
const password = ref('')
const router = useRouter()

const handleRegister = () => {
  // Add your register logic here
  router.push('/register')
}

// Handle form submission
const handleSubmit = async () => {
  // Add your login logic here
  const data = await login({
    email: email.value,
    password: password.value,
  })

  if (data.token) {
    toast('Successfully logged in', {
      theme: 'auto',
      type: 'default',
    })
    localStorage.setItem('token', data.token)
    router.push('/')
  }
}
</script>
