<template>
<div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
<div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
  <div class="flex flex-col overflow-y-auto md:flex-row">
    <div class="h-32 md:h-auto md:w-1/2">
      <img
          aria-hidden="true"
          class="object-cover w-full h-full dark:hidden"
          src="img/create-account-office.jpeg"
          alt="Office"
      />
      <img
          aria-hidden="true"
          class="hidden object-cover w-full h-full dark:block"
          src="img/create-account-office-dark.jpeg"
          alt="Office"
      />
    </div>
    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
      <div class="w-full">
        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
          Create account
        </h1>

        <form @submit.prevent="submit">

          <div class="mt-4">
            <label
                for="name"
                class="block text-sm font-medium text-gray-700"
            >
              Name
            </label>
            <div class="mt-1">
              <input
                  v-model="name"
                  id="name"
                  name="name"
                  type="text"
                  placeholder="You name"
                  required
                  autofocus
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
          </div>

          <div class="mt-4">
            <label
                for="email"
                class="block text-sm font-medium text-gray-700"
            >
              Email
            </label>
            <div class="mt-1">
              <input
                  v-model="email"
                  id="email"
                  name="email"
                  type="email"
                  placeholder="You email"
                  required
                  autofocus
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
          </div>

          <div class="mt-4">
            <label
                for="password"
                class="block text-sm font-medium text-gray-700"
            >
              Password
            </label>
            <div class="mt-1">
              <input
                  v-model="password"
                  id="password"
                  name="password"
                  type="password"
                  placeholder="***************"
                  required
                  autocomplete="new-password"
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
          </div>

          <div class="mt-4">
            <label
                for="password_confirmation"
                class="block text-sm font-medium text-gray-700"
            >
              Confirm Password
            </label>
            <div class="mt-1">
              <input
                  v-model="password_confirmation"
                  id="password_confirmation"
                  name="password"
                  type="password"
                  placeholder="***************"
                  required
                  autocomplete="new-password"
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
          </div>
          <button
              type="submit"
              class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
            Register
          </button>
        </form>

        <p class="mt-4">
            <router-link
                to="/login"
                class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
            >
              Already registered?
            </router-link>
          <router-link
              to="/"
              class="ml-8 text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
          >
            Main
          </router-link>
        </p>
      </div>
    </div>
  </div>
</div>
</div>

</template>

<script>

import {ref} from 'vue';
import axios from 'axios'
import {useRouter} from 'vue-router'

export default {
  name: "Register",
  setup() {
    const name = ref('');
    const email = ref('');
    const password = ref('');
    const router = useRouter();

    const submit = async () => {
      await axios.post('/register', {
        name: name.value,
        email: email.value,
        password: password.value
      })

      await router.push('/login')
    };

    return {
      name,
      email,
      password,
      submit
    };
  }
}
</script>

<style scoped>

</style>