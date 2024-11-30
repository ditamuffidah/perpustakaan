<template>
  <div class="background-image">
    <div class="center-box">
      <img :src="logo" alt="Logo SMKN 2 Sumedang" class="logo"/>
      <p class="box-text">Sistem Informasi Perpustakaan</p>
      <p class="login-text">Akses login</p>
      
      <!-- Tombol akses dengan ikon -->
      <div class="button-container">
        <button class="access-button admin-button">
          <span class="icon-wrapper">
            <i class="fas fa-user-graduate"></i>
          </span>
          Siswa
        </button>
        <button class="access-button guru-button">
          <span class="icon-wrapper">
            <i class="fas fa-chalkboard-teacher"></i>
          </span>
          Guru
        </button>
        <button class="access-button siswa-button ">
          <span class="icon-wrapper">
            <i class="fas fa-user-shield"></i>
          </span>
          Admin
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import logo from '@/assets/smk2.png'; // Pastikan jalur gambar benar
export default {
  name: 'Akses',
};
</script>

<style scoped>
.background-image {
  width: 106.3vw;
  height: 100vh;
  background-image: url('src/assets/perpustakaan.jpg'); /* Ganti dengan path gambar Anda */
  background-size: cover;
  background-position: center;
  display: flex;
  justify-content: center;
  align-items: center;
}

.center-box {
  width: 342px;
  height: 450px; /* Tinggi ditingkatkan untuk menampung tombol */
  background-color: #5A7AC5;
  border-radius: 25px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 20px;
  position: relative; /* Untuk memastikan posisi gambar relatif terhadap .center-box */
  margin-left: 8%;
}

.logo {
  width: 70px; /* Ukuran gambar logo yang diperkecil */
  height: auto; /* Menjaga rasio aspek gambar */
  margin-bottom: 40px; /* Jarak antara logo dan teks di bawahnya */
  position: absolute;
  top: 30px; /* Posisi gambar di dalam .center-box */
}

.box-text {
  color: white;
  font-size: 18px;
  text-align: center;
  margin-top: 100px; /* Menambah jarak dari atas untuk menurunkan teks */
  margin-bottom: 4px;
  font-weight: bold;
}

.login-text {
  color: white;
  font-size: 20px;
  text-align: center;
  margin-top: 10px; /* Menambah jarak dari teks sebelumnya */
  margin-bottom: 30px; /* Menambah jarak dari teks sebelumnya ke tombol */
}

/* Kontainer tombol */
.button-container {
  display: flex;
  flex-direction: column;
  gap: 10px; /* Jarak antara tombol */
}

.access-button {
  width: 180px; /* Lebar tombol diperkecil */
  height: 50px; /* Tinggi tombol diperkecil */
  background-color: #1061F7; /* Warna latar belakang tombol */
  border: none;
  border-radius: 50px; /* Membuat bentuk oval */
  color: white;
  font-size: 20px; /* Ukuran teks diperkecil */
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s;
  display: flex;
  align-items: center;
  justify-content: flex-start; /* Menempatkan ikon dan teks ke kiri */
  padding-left: 15px; /* Padding untuk memberikan jarak dari tepi kiri */
  text-align: left; /* Mengatur teks agar rata kiri */
  gap: 20px; /* Jarak antara ikon dan teks */
}

.access-button .icon {
  display: flex;
  align-items: center; /* Menyelaraskan ikon secara vertikal dengan teks */
}




.icon-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 35px; /* Lebar lingkaran ikon diperkecil */
  height: 35px; /* Tinggi lingkaran ikon diperkecil */
  background-color: white; /* Warna lingkaran */
  border-radius: 50%; /* Membuat lingkaran */
  margin-right: 8px; /* Jarak antara lingkaran dan teks */
}

.access-button i {
  font-size: 18px; /* Ukuran ikon diperkecil */
  color: #1061F7; /* Warna ikon sesuai dengan latar belakang tombol */
}

/* Warna ikon berdasarkan jenis tombol */
.admin-button i {
  color: #000000; /* Warna ikon untuk Admin */
}

.guru-button i {
  color: #000000; /* Warna ikon untuk Guru */
}

.siswa-button i {
  color: #000000; /* Warna ikon untuk Siswa */
}

.access-button:hover {
  background-color: #0e4d9c; /* Warna tombol saat hover */
}
</style>
