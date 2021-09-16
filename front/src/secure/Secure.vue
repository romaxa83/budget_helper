<template>

<!--  <Nav />-->

<!--  <div class="h-screen bg-white overflow-hidden flex">-->

<!--    &lt;!&ndash; Static sidebar for desktop &ndash;&gt;-->
<!--    <div class="hidden md:flex md:flex-shrink-0">-->
<!--      <div class="w-64 flex flex-col">-->
<!--&lt;!&ndash;        <Menu />&ndash;&gt;-->
<!--      </div>-->
<!--    </div>-->

<!--    &lt;!&ndash; Content area &ndash;&gt;-->
<!--    <div class="flex-1 flex flex-col">-->

<!--      <main class="flex-1 overflow-y-auto focus:outline-none">-->
<!--        <div class="relative max-w-7xl mx-auto md:px-8 xl:px-0">-->

          <router-view v-if="user?.id" />

<!--        </div>-->
<!--      </main>-->

<!--    </div>-->
<!--  </div>-->

</template>

<script lang="ts">
import {onMounted, ref} from 'vue';
import axios from 'axios';
import {useRouter} from 'vue-router'
import {useStore} from 'vuex'
import Nav from '@/components/Nav.vue'
import Menu from '@/components/Menu.vue'
// import {User} from '@/classes/user'

export default {
  name: "Secure",

  components: {
    Nav,
    Menu
  },

  setup () {
    const router = useRouter();
    const user = ref(null);
    // const store = useStore();

    onMounted(async () => {
      try {
        const res = await axios.get('/user');
        console.log(res);
        //
        // const u: User = res.data.data;
        //
        // await store.dispatch('User/setUser', new User(
        //     u.id,
        //     u.name,
        //     u.email,
        //     u.role
        // ));
        //
        // user.value = u;
        user.value = res.data.data;
        // console.log(user.value);
      } catch (e){
        await router.push('/')
      }
    });

    const logout = () => {
      localStorage.clear();
      console.log('logout');
      router.push('/');
    }

    return {
      logout,
      user
    };
  }
}
</script>