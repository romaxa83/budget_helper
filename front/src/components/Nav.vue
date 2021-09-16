<template>

  <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
    <div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
      <!-- Mobile hamburger -->
      <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple">
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
        </svg>
      </button>
      <!-- Search input -->
      <div class="flex justify-center flex-1 lg:mr-32">
        <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
          <div class="absolute inset-y-0 flex items-center pl-2">
            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
            </svg>
          </div>
          <input class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text" placeholder="Search for projects" aria-label="Search" />
        </div>
      </div>
      <ul class="flex items-center flex-shrink-0 space-x-6">
        <!-- Theme toggler -->
        <li class="flex">
          <button class="rounded-md focus:outline-none focus:shadow-outline-purple"  aria-label="Toggle color mode">
            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
              <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z">
              </path>
            </svg>
          </button>
        </li>
        <!-- Notifications menu -->
        <li class="relative">
          <button class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple"

                  aria-label="Notifications" aria-haspopup="true">
            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
              </path>
            </svg>
            <!-- Notification badge -->
            <span aria-hidden="true" class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"></span>
          </button>

        </li>
        <!-- Profile menu -->
        <li class="relative">
          <button class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none" @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account" aria-haspopup="true">
            <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" aria-hidden="true" />
          </button>
          <template x-if="isProfileMenuOpen">
            <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu" class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700" aria-label="submenu">
              <li class="flex">
                <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200" href="/user/profile">
                  <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                    </path>
                  </svg>
                  <span>{{ __('Profile') }}</span>
                </a>
              </li>


              <div class="border-t border-gray-100"></div>

              <!-- Team Management -->
              @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
              <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Manage Team') }}
              </div>

              <li class="flex">
                <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200" href="/teams/{{ Auth::user()->currentTeam->id }}">
                  <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                    </path>
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  <span>{{ __('Team Settings') }}</span>
                </a>
              </li>


              <div class="border-t border-gray-100"></div>




              <div class="border-t border-gray-100"></div>


                <li class="flex">
                  <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                      <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                      </path>
                    </svg>
                    <span>{{ __('Logout') }}</span>
                  </a>
                </li>
              </form>
            </ul>
          </template>
        </li>
      </ul>
    </div>
  </header>


  <!--  <div class="relative bg-white">-->
<!--    <div class="absolute inset-0 shadow z-30 pointer-events-none" aria-hidden="true"></div>-->
<!--    <div class="relative z-20">-->
<!--      <div class="max-w-7xl mx-auto flex justify-between items-center px-4 py-5 sm:px-6 sm:py-4 lg:px-8 md:justify-start md:space-x-10">-->
<!--        <div>-->
<!--          <a href="#" class="flex">-->
<!--            <span class="sr-only">Workflow</span>-->
<!--            <img class="h-8 w-auto sm:h-10" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="">-->
<!--          </a>-->
<!--        </div>-->
<!--        <div class="hidden md:flex-1 md:flex md:items-center md:justify-between">-->

<!--          <nav class="flex space-x-10">-->
<!--            <div>-->
<!--              <button type="button" class="text-gray-500 group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-expanded="false">-->
<!--                <span>Solutions</span>-->
<!--                <svg class="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">-->
<!--                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />-->
<!--                </svg>-->
<!--              </button>-->
<!--            </div>-->
<!--&lt;!&ndash;            <router-link to="/profile" class="text-base font-medium text-gray-500 hover:text-gray-900">{{user.fullName}}</router-link>&ndash;&gt;-->
<!--&lt;!&ndash;            &lt;!&ndash;    <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">&ndash;&gt;&ndash;&gt;-->
<!--&lt;!&ndash;            &lt;!&ndash;      Docs&ndash;&gt;&ndash;&gt;-->
<!--&lt;!&ndash;            &lt;!&ndash;    </a>&ndash;&gt;&ndash;&gt;-->
<!--&lt;!&ndash;            <div>&ndash;&gt;-->

<!--            </div>-->
<!--          </nav>-->

<!--          <div class="flex items-center md:ml-12">-->
<!--            <a href="/login" class="text-base font-medium text-gray-500 hover:text-gray-900">-->
<!--              Sign in-->
<!--            </a>-->
<!--            <a href="/register" class="ml-8 inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">-->
<!--              Sign up-->
<!--            </a>-->
<!--            <a href="javascript:void(0)"-->
<!--               @click="logout"-->
<!--               class="ml-8 inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">-->
<!--              Sign out-->
<!--            </a>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
</template>

<script>
import {useRouter} from "vue-router";
import {useStore} from "vuex";
import {computed} from "vue";
import axios from "axios";

export default {
  name: "Nav",

  setup () {
    const router = useRouter();
    // const store = useStore();

    // const user = computed(() => store.state.User.user);

    const logout = async () => {
      await axios.post('logout',{})

      localStorage.clear();
      router.push('/');
    }

    return {
      user,
      logout,
    };
  }
}
</script>

<style scoped>

</style>