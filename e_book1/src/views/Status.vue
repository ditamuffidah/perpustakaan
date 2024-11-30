<template>
  <div id="app">
    <!-- Main Content -->
    <div class="main-content">
        <!-- Tersedia Section -->
        <h2 class="section-title font-bold">Tersedia</h2>
        <hr class="section-divider">
        <div class="grid">
          <div class="book" v-for="book in tersediaBooks" :key="book.id" @click="goToPeminjaman(book.id, book.isbn)">
            <div class="genre-container" >
              <button class="genre-button">{{ book.kategori }}</button>
            </div>
            <img :src="book.gambar" :alt="book.judul_buku">
            <h3>{{ book.judul_buku }}</h3>
            <p>{{ book.penulis }}</p>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
import matematikaCover from '@/assets/matematika.jpg';
import informatikaCover from '@/assets/informatika.png';
import anantaCover from '@/assets/ananta.png';
import bahasaCover from '@/assets/bahasa.jpg';
import akuntansi1Cover from '@/assets/akutansi1.jpg'
import biologiCover from '@/assets/biologi.jpg';
import pjokCover from '@/assets/PJOK.jpg';
import magmaCover from '@/assets/Magma.jpg';
import alaskaCover from '@/assets/ALASKA.jpg';
import oknCover from '@/assets/okn.jpg';
import paiCover from '@/assets/pai.jpg';
import akutansi1hCover from '@/assets/akutansi1.jpg';
import sejarahCover from '@/assets/sejarah.jpg';
import indonesiaCover from '@/assets/indonesia.jpg';
import bahasa2Cover from '@/assets/bahasa2.jpg';

import axios from '../axios'
export default {
  name: 'Status',
  data() {
    return {
      tersediaBooks: [
      ],
    };
  },
  created() {
    this.fetchBooks(); // Call fetchBooks when the component is created
  },
  methods: {
    fetchBooks() {
      axios.get('/buku/tersedia')
        .then(response => {
          this.tersediaBooks = response.data.books;
          console.log("Books fetched successfully:", tersediaBooks);
        })
        .catch(error => {
          console.error("There was an error fetching the books:", error);
        });
    },
    goToPeminjaman(id_buku, isbn){
      this.$router.push({ 
        name: 'Peminjaman',
        query: {
          id_buku: id_buku,
          isbn: isbn,
        }
      })
    }
  }
}
</script>

<style scoped>
  #app {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .section-title {
    font-size: 25px;
    margin-top: -10px; /* Hapus margin atas untuk menyelaraskan dengan garis */
    margin-left: 10px;
  }

  .section-divider {
    border: 1px solid white;
    margin-bottom: 10px;
    margin-left: 10px;
    width: 94.5%;
  }

/* Styling untuk main content */
.main-content {
  position: fixed; /* Tetap menggunakan fixed sesuai kebutuhan */
  top: 19%;
  left: 18%;
  width: 84vw; /* Lebar tetap 85% viewport */
  height: 84vh; /* Tinggi 84% viewport agar bisa di-scroll */
  background-color: #5A7AC5; /* Warna latar */
  padding: 50px;
  cursor: pointer;
  color: white;
  background-size: cover; /* Latar belakang menutupi seluruh elemen */
  background-position: center; /* Latar belakang di tengah */
  overflow-y: auto; /* Scroll secara vertikal */
}

.grid {
  display: grid;
  grid-template-columns: repeat(5, 2fr);
  gap: 1px; /* Mengurangi jarak antar buku lebih jauh */
}

.book {
  text-align: center; /* Membuat teks berada di tengah buku */
  margin: 0; /* Mengurangi margin agar buku tidak terlalu jauh satu sama lain */
  position: relative;
  padding-top: 30px; /* Tambahkan padding-top untuk memberi sedikit ruang antara buku dan genre */
  right: -10px;
}

.book img {
  width: 70%;
  height: 90%;
  border-radius: 4px;
  margin-bottom: 10px; /* Mengurangi margin-bottom untuk mendekatkan gambar dengan genre */
 }

.genre-container {
  position: absolute; /* Posisi absolut untuk menempatkan genre di tengah */
  top: 70%; /* Posisi genre sekarang lebih dekat ke gambar */
  left: 35%;
  transform: translate(-50%, -50%); /* Menyelaraskan genre di tengah */
}

.genre-button {
  background-color: rgba(255, 255, 255, 0.5); /* Warna latar belakang putih transparan */
  color: black; /* Warna teks hitam */
  border: none; /* Menghapus border default */
  padding: 5px 10px; /* Menambahkan padding */
  border-radius: 5px; /* Menambahkan border-radius */
}

.section-title {
  font-size: 25px; /* Besar teks untuk judul bagian */
}

.section-divider {
  border: 1px solid white; /* Garis putih sebagai pembatas */
  margin-bottom: 10px; /* Jarak antara pembatas dan konten berikutnya */
}

</style>