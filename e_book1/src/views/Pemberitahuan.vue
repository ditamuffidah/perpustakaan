<template>
  <div class="setting-container">
    <div class="header">
      <!-- Tombol kembali -->
      <button class="back-button" @click="goBack">&#8592;</button>
      <h1 class="header-title">PEMBERITAHUAN PERPUSTAKAAN</h1>
      <div class="img-container">
        <img :src="dok1Image" alt="Dok1" class="dok1-img" />
        <img :src="rilImage" alt="ril" class="ril-img" />
      </div>
    </div>
    <div class="account-label">
      <h2>Peringatan Pengembalian Buku</h2>
      <h3 class="date-text">{{ tanggal_sekarang }}</h3>
    </div>
    <div class="settings-form">
      <div class="setting-item">
        <span class="username-text">Hi {{ nama }}!</span>
      </div>
      <span class="warning-text">
        Buku yang anda pinjam dengan judul Wabah dan Pandemi telah melewati batas waktu pengembalian pada {{ tanggal }}. Harap segera kembalikan buku tersebut agar anda dapat menghindari denda atau jika anda masih ingin meminjam buku tersebut harap segera perpanjang masa peminjaman.
      </span>
      <div class="action-buttons">
        <button @click="extendLoan" class="save-button">Perpanjang Peminjaman</button>
        <button @click="returnBook(id_buku,isbn,id_peminjaman)" class="cancel-button">Kembalikan Buku</button>
      </div>
    </div>
    <h2 class="contact-text">Contact: 081314240901</h2>
  </div>
</template>

<script>
import dok1Image from '@/assets/dok1.png';
import rilImage from '@/assets/ril.png';
import arrowImage from '@/assets/arrow.png';

export default {
  name: 'Pemberitahuan',
  data() {
    return {
      username: 'Username', // Bind dari backend atau store
      dok1Image, // Gambar dok1
      rilImage,  // Gambar ril
      arrowImage,  // Gambar panah.
      id_buku: null,
      isbn: null,
      nama: null,
      tanggal : null,
      id_peminjaman : null,
      tanggal_sekarang : null,
    };
  },
  created() {
    this.id_buku = this.$route.query.id_buku
    this.nama = this.$route.query.nama
    this.tanggal = this.$route.query.tanggal
    this.id_peminjaman = this.$route.query.id_peminjaman
    this.tanggal_sekarang = this.$route.query.tanggal_sekarang,
    this.isbn = this.$route.query.isbn
  },
  methods: {
    // Method untuk perpanjangan peminjaman
    extendLoan() {
      // Panggil API backend untuk memperpanjang peminjaman
      console.log('Perpanjang peminjaman');

      // Navigasi ke halaman warning ketika klik perpanjang
      this.$router.push({ name: 'Warning' });
    },

    // Method untuk mengembalikan buku
    returnBook(id_buku, isbn,id_peminjaman){
      this.$router.push({ 
        name: 'Pengembalian',
        query: {
          id_buku: id_buku,
          isbn: isbn,
          id_peminjaman:id_peminjaman
        }
      });
    },
    goBack() {
      this.$router.push({ name: 'Notifikasi' }); // Pastikan nama rute sesuai dengan halaman catalog
    },
  }
}
</script>


<style scoped>
.setting-container {
  background-color: #5a7ac5;
  color: white;
  width: 100vw;
  height: 100vh;
  padding: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  position: fixed;
  top: 0;
  left: 0;
  overflow: hidden;
}

.back-button {
  background: none; /* Menghilangkan kotak putih */
  border: none; /* Menghilangkan border */
  font-size: 32px; /* Ukuran font untuk panah */
  color: white; /* Mengubah warna tombol menjadi putih */
  cursor: pointer; /* Mengubah kursor saat hover */
  margin-right: 430px; /* Spasi antara tombol dan judul */
  margin-top: -20px;
}

.header {
  width: 90%;
  display: flex;
  align-items: center;
  justify-content: space-between; /* Jarak antara gambar panah dan gambar di pojok kanan */
  padding: 9px 0;
  border-bottom: 1px solid white;
  margin-top: 20px;
  position: relative; /* Agar img-container bisa diposisikan relatif terhadap header */
}


.header-title {
  flex: 1; /* Memastikan teks berada di tengah */
  text-align: center;
  font-size: 30px;
  margin-left: -400px;
  margin-top: -14px;
  font-weight: bold;
}

.img-container {
  display: flex;
  gap: 10px; /* Jarak antara kedua gambar */
  margin-top: -15px;
}

.dok1-img, .ril-img {
  width: 22px;
  height: 22px;
  object-fit: cover;
}

.account-label {
  width: 88%;
  text-align: left;
  padding: 5px 0;
  color: #fff6f6;
  margin-top: 20px;
  font-size: 20px;
  font-weight: bold;
}

.date-text {
  color: #e0e0e0;
  font-size: 15px;
}

.settings-form {
  background-color: rgba(255, 255, 255, 0.4); /* Transparan putih dengan opacity 40% */
  border-radius: 10px;
  width: 90%;
  max-width: 700px;
  padding: 45px;
  color: #ffffff;
  margin-top: 20px;
}

.setting-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 15px;
  font-size: 22px;
}

.username-text {
  font-style: italic;
}

.warning-text {
  font-size: 20px;
  line-height: 1.5;
}

.action-buttons {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 35px;
  gap: 10px;
  width: 100%;
}

.save-button,
.cancel-button {
  background-color: #007AFF;
  color: white;
  border: none;
  border-radius: 4px;
  padding: 10px 20px;
  cursor: pointer;
  font-size: 16px;
  width: 36%;
}

.cancel-button {
  background-color: #007AFF;
}

.save-button:hover,
.cancel-button:hover {
  opacity: 0.8;
}

.contact-text {
  position: absolute;
  bottom: 20px;
  right: 60px;
  font-size: 20px;
  text-align: right;
  max-width: 100%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
