import { createRouter, createWebHistory } from 'vue-router';

// import store from './store' // Commented out as it is not used

import MainLayout from '../layouts/MainLayout.vue';
import BlankLayout from '../layouts/BlankLayout.vue';

import Home from '@/views/Dashboard.vue'; 
import Catalog from '@/views/Catalog.vue';
import Status from '@/views/Status.vue';
import Riwayat from '@/views/Riwayat.vue';
import Review from '@/views/Review.vue';
import Peminjaman from '@/views/Peminjaman.vue';
import Pengembalian from '@/views/Pengembalian.vue';
import Ebooks from '@/views/Ebooks.vue';
import Setting from '@/views/Setting.vue';

import Admin from '@/views/Admin.vue';
import Akses from '@/views/Akses.vue';
import Guru from '@/views/Guru.vue';
import Notifikasi from '@/views/Notifikasi.vue';
import Pemberitahuan from '@/views/Pemberitahuan.vue';
import SecondCatalog from '@/views/SecondCatalog.vue';
import Siswa from '@/views/Siswa.vue';
import SignIn from '@/views/SignIn.vue';
import Warning from '@/views/Warning.vue';
import LoginPage from '@/views/LoginPage.vue'

const routes = [
  
  
  {

    path: '/auth',
    component: BlankLayout,
    children: [
      {path: 'login', name:'Login', component:Siswa,meta: { layout: 'BlankLayout' }}
    ],
  },
  {
    
    path: '/siswa',
    component: MainLayout,
    children: [
      { path: '', name: 'Home', component: Home },
      { path: 'catalog', name: 'Catalog', component: Catalog },
      { path: 'status', name: 'Status', component: Status },
      { path: 'peminjaman', name: 'Peminjaman', component: Peminjaman },
      { path: 'pengembalian', name: 'Pengembalian', component: Pengembalian },
      { path: 'ebooks', name: 'Ebooks', component: Ebooks },
      { path: 'setting', name: 'Setting', component: Setting },
      { path: 'riwayat', name: 'Riwayat', component: Riwayat },
      { path: 'review', name: 'Review', component: Review },
    ],
    beforeEnter: (to, from, next) => {
      const token = localStorage.getItem('token')
      if (token) {
        next() // Jika ada token, lanjutkan ke rute tujuan
      } else {
        next('/auth/login') // Jika tidak ada token, arahkan ke halaman login
      }
    }
  },
  {
    path: '/admin',
    component: BlankLayout,
    children: [
      { path: '', name: 'Admin', component: Admin },
      { path: 'akses', name: 'Akses', component: Akses },
      { path: 'guru', name: 'Guru', component: Guru },
      { path: 'siswa', name: 'Siswa', component: Siswa },
      { path: 'signin', name: 'SignIn', component: SignIn },
    ],
  },
  {
    path: '/secondcatalog',
    component: BlankLayout,
    children: [
      {
        path: '/second-catalog/:category',
        name: 'SecondCatalog',
        component: SecondCatalog,
        meta: { layout: 'BlankLayout' },  // Tentukan layout yang digunakan
        props: true,
      },
    ],
  },
  { 
    path: '/warning', 
    component: BlankLayout,
    children: [
      {
        path: '/warning',
        name: 'Warning', 
        component: Warning,
        meta: { layout: 'BlankLayout' },  // Tentukan layout yang digunakan
        props: true,
      },
    ],
  },
  { 
    path: '/notifikasi', 
    component: BlankLayout,
    children: [
      {
        path: '/notifikasi',
        name: 'Notifikasi',
        component: Notifikasi,
        meta: { layout: 'BlankLayout' },  // Tentukan layout yang digunakan
        props: true,
       },
    ],
  },
  {
    path: '/pemberitahuan',
    name: 'Pemberitahuan',
    component: Pemberitahuan,
    meta: { layout: 'BlankLayout' }, 
    props: true,
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});


router.beforeEach((to, from, next) => {
  // Jika route memerlukan autentikasi, cek apakah ada token
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!localStorage.getItem('token')) {
      next('/login'); // Redirect ke login jika tidak ada token
    } else {
      next(); // Biarkan masuk ke halaman yang diminta
    }
  } else {
    next();
  }
});

export default router;