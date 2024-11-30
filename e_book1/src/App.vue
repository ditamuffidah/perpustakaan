<template>
  <div id="app">
    <!-- Hanya tampilkan Header dan Sidebar di MainLayout -->
    <Header v-if="showHeader" />
    <div class="container">
      <Sidebar v-if="showSidebar" />
      <main>
        <!-- Render layout yang benar berdasarkan meta dari rute -->
        <component :is="layout">
          <router-view />
        </component>
      </main>
    </div>
  </div>
</template>

<script>
import Header from './components/Header.vue';
import Sidebar from './components/Sidebar.vue';
import MainLayout from './layouts/MainLayout.vue';
import BlankLayout from './layouts/BlankLayout.vue';

export default {
  name: 'App',
  components: {
    Header,
    Sidebar,
    MainLayout,
    BlankLayout,
  },
  computed: {
    layout() {
      // Gunakan layout BlankLayout atau MainLayout berdasarkan rute
      return this.$route.meta.layout === 'BlankLayout' ? BlankLayout : MainLayout;
    },
    showHeader() {
      // Tampilkan Header hanya jika menggunakan MainLayout
      return this.$route.meta.layout !== 'BlankLayout';
    },
    showSidebar() {
      // Tampilkan Sidebar hanya jika menggunakan MainLayout
      return this.$route.meta.layout !== 'BlankLayout';
    },
  },
};
</script>

<style>
  #app {
    display: flex;
    flex-direction: column;
  }
  .container {
    display: flex;
  }
  main {
    flex: 1;
    padding: 1rem;
  }
</style>
