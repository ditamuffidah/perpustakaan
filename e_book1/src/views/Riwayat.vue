<template>
  <div id="app">
    <!-- Main Content -->
    <div class="main-content">
  <!-- Tersedia Section -->
  <h2 class="section-title font-bold">Riwayat Peminjaman</h2>
  <hr class="section-divider">
  <div class="grid-container">
    <div class="book-item" v-for="book in tersediaBooks" :key="book.id" @click="goToPeminjaman(book.id, book.isbn)">
      <div class="book-image-wrapper">
        <img :src="book.gambar" :alt="book.judul_buku" class="book-image">
      </div>
      <div class="book-info">
        <h3 class="book-title">{{ book.judul_buku }}</h3>
        <p class="book-author">by {{ book.penulis }}</p>
        <p class="book-details">
          Tanggal Peminjaman: {{ book.tanggal_peminjaman }}<br>
          Tanggal Pengembalian: {{ book.tanggal_pengembalian }}<br>
          Status: {{ book.status }}
        </p>
        <div class="book-action">
        <button
          v-if="book.status === 'dipinjam'"
          class="return-button"
          @click.stop="returnBook(book.id_buku, book.isbn, book.id_peminjaman)"
        >
          Kembalikan
        </button>
        <button
            v-if="book.status === 'selesai' && !book.sudah_review"
            class="return-button"
            @click.stop="reviewBook(book.id_buku, book.id_peminjaman)"
          >
            Review
          </button>
      </div>
      </div>
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
  name: 'Riwayat',
  data() {
    return {
      id_anggota:'',
      tersediaBooks: [
      ],
    };
  },
  created() {
    this.id_anggota = JSON.parse(localStorage.getItem("user")).id || null;
    this.fetchBooks(); // Call fetchBooks when the component is created
  },
  methods: {
    fetchBooks() {
      axios.get('/riwayat/' + this.id_anggota)
        .then(response => {
          this.tersediaBooks = response.data.books;
          console.log("Books fetched successfully:", tersediaBooks);
        })
        .catch(error => {
          console.error("There was an error fetching the books:", error);
        });
    },
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
    reviewBook(id_buku,id_peminjaman){
      this.$router.push({ 
        name: 'Review',
        query: {
          id_buku: id_buku,
          id_peminjaman:id_peminjaman,
        }
      });
    },
  }
}
</script>

<style scoped>
  #app {
    font-family: Arial, sans-serif;
    width: 87vw !important;
    padding-left :110px;
  }
/* General */
.main-content {
  padding: 20px;
  background-color: #f9f9f9;
}

.section-title {
  font-size: 1.8rem;
  margin-bottom: 10px;
  color: #333;
}

.section-divider {
  margin: 10px 0;
  border: none;
  height: 1px;
  background: #ccc;
}

/* Grid Layout */
.grid-container {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}

.book-item {
  display: flex;
  align-items: flex-start;
  background: #fff;
  border: 1px solid #ddd;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.3s ease;
}

.book-item:hover {
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

/* Image Section */
.book-image-wrapper {
  flex-shrink: 0;
  width: 120px;
  height: 180px;
  overflow: hidden;
}

.book-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Information Section */
.book-info {
  flex: 1;
  padding: 15px;
}

.book-title {
  font-size: 1.2rem;
  margin: 0 0 5px;
  color: #333;
}

.book-author {
  font-size: 0.9rem;
  color: #666;
  margin-bottom: 10px;
}

.book-details {
  font-size: 0.85rem;
  color: #555;
  line-height: 1.5;
}

/* Action Section */
.book-action {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  padding: 15px;
}

.return-button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 10px 15px;
  font-size: 0.9rem;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.return-button:hover {
  background-color: #0056b3;
}

</style>