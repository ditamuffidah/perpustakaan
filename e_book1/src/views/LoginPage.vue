<!-- src/views/LoginPage.vue -->

<template>
  <div class="login-container">
    <form @submit.prevent="login">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" v-model="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" v-model="password" required />
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
import axios from '../axios'

export default {
  data() {
    return {
      email: '',
      password: '',
    }
  },
  methods: {
    login() {
      axios.post('/login', { email: this.email, password: this.password })
        .then(response => {
          // Jika login berhasil, simpan token ke localStorage
          localStorage.setItem('token', response.data.token);
          // Redirect ke halaman utama
          this.$router.push('/');
        })
        .catch(error => {
          console.error(error);
          // Tampilkan pesan error jika perlu
        });
    }
  }
}
</script>
