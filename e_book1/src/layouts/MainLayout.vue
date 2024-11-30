<template>
  <div>
    <!-- Header dan sidebar akan disembunyikan jika route adalah /secondcatalog -->
    <header v-if="showHeaderAndSidebar">
      <!-- header content -->
    </header>
    <sidebar v-if="showHeaderAndSidebar">
      <!-- sidebar content -->
    </sidebar>
    <router-view />
  </div>
</template>

<script>
import Header from '@/components/Header.vue';
import Sidebar from '@/components/Sidebar.vue';

export default {
  components: {
    Header,
    Sidebar,
  },
  computed: {
    // Cek jika rute saat ini adalah /secondcatalog, maka sembunyikan header dan sidebar
    showHeaderAndSidebar() {
      return this.$route.path !== '/secondcatalog';
    }
  }
};
</script>

<style>
.container {
  display: flex;
}
main {
  flex: 1;
  padding: 1rem;
}
</style>