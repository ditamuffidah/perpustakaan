<template>
  <!-- Main Content -->
  <div class="main-content">
    <!-- Catalogue Section -->
    <div class="catalog">
      <!-- Category Menu -->
      <div class="category-menu">
        <button v-for="category in categories" :key="category.nama" @click="goToSecondCatalog(category.nama)">
          {{ category.nama }}
        </button>
      </div>

      <!-- Book Grid -->
       <div class="book-grid">
        <div v-for="book in books" :key="book.id" class="book-card" @click="goToSecondCatalog(book.kategori)">
          <div class="book-container">
          <img :src="book.gambar" :alt="book.judul_buku" class="book-image" />
            <h3 class="book-title">{{ book.judul_buku }}</h3>
            <div class="book-info">
              <div class="book-genre">{{book.kategori}}</div>
              <div class="book-details">
                <p class="book-title">{{ book.judul_buku }}</p>
                <p class="book-publisher">{{book.penulis}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import umum1Image from '@/assets/umum1.jpg';
import filsafat1Image from '@/assets/filsafat1.jpg';
import agama1Image from '@/assets/agama1.jpg';
import sosial1Image from '@/assets/sosial1.jpg';
import bahasa2Image from '@/assets/bahasa2.jpg';
import i2Image from '@/assets/i2.jpg';
import t2Image from '@/assets/t2.jpg';
import seni2Image from '@/assets/seni2.jpg';
import s1Image from '@/assets/s1.jpg';
import se1Image from '@/assets/se1.jpg';
import axios from '../axios'

export default {
  name: 'Catalog',
  data() {
    return {
      genre:"",
      categories: [],
      books: [],
    };
  },
  created() {
    this.fetchBooks(); // Call fetchBooks when the component is created
  },
  methods: {
    fetchBooks() {
      axios.get('/buku_and_category')
        .then(response => {
          this.books = response.data.books;
          this.categories = response.data.category;
          console.log("Books fetched successfully:", books);
        })
        .catch(error => {
          console.error("There was an error fetching the books:", error);
        });
    },
    goToSecondCatalog(category) {
      // Redirect ke SecondCatalog dengan parameter kategori yang diklik
      this.$router.push({ name: 'SecondCatalog', params: { category } });
    }
  }
};
</script>

<style scoped>
#app {
  font-family: Arial, sans-serif;
  display: flex;
  min-height: 100vh;
}
  
/*posisi margin untuk box genre*/
.category-menu {
  display: grid;
  grid-template-columns: repeat(10, 2fr);
  gap: 15px;
}
  
/*background untuk kotak button genre*/  
.category-menu button {
  padding: 5px 5px;
  background-color: rgba(211, 211, 211, 0.5); /* Background transparan */
  color: rgb(255, 253, 253); /* Warna teks */
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
  
/* tata letak untuk gambar buku*/  
.book-grid {
  display: grid;
  grid-template-columns: repeat(5, 2fr);
  gap: 10px;
  justify-items: center;
  max-width: 100%;
  align-items: center;
  padding: 15px; /* Kurangi padding di dalam container */
  margin: 10px;
}
  
/*grid untuk gambar buku*/
.book-card {
  border-radius: 16px;
  padding: 15px;
  text-align: center;
  width: 190px; /* Sesuaikan lebar sesuai kebutuhan */
  flex-grow: 1;
  gap: 20px;
}

/*ukuran grid catalog untuk box buku*/
.book-container {
  position: relative;
  width: 90%;
  margin: 20px auto;
}

/* Gaya untuk gambar buku */
.book-image {
  width: 100%; /* Sesuaikan lebar dengan container */
  height: auto;
  border-radius: 10px;
  display: block;
}

/* Box teks di atas gambar */
.book-info {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 10px;
  background: rgba(0, 0, 0, 0.5); /* Warna latar belakang transparan */
  border-radius: 10px; /* Ikuti border radius dari gambar */
  color: white;
}

/* Style untuk teks genre */
.book-genre {
  margin-top: 125px;
  margin-left: 30px;
  font-size: 14px;
  background: 	#143063;
  opacity: 85%;
  padding: 1px 16px;
  border-radius: 5px;
  max-height: 12%;
  align-self: flex-start; /* Agar teks berada di kiri atas */
}

/*teks title*/
.book-title {
  font-size: 16px;
  margin: 0;
  padding: 0px 20px;
  border-radius: 5px;
  font-weight: bold;
}

/* untuk teks penerbit tdk bold*/
.book-publisher{
  font-size: 12px;
  text-align: center;
  margin: 0;
  padding: 0px 20px;
  border-radius: 5px;
  font-weight: normal; /* Mengatur agar tidak bold untuk penerbit */
}

 /* Style untuk judul dan penerbit */
.book-details {
  text-align: center;
}
   
/* background main content catalog */
.catalog {
  position: fixed; /* Membuat elemen tetap pada posisi */
  top: 19%;
  left: 17%;
  width: 86vw; /* Memastikan lebar penuh layar */
  height: 81vh; /* Menetapkan tinggi elemen untuk bisa scroll */
  background-color: #5a7ac5; /* Latar belakang biru */
  text-align: center;
  padding: 50px;
  cursor: pointer;
  background-size: cover; /* Latar belakang menutupi seluruh elemen */
  background-position: center; /* Latar belakang di tengah */
  overflow-y: auto; /* Menambahkan scroll secara vertikal */
  margin: 0; /* Hilangkan margin */
}

</style>