<template>
  <div class="catalog">
    <!-- Bagian Header Katalog -->
    <div class="catalog-header">
      <!-- Tombol kembali -->
      <button class="back-button" @click="goBack">&#8592;</button>
      <h1 class="catalog-title">CATALOGUE</h1>
    </div>
    <hr class="catalog-underline" />

    <div class="book-grid">
      <!-- Menampilkan buku berdasarkan kategori yang dipilih -->
      <div v-for="book in filteredBooks" :key="book.id" class="book-card" @click="goToPeminjaman(book.id, book.isbn)">
        <img :src="book.gambar" :alt="book.judul_buku" class="book-image" />
        <div class="category-label">{{ book.kategori }}</div> <!-- Dinamis berdasarkan kategori buku -->
      </div>
    </div>
  </div>
</template>
  
<script>

import axios from '../axios'
  export default {
    name: 'SecondCatalog',
    props: {
      category: {
        type: String,
        required: true,
      },
    },
    data() {
      return {
        filteredBooks: [],
      };
    },
    computed: {
      category() {
        return this.$route.params.category; // Mengambil parameter kategori dari URL
      },
    },
    created() {
      this.fetchBooks(); // Call fetchBooks when the component is created
    },
    methods: {
      fetchBooks() {
        axios.get('/buku/category/'+this.category)
        .then(response => {
          this.filteredBooks = response.data.books;
          console.log("Books fetched successfully:", books);
        })
        .catch(error => {
          console.error("There was an error fetching the books:", error);
        });
    },
    goToSecondCatalog(category) {
      // Redirect ke SecondCatalog dengan parameter kategori yang diklik
      this.$router.push({ name: 'SecondCatalog', params: { category } });
    },
      goBack() {
        // jika user datang dari halaman 'Catalog'
        if (this.$route.query.fromCatalog) {
          this.$router.push('/catalog');
        } else {
          //jika tidak, kembali ke halaman 'Home'
          this.$router.push('/');
        }
        this.$router.go(-1);
      },
      goToPeminjaman(id_buku, isbn){
      this.$router.push({ 
        name: 'Peminjaman',
        query: {
          id_buku: id_buku,
          isbn: isbn,
        }
      });
    },
      goBack() {
        this.$router.push({ name: 'Catalog' }); 
      },
      selectCategory(category) {
        this.$emit('select-category', category);
        this.$router.push({ name: 'SecondCatalog', params: { category } }); // Mengubah URL dan mengarahkan ke kategori yang dipilih
      },
    },

  };
</script>
  
<style scoped>
  .catalog-header {
    display: flex;
    align-items: center;
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
  
  .catalog {
    position: fixed; /* Membuat elemen tetap pada posisi */
    top: 0;
    left: 0;
    width: 100vw; /* Memastikan lebar penuh layar */
    height: 100vh; /* Memastikan tinggi penuh layar */
    background-color: #5a7ac5; /* Latar belakang biru */
    text-align: center;
    padding: 50px;
    cursor: pointer;
    background-size: cover; /* Latar belakang menutupi seluruh elemen */
    background-position: center; /* Latar belakang di tengah */
    overflow-y: auto; /* Mencegah pengguliran */
    margin: 0; /* Hilangkan margin */
  }

  .catalog-title {
    font-size: 24px;
    color: white;
    margin-bottom: 10px;
    font-size: 4rem;
    font-weight: bold; 
    text-transform: uppercase;
    margin-top: -35px; 
  }

  .catalog-underline {
    border: none;
    border-top: 2px solid white; /* Ganti dengan warna yang sesuai */
    width: 100%; /* Sesuaikan dengan lebar yang diinginkan */
    height: 2px; /* Atur tinggi garis jika perlu */
    margin: 10px auto; 
    object-fit: cover;
    /* Mengatur margin dan posisi */
  }

  .category-label {
    position: absolute; /* Membuat teks berada di atas gambar */
    bottom: 10px; /* Memposisikan teks 10px dari bagian bawah gambar */
    left: 50%; /* Memposisikan teks di tengah secara horizontal */
    transform: translateX(-50%); /* Untuk memastikan teks benar-benar berada di tengah */
    background-color: rgba(199, 188, 188, 0.6); /* Latar belakang semi-transparan untuk membuat teks lebih terbaca */
    color: #0f0e0e; /* Warna teks putih */
    padding: 5px 5px; /* Jarak dalam teks */
    border-radius: 5px; /* Membuat sudut kotak teks menjadi melengkung */
    font-size: 14px; /* Ukuran font teks */
    font-weight: bold; /* Menjadikan teks tebal */
    text-align: center; /* Teks rata tengah */
    text-transform: uppercase; /* Menjadikan semua huruf kapital */
    z-index: 999; /* Pastikan teks muncul di atas gambar */
  }


  .book-grid {
    display: grid;
    grid-template-columns: repeat(5, 2fr);
    gap: 15px;
    justify-items: center;
    align-items: center;
    margin-top: 30px; /* Menambahkan jarak antara grid buku dan tombol kategori */
  }

  .book-card {
    position: relative; /* Membuat posisi elemen menjadi relatif agar teks bisa diposisikan absolut */
    width: 150px; /* Lebar kartu buku */
  }
  
  .book-image {
    width: 100%; /* Gambar akan memenuhi lebar kartu buku */
    height: auto; /* Menjaga aspek rasio gambar */
    display: block; /* Menghilangkan spasi kosong di bawah gambar */
    border-radius: 8px; /* Membuat sudut gambar menjadi melengkung */
  }
  
  html, body, #app {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
  }
  
  /* Responsiveness */
  @media (max-width: 1024px) {
    .category-menu {
      grid-template-columns: repeat(5, 1fr);
    }
    
    .book-grid {
      grid-template-columns: repeat(3, 1fr);
    }
  }
  
  @media (max-width: 768px) {
    .category-menu {
      grid-template-columns: repeat(3, 1fr);
    }
    
    .book-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  
  @media (max-width: 480px) {
    .category-menu {
      grid-template-columns: repeat(2, 1fr);
    }
    
    .book-grid {
      grid-template-columns: 1fr;
    }
  }
  
  button {
    margin-bottom: 10px;
  }
  </style>