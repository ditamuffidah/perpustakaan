<template>
  <!-- Main Content -->
  <div class="main-content">
    <!-- Teks Genre -->
    <div class="ebook-title-container">
      <h1 class="ebook-title">E-BOOK</h1>
    </div>

    <!-- Menu Genre -->
    <div class="genre-container">
      <ul class="genre">
        <li v-for="genre in genres" :key="genre.nama">
          <a href="#" @click.prevent="filterBooks(genre.nama)">{{ genre.nama }}</a>
        </li>
      </ul>
    </div>
    <!-- Garis Genre -->
    <hr class="underline" />

    <!-- Container untuk menampung semua grid-item -->
    <div class="grid-container">
      <!-- Bagian Gambar Buku -->
      <div class="grid-item" v-for="book in filteredBooks" :key="book.id">
        <img :src="book.gambar" alt="Category Image" class="category-image" />
        <div class="rect-dalam"></div> <!-- Persegi panjang -->
        <div class="box-genre">
          <span class="text"> {{ book.kategori }}</span>
        </div>
        <div class="info">
          <span class="info-title">{{ book.judul_buku }}</span>
          <span class="info-author">by {{ book.penulis }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from '../axios'
export default {
  name: 'Ebooks',
  data() {
    return {
      genres: [],
      selectedGenre: null, // Genre yang dipilih
      ebookBooks: [],
      filteredBooks: []
    };
  },
  created() {
    this.fetchBooks(); // Call fetchBooks when the component is created
  },
  methods: {
    fetchBooks() {
      axios.get('/buku/ebook')
        .then(response => {
          this.ebookBooks = response.data.books;
          this.filteredBooks = response.data.books;
          this.genres = response.data.category;
          console.log("Books fetched successfully:", ebookBooks);
        })
        .catch(error => {
          console.error("There was an error fetching the books:", error);
        });
    },
    //filter buku sesuai genre yang dipilih
    filterBooks(genre) {
      if (genre === 'All') {
        this.filteredBooks = this.ebookBooks;
      } else {
        axios.get('/buku/category/'+genre)
        .then(response => {
          this.filteredBooks = response.data.books;
          console.log("Books fetched successfully:", filteredBooks);
        })
        .catch(error => {
          console.error("There was an error fetching the books:", error);
        });
      }
      this.selectedGenre = genre; // Update genre yang dipilih
    }
  },
  mounted() {
  },
};
</script>

<style scoped>
  #app {
    font-family: Arial, sans-serif;
    display: flex;
    min-height: 100vh;
  }

  /*Main Content*/
  .main-content {
    position: fixed;
    /* Membuat elemen tetap pada posisi */
    top: 19%;
    left: 17%;
    width: 86vw;
    /* Memastikan lebar penuh layar */
    height: 81vh;
    /* Menetapkan tinggi elemen untuk bisa scroll */
    background-color: #5A7AC5;
    /* Latar belakang biru */
    text-align: center;
    padding: 50px;
    cursor: pointer;
    background-size: cover;
    /* Latar belakang menutupi seluruh elemen */
    background-position: center;
    /* Latar belakang di tengah */
    overflow-y: auto;
    /* Menambahkan scroll secara vertikal */
    margin: 0;
    /* Hilangkan margin */
  }

  .ebook-title-container {
    font-size: 24px;
    color: white;
    margin-bottom: 10px;
    font-size: 2.5rem;
    font-weight: bold;
    text-transform: uppercase;
    margin-top: -29px;
    margin-left: -900px
  }

  .underline {
    margin-top: -90px;
    border: none;
    border-top: 2px solid white; /* Ganti dengan warna yang sesuai */
    width: 98.6%; /* Sesuaikan dengan lebar yang diinginkan */
    height: 2px; /* Atur tinggi garis jika perlu */
    margin-left: 3px;
    object-fit: cover; /* Mengatur margin dan posisi */
  }

  .genre {
    display: grid;
      grid-template-columns: repeat(5, 1fr);/* 5 kolom */
      list-style: none;
      margin-left: 20px;
      margin-top: -17%;
      padding: 10%; /* Menghapus padding default */
  }

  .genre li {
    display: inline;
    margin-bottom: 0;
    margin-left: 90px;
  }

  .genre li a {
    color: white;
      font-size: 18px;
      line-height: 1.5;
      text-align: center; /* Agar teks rapi di tengah */
      display: block;
      margin-bottom: 4px;
  }

  .genre li a:hover {
    text-decoration: underline;
  }

  /* Styling untuk grid-container */
.grid-container {
    display: grid;
    grid-template-columns: repeat(5, 1fr);/* 5 kolom */
    gap: -10px; /* Jarak antar item dalam grid */
    padding: 10px;
    margin-left: -55px;
    justify-content: center; /* Menyusun item di tengah */
}

  /* styles.css untuk box */
  .grid-item {
    position: relative; /* Untuk tombol yang diposisikan absolut */
    display: flex;
    align-items: center;
    background-color: #D9D9D9;
    width: 170px;
    height: 270px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan */
    margin-top: 30px;
    margin-bottom: 40px;
    margin-left: 49px;
    padding: 10px; /* Memberikan padding di sekitar gambar */
    justify-content: flex-end; /* Memposisikan gambar di kanan */
    gap: 15px; /* Memberi jarak antar elemen flex */
  }

  .grid-item img {
    max-height: 70%; /* Memastikan gambar tidak melebihi ukuran kotak */
    max-width: 100%;
    margin-top: -6.5%;
    margin-right: -170.5px;
    margin-bottom: 86px;
    border-radius: 8px;
    flex-direction: column; z-index: 2;
  }

  /*code box kecil dalam box gambar*/
  .rect-dalam {
    position: absolute; /* Letakkan persegi panjang dengan posisi absolut */
    top: 0; /* Atur posisi atas untuk menempatkan di atas */
    left: 10%; /* Atur posisinya di tengah secara horizontal */
    transform: translateX(-50%); /* Pastikan persegi panjang benar-benar di tengah */
    width: 13px;
    height: 60px;
    background-color: #755555;
    border-radius: 15px;
    z-index: 6; /* Pastikan berada di atas elemen lain */
  }

  .box-genre {
    background-color: rgba(184, 145, 145, 0.5);
    border: none; /* Menghapus border default */
    border-radius: 6px; /* Sudut melengkung */
    position: absolute; /* Posisi absolut di dalam kontainer */
    left: 0; /* Menempel di sisi kiri dalam kontainer */
    top: 30px; /* Mulai dari bagian atas kotak */
    bottom: 0; /* Tombol membentang hingga ke bawah */
    height: 200px;
    width: 75px; /* Menentukan lebar tombol */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1; /* Z-index lebih kecil dari buku */
    cursor: pointer;
  }

  .text {
    writing-mode: vertical-rl; /* Mengubah mode penulisan teks menjadi vertikal dan menghadap ke kanan */
    transform: rotate(180deg);
    font-size: 1.5rem;
    font-weight: bold;
    color: black;
    padding-left: 45px;
    z-index: 2; /* Z-index lebih kecil dari buku */
    opacity: 100;
  }

  /*tata letak untuk didalam box*/
  .info {
    margin-top: auto; /* Dorong teks ke bagian bawah kontainer */
    text-align: center; /* Menyelaraskan teks di tengah */
    padding-top: 10px; /* Jarak antara gambar dan teks di bawahnya */
    padding-left: 45px;
    display: flex;
    flex-direction: column; /* Mengatur agar elemen anak berada dalam kolom (vertikal) */
    align-items: center;
  }

  /*code unuk teks judul*/
  .info-title {
    font-size: 0.9rem; /* Ukuran font untuk judul buku */
    font-weight: bold; /* Judul tebal */
    color: #000; /* Warna teks judul buku */
    position: relative;
    left: 10px; /* Geser ke kanan */
    margin-bottom: 2px; /* Tambahkan jarak di bawah judul */
    max-width: 100px; /* Batasi lebar judul agar teks terbungkus ke baris berikutnya */
    text-align: center; /* Posisikan teks di tengah */
    word-wrap: break-word; /* Memastikan kata dipindah ke baris berikutnya jika terlalu panjang */
}

  /*code untuk teks penulis*/
  .info-author {
    font-size: 0.875rem; /* Ukuran font untuk nama penulis */
    color: #555; /* Warna teks penulis */
    text-align: center; /* Teks penulis diposisikan di tengah */
    display: block; /* Pastikan author berada di baris baru */
    margin-top: 8px; /* Jarak antara judul dan author */
    position: relative;
    top: -5px;
    left: 10px;
  }
</style>