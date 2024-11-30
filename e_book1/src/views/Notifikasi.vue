<template>
  <div class="setting-container">
    <div class="header">
      <button class="back-button" @click="goBack">&#8592;</button>
      <img :src="notifikasiImage" alt="Notifikasi" class="notifikasi-img" />
      <h1>NOTIFIKASI</h1>
      <div class="search-container">
        <img :src="searchImage" alt="Search" class="search-icon" />
        <input type="text" placeholder="Search" class="search-input" />
      </div>
    </div>

    <div class="warning-section">
      <button
      v-for="(notification, index) in notif"
      :key="index"
      class="warning-button  red-background"
      @click="goToPemberitahuan(notification.buku_id, notification.user, notification.tanggal_text, notification.id_peminjaman,notification.tanggal_sekarang,notification.isbn)">
      <img :src="peringatanImage" alt="Peringatan" class="peringatan-img" />
      <div class="warning-content">
        <div class="warning-header">
        <div class="warning-title">Peringatan</div>
        <div class="warning-subtitle">
          Buku Ini Telah Hangus! 
          <span class="warning-date">{{ notification.tanggal_pengembalian }}</span>
        </div>
        </div>
        <div class="warning-text"></div>
        <div class="img-container">
        <img :src="dok1Image" alt="Dok1" class="dok1-img" />
        <img :src="rilImage" alt="ril" class="ril-img" />
        </div>
      </div>
      </button>
    </div>
  </div>
</template>

<script>
import notifikasiImage from '@/assets/notifikasi.png';
import searchImage from '@/assets/search.png';
import peringatanImage from '@/assets/peringatan.png';
import dok1Image from '@/assets/dok1.png';
import rilImage from '@/assets/ril.png';
import arrowImage from '@/assets/arrow.png';
import axios from '../axios';

export default {
  name: 'Notifikasi',
  data() {
    return {
      notif:[],
      notifikasiImage,
      searchImage,
      peringatanImage,
      id_anggota:null,
      dok1Image,
      rilImage,
      arrowImage,
      warnings: [
        { text: '', type: 'gray' },
        { text: '', type: 'gray' },
        { text: '', type: 'red' },
        { text: '', type: 'red' },
        { text: '', type: 'red' } // Mengurangi satu objek
      ]
    };
  },
  mounted() {
    // Menambahkan peringatan baru secara otomatis saat komponen di-mount
    this.warnings.push({
      text: '', // Tambahkan teks peringatan sesuai kebutuhan
      type: 'red'  // Ini adalah warning dengan latar merah
    });
  },
  created() {
    // Menangkap data dari query
    
    this.id_anggota = JSON.parse(localStorage.getItem("user")).id || null;
    this.fetchData();
  },
  methods: {
    fetchData() {
      axios.get('/notifikasi/'+this.id_anggota)
        .then(response => {
          this.notif = response.data.notifikasi; // Update to directly assign the response data
          console.log("Books fetched successfully:", notif);
        })
        .catch(error => {
          console.error("There was an error fetching notif:", error);
        });
    },
    // Method untuk tombol kembali
    goBack() {
      this.$router.push({ name: 'Home' }); // Pastikan nama rutenya sesuai
    },
    goToPemberitahuan(id_buku, nama, tanggal, id_peminjaman,tanggal_sekarang,isbn){
      this.$router.push({ 
        name: 'Pemberitahuan',
        query: {
          id_buku: id_buku,
          nama: nama,
          isbn: isbn,
          tanggal : tanggal,
          id_peminjaman : id_peminjaman,
          tanggal_sekarang : tanggal_sekarang,
        }
      })
    }
  }
};

</script>

<style scoped>
.back-button {
  background: none; /* Menghilangkan kotak putih */
  border: none; /* Menghilangkan border */
  font-size: 32px; /* Ukuran font untuk panah */
  color: white; /* Mengubah warna tombol menjadi putih */
  cursor: pointer; /* Mengubah kursor saat hover */
  margin-right: 430px; /* Spasi antara tombol dan judul */
  margin-top: -5px;
}

.setting-container {
  background-color: #5a7ac5;
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
  overflow: auto;

}

.header {
  display: flex;
  align-items: center;
  width: 90%;
  padding: 9px 0;
  border-bottom: 1px solid white;
  margin-top: 2px;
  color: white;
  font-size: 1.5rem;
  font-weight: bold;
}


.icon-left {
  margin-right: -410px;
  font-size: 20px;
}

.notifikasi-container {
  display: flex;
  align-items: flex-end; /* Untuk meratakan gambar dan teks secara vertikal */
}

.notifikasi-img {
  width: 30px;
  height: 30px;
  margin-left: -410px; /* Ganti dengan nilai positif yang sesuai */

}


h1 {
  margin-left: 10px;
}

.search-container {
  display: flex;
  align-items: center;
  background-color:  #D9D9D9;

  border-radius: 25px;
  padding: 6px;
  margin-left: auto;
  width: 400px;
}

.search-input {
  border: none;
  outline: none;
  font-size: 17px;
  flex-grow: 10;
  margin-left: 1px;
  padding: px 10px;
  background-color: #d9d9d9;
  color: #333;
}

.search-icon {
  width: 25px;
  height: 25px;
  color: #333;
}

.warning-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 35px;
  width: 90%;
  gap: 20px;
}

.warning-button {
  display: flex;
  align-items: flex-start;
  color: #ffffff;
  border: none;
  border-radius: 10px;
  font-size: 16px;
  cursor: pointer;
  width: 100%;
  max-width: 1230px;
  gap: 10px;
  padding: 0px;
  position: relative;
}

.warning-content {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  width: 100%;
}

.button-gray {
  background-color: #d9d9d9;
}

.red-background {
  background-color: rgba(255, 245, 245, 0.2);
}

.peringatan-img {
  width: 60px;
  height: 60px;
}

.warning-title {
  margin: 5px 0; /* Sesuaikan jarak atas dan bawah */
  font-weight: bold;
  font-size: 18px;
}

.warning-content {
  display: flex;
  flex-direction: column;
}

.warning-header {
  display: flex;
  justify-content: flex-start; /* Ubah menjadi flex-start untuk lebih kontrol */
  margin-bottom: 1px;
}

.warning-title {
  font-weight: bold;
  font-size: 18px;
  margin-top: 20px; /* Jarak atas untuk mengatur posisi */
}

.warning-subtitle {
  margin-left: 280px; /* Jarak dari judul */
  font-weight: bold;
  font-size: 18px;
  margin-top: 20px; /* Jarak atas untuk mengatur posisi */
}

.warning-date {
  margin-left: 350px; /* Pindahkan sedikit lebih ke kanan */
  margin-top: 20px; /* Jarak vertikal untuk memindahkan ke bawah */
  font-weight: bold;
  font-size: 18px;
  color: #ccc; /* Gaya opsional untuk tanggal */
}



.warning-text {
  margin: 5px 0;
}



.warning-text {
  margin: 5px 0 0 0; /* Maintain vertical margin */
  font-weight: normal;
  font-size: 16px;
  width: 100%; /* Ensure it takes full width */
  text-align: left; /* Align text to the left */
}

.warning-text {
  margin: 5px 0 0 0; /* Adjusted margin for lower positioning */
  font-weight: normal;
  font-size: 16px;
}

.img-container {
  display: flex;
  align-items: center;
  gap: 5px;
  position: absolute; /* Absolute positioning */
  top: 20px; /* Adjust to position it vertically */
  right: 25px; /* Adjust to position it horizontally */
}

.dok1-img {
  width: 24px;
  height: 24px;
}

.ril-img {
  width: 20px;
  height: 20px;
}
</style>