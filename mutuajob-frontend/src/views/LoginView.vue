<template>
  <div class="min-h-screen flex items-center justify-center px-6">
    
    <div class="w-full max-w-md bg-zinc-950 border border-zinc-800 rounded-3xl p-8 shadow-2xl">

      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">Iniciar Sesión</h1>
        <p class="text-zinc-400 text-sm">Accede a tu cuenta de MutuaJob</p>
      </div>

      <div v-if="error" class="mb-4 bg-red-900/30 border border-red-700 text-red-400 text-sm rounded-xl p-3">
        {{ error }}
      </div>

      <form @submit.prevent="login" class="space-y-5">

        <div>
          <label class="block text-sm text-zinc-300 mb-2">Correo electrónico</label>
          <input
            v-model="form.email"
            type="email"
            placeholder="Ingresa tu correo"
            class="w-full bg-zinc-900 border border-zinc-700 text-white px-4 py-3 rounded-xl outline-none focus:border-red-600"
          >
        </div>

        <div>
          <label class="block text-sm text-zinc-300 mb-2">Contraseña</label>
          <input
            v-model="form.password"
            type="password"
            placeholder="Ingresa tu contraseña"
            class="w-full bg-zinc-900 border border-zinc-700 text-white px-4 py-3 rounded-xl outline-none focus:border-red-600"
          >
        </div>

        <button
          type="submit"
          class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-xl transition"
        >
          Iniciar sesión
        </button>

      </form>

      <div class="mt-6">
        <router-link
          to="/register"
          class="block w-full text-center bg-zinc-800 hover:bg-zinc-700 text-white font-medium py-3 rounded-xl transition"
        >
          No tienes usuario, crea una cuenta
        </router-link>
      </div>

    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()

const form = reactive({
  email: '',
  password: ''
})

const error = ref(null)

const login = async () => {
  try {

    error.value = null

    const res = await axios.post(
      `${import.meta.env.VITE_API_URL}/login`,
      form
    )

    localStorage.setItem('token', res.data.token)
    localStorage.setItem('user', JSON.stringify(res.data.user))

    // redirección por rol
    const role = res.data.user.roles[0]

    if (role === 'administrador') router.push('/admin')
    else if (role === 'empleador') router.push('/empleador')
    else router.push('/trabajador')

  } catch (err) {
    error.value = err.response?.data?.message || 'Error al iniciar sesión'
  }
}
</script>