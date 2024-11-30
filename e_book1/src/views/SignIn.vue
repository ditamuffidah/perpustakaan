<template>
  <article>
    <div class="container">
      <!-- Formulir Login -->
      <form class="sign-up" @submit.prevent="handleSignUp">
        <!-- Bagian logo yang ditempatkan di pinggir kotak putih dan sedikit lebih ke bawah -->
        <div class="logo-container logo1-container">
          <img src="@/assets/logo1.png" alt="Logo 1" class="logo-img" />
        </div>
        <div class="logo-container logo2-container">
          <img src="@/assets/logo2.png" alt="Logo 2" class="logo-img" />
        </div>

        <div class="button-signin-container">
          <button class="button-signin">SIGN IN</button>
        </div>

        <h1 class="welcome-title">WELCOME!</h1>
        <div class="input-container input-star">
          <!-- Ikon Gembok -->
          <i class="fas fa-lock"></i>
          <input type="text" placeholder="Kode" v-model="code" class="input-kode" />
        </div>
        <div class="input-container input-username">
          <i class="fas fa-user"></i>
          <input type="text" placeholder="Username" v-model="Username" />
        </div>
        <div class="input-container input-email">
          <i class="fas fa-envelope"></i>
          <input type="text" placeholder="Email" v-model="email" />
        </div>
        <div class="input-container password-container">
          <!-- Ikon Kunci -->
          <i class="fas fa-key"></i>
          <input :type="passwordVisible ? 'text' : 'password'" placeholder="Password" v-model="password" />
          <button type="button" @click="togglePasswordVisibility" class="password-toggle-button">
            <i :class="passwordVisible ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
          </button>
        </div>
        <div class="button-group">
          <button type="button" @click="toggleSignUp">Sign in</button>
          
        </div>
      </form>
    </div>
  </article>
</template>

<script>
export default {
  name: 'SignIn',
  data() {
    return {
      signUp: false,
      code: '',
      email: '',
      password: '',
      passwordVisible: false,
    };
  },
  methods: {
    handleSignUp() {
      console.log('Sign Up Data:', this.code, this.email, this.password);
    },
    toggleSignUp() {
      this.signUp = !this.signUp;
    },
    togglePasswordVisibility() {
      this.passwordVisible = !this.passwordVisible;
    }
  }
};
</script>

<style scoped>

.container {
  position: relative;
  width: 100vw;
  height: 100vh;
  margin: 0;
  padding: 0;
  overflow: hidden;
}

.container::before {
  content: '';
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-image: url('@/assets/perpustakaan.jpeg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  z-index: -1;
}

/* Bagian logo pertama */
.logo1-container {
  position: absolute;
  top: 230px; /* Posisikan lebih ke bawah */
  left: calc(70% - 520px); /* Posisikan di kiri kotak putih */
  z-index: 2;
}

.logo1-container .logo-img {
  width: 260px; /* Ukuran logo yang lebih kecil */
  height: auto;
}

/* Bagian logo kedua */
.logo2-container {
  position: absolute;
  top: 20px; /* Posisikan lebih ke bawah */
  left: calc(70% - 477px); /* Posisikan di kanan logo pertama */
  z-index: 2;
}

.logo2-container .logo-img {
  width: 260px; /* Ukuran logo yang lebih kecil */
  height: auto;
}

.button-signin-container {
  position: absolute;
  top: -75px; /* Geser tombol lebih ke atas */
  left: 50%;
  transform: translateX(-50%);
  z-index: 2;

  .button-signin {
    background-color: rgba(255, 255, 255, 0.75);
    color: #000;
    border: 2px solid #f5f5f5;
    padding: 12px 50px;
    font-size: 1rem;
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
  }
}

form {
  position: fixed; /* Ubah dari relative ke fixed */
  top: 58%;
  left: 50%;
  transform: translate(-50%, -50%);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  padding: 30px;
  width: 50%;
  background: linear-gradient(to right, #ffffff 50%, #5A7AC5 50%);
  border-radius: 15px;
  box-shadow: 0 4px 8px rgba(78, 170, 127, 0.1);
  z-index: 1;
  opacity: 1;
  visibility: visible;
  transition: none; /* Nonaktifkan transition */
}

/* Nonaktifkan scrolling horizontal pada body */
body {
  overflow-x: hidden;
}

.welcome-title {
  font-size: 2rem;
  font-weight: 990;
  color: #fff;
  margin-bottom: 35px;
  text-align: right;
  text-transform: uppercase;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
  width: 87%;
}

.input-container {
  position: relative;
  width: 40%;
  margin: 10px 0;
  margin-left: auto;
  margin-right: 0;

  i {
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: #0073e6;
    font-size: 1.4rem;
    z-index: 1;
  }

  input {
    padding-left: 50px;
    width: 100%;
    box-sizing: border-box;
    height: 35px;
    border-radius: 25px;
    border: 1px solid #0073e6;
    font-size: 0.875rem;
    z-index: 0;
  }
}

.input-kode {
  border: 1px solid #0073e6;
}

.password-container {
  position: relative;
  width: 40%;
  margin: 10px 0;
  margin-left: auto;
  margin-right: 0;

  i {
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: #0073e6;
    font-size: 1.4rem;
    z-index: 1;
  }

  input {
    padding-left: 50px;
    padding-right: 50px;
    height: 40px;
    border-radius: 25px;
    border: 1px solid #0073e6;
    font-size: 0.875rem;
    z-index: 0;
  }

  .password-toggle-button {
    position: absolute;
    right: 45px;
    top: 50%;
    transform: translateY(-50%);
    border: none;
    background: none;
    color: #0073e6;
    font-size: 1.4rem;
    cursor: pointer;
    transition: color 0.3s ease;
    z-index: 2;

    &:hover {
      color: #005bb5;
    }
  }
}

.button-group {
  display: flex;
  justify-content: flex-end;
  width: 70%;
  margin-top: 40px;
  padding: 9px;
  border-radius: 10px;
}

.button-group button {
  border-radius: 35px;
  border: none;
  background-color: #1061F7;
  color: #f5f7f8;
  padding: 10px 20px;
  font-size: 0.875rem;
  height: 40px;
  cursor: pointer;
  transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  margin-left: 70px;
}

.button-group button:hover {
  background-color: #005bb5;
  color: #ffffff;
  transform: scale(1.05);
}
</style>
