<template>
  <div id="app">
    <!-- Main Content -->
    <div class="main-content">

      <!-- Search and Buttons Section -->
      <div class="search-notification-wrapper">
        <div class="search-container">
          <input type="text" class="search-input" placeholder="Search..." />
          <span class="search-icon">
            <img src="@/assets/search.png" alt="Search Icon" width="50" height="50" />
          </span>
        </div>
        <div>
          <!-- Button Warning -->
          <button class="warning-button" @click="goToWarningPage">
            <span class="button-icon">
              <img src="https://static.vecteezy.com/system/resources/previews/009/663/941/non_2x/warning-icon-transparent-free-png.png" alt="Warning Icon" width="50" height="50" />
            </span>
            <span class="button-text">Warning</span>
          </button>
        </div>
        <button class="notification-button" @click="goToNotifikasi">
          <span class="button-icon">
            <img src="https://cdn-icons-png.flaticon.com/512/5035/5035563.png" alt="User Icon" width="50" height="50" />
          </span>
          <span class="button-text">Notification</span>
        </button>
      </div>

      <!-- Book Listing Sections -->
      <div class="content">
        <!-- Best Seller Section -->
        <div class="mb-10">
          <h2 class="text-3xl font-bold flex items-center">
            BE<img src="https://static.vecteezy.com/system/resources/previews/000/580/275/non_2x/flash-thunderbolt-template-vector-icon-illustration-vector.jpg" alt="Flash Thunderbolt Icon" class="flash-icon">T SELLER
          </h2>
          <div class="flex flex-wrap gap-6 mt-5">
            <div v-for="(book, index) in bestSellers" :key="index" class="text-center">
              <div class="book-container" @click="goToPeminjaman(book.id, book.isbn)">
              <!-- Gambar bintang di pojok kiri atas -->
               
              <img src="@/assets/pinbintang.png" alt="icon" class="icon-top-left" />
              <!-- Angka di tengah pin bintang -->
              <div class="icon-number">{{ index + 1 }}</div>
              <!-- Gambar buku -->
              <img 
  :src="book.gambar"
  alt="icon" 
  style="height:120px !important"
  class=" w-auto object-cover object-center rounded-md"
/>

              <!-- <img :src="book.gambar" class="book-image" alt="book image" /> -->
              <!-- Teks baru -->
              <div class="book-info">
                <p class="book-title">{{ book.judul_buku }}</p>
                <p class="book-author">{{ book.penulis }}</p>
                <p class="book-genre">{{ book.kategori }}</p>
              </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Rekomendasi Section -->
        <div>
          <h2 class="text-3xl font-bold">REKOMENDASI</h2>
          <div class="category-container">
            <div v-for="(category, index) in categories" :key="index" class="category-button" @click="goToSecondCatalog(category)">
              {{ category }}
            </div>
          </div>
          <div class="grid">
          <div v-for="(book, index) in recommendations" :key="index" class="text-center">
            <div class="book-container" @click="goToPeminjaman(book.id, book.isbn)">
              <!-- <img :src="book.image" class="book-image" alt="book image" /> -->
              <img 
  :src="book.gambar"
  alt="icon" 
  style="height:120px !important"
  class=" w-auto object-cover object-center rounded-md"
/>
              <p class="mt-3 font-bold">{{ book.title }}</p>
              <!-- Teks baru -->
              <div class="book-info">
                <p class="book-title">{{ book.judul_buku }}</p>
                <p class="book-author">{{ book.penulis }}</p>
                <p class="book-genre">{{ book.kategori }}</p>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
    <div>
      <h2 class="video">DOKUMENTASI VIDEO</h2>
    </div>
    <!-- Bagian bawah dengan video YouTube -->
    <div class="video-container">
      <!-- Menambahkan video YouTube -->
      <iframe src="https://www.youtube.com/embed/Bwn2qlml79M" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen> </iframe>
      <iframe src="https://www.youtube.com/embed/OeM0MwHkYro?si=Hw00J_dITm5-AxXS" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen> </iframe>
      <iframe src="https://www.youtube.com/embed/o7enCMuP384" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen> </iframe>
      <iframe src="https://www.youtube.com/embed/beYQ3uo6Gr8?si=hmewGOmZjXGDidOA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen> </iframe>
      <iframe src="https://www.youtube.com/embed/pkvQoLjOgzQ?si=4ImpWd475YD-Ywa_" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen> </iframe>
      <iframe src="https://www.youtube.com/embed/c4kQDqtKkFM?si=P4cxFghatGrMe98m" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen> </iframe>
      <iframe src="https://www.youtube.com/embed/cRx04yz8MrE?si=GjRlCxExofD37u_j" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen> </iframe>
      <iframe src="https://www.youtube.com/embed/82BxhP2PDNk?si=AlFsXiG7ULgJc1hh" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen> </iframe>
      <iframe src="https://www.youtube.com/embed/82BxhP2PDNk?si=AlFsXiG7ULgJc1hh" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen> </iframe>
    </div>
  </div>
</template>

<script>
import axios from '../axios'
export default {
  name: "Home",
  data() {
    return {
      id_buku : null,
      isbn: null,
      bestSellers: [],
      categories: ['Umum', 'Filsafat', 'Agama', 'Sosial', 'Bahasa', 'Sains', 'Teknologi', 'Seni', 'Sastra', 'Sejarah'],
      recommendations: [
        // { image: 'src/assets/informatika.png' },
        // { image: 'src/assets/hts.png' },
        // { image: 'src/assets/harumahameru.png' },
        // { image: 'src/assets/gadiskretek.png' },
        // { image: 'src/assets/fleshout.png' },
      ],
    };
  },
  created() {
    this.fetchBooks(); // Call fetchBooks when the component is created
  },
  methods: {
    fetchBooks() {
      axios.get('/buku')
        .then(response => {
          this.bestSellers = response.data;
          this.recommendations = response.data;
          console.log("Books fetched successfully:", bestSellers);
        })
        .catch(error => {
          console.error("There was an error fetching the books:", error);
        });
    },
    goToWarningPage() {
      this.$router.push({ name: 'Warning' });
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

    goToSecondCatalog(category) {
      this.$router.push({ name: 'SecondCatalog', params: { category } });
    },
    goToNotifikasi() {
      this.$router.push({ name: 'Notifikasi' });
    }
  }
};
</script>

<style scoped>
  /*Margin untuk main content*/
  .main-content {
    background-color: white;
    margin-left: 210px;
    width: calc(70% - 200px);
    padding-top: 420px;
    display: flex;
    flex-direction: column;
    align-items: center;
    box-sizing: border-box;
  }

  /* Background main content */
  .main-content {
    margin-left: 485px;
    width: 49vh;
    padding-top: 120px;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  /* Icon Warning + Icon Notifikasi */
  .warning-button .button-icon {
    width: 35px; 
    height: 35px; 
  }

   .button-icon{
    width: auto;
    height: auto;
   }

  .notification-button {
    width: 150px;
    height: 37px;
}
  .search-notification-wrapper {
    margin-top: 10px;
    display: flex;
    align-items: center;
    gap: 30px;
    padding: 10px;
  }

  .search-container { 
    display: flex;
    align-items: center;
    background-color: #e0e0e0;
    border-radius: 30px;
    padding: 2px;
    width: 700px; /* Adjusted width */
  }
  .search-input {
    border: none;
    outline: none;
    padding: 9px;
    border-radius: 3px;
    background-color: transparent;
    font-size: 18px;
    text-align: center;
    width: 200px;
  }
  .search-icon {
    position: absolute;
    margin-left: 20px;
    width: 20px;
  }

  .warning-button,
  .notification-button {
    color: black;
    border: 1px solid black;
    padding: 1px 20px;
    border-radius: 10px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    transition: background-color 0.3s, color 0.3s;
  }

  /* grid untuk tampilan main content */
  .category-container {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    gap: 10px;
    padding: 10px;
  }

  /* tampilan main content depan */
  .category-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 17px;
    border-radius: 20px;
    background-color: #e0e0e0;
    font-size: 13px;
    margin: 12px;
    text-align: center;
    white-space: nowrap;
    font-weight: bold;
  }

  /* grid untuk buku best seller */
  .book-image {
    margin-top: -25px;
    gap: 20px;
    width: 100px;
    height: auto;
    object-fit: cover;
    border-radius: 10px;
    margin-left: -9px;
  }

  /* margin untuk teks best seller */
  .mb-10 h2 {
    margin-left: 35px; /* Geser teks ke kanan, sesuaikan nilai sesuai kebutuhan */
  }

  /* Menggeser teks REKOMENDASI ke kanan */
  h2.text-3xl.font-bold {
    margin-left: 30px; /* Atur nilai ini untuk menggeser sesuai kebutuhan */
  }

  /* Atau untuk menggeser ke kiri */
  h2.text-3xl.font-bold {
    margin-right: 20px; /* Atur nilai ini untuk menggeser sesuai kebutuhan */
  }

  /* Menggeser teks REKOMENDASI ke kanan */
  h2.video {
    margin-left: 140px; /* Atur nilai ini untuk menggeser sesuai kebutuhan */
    font-weight: bold;
    font-size: 1.8rem;
    margin-top: 20px;
  }

  /* icon petir */
  .flash-icon {
    width: 23px;
    height: 40px;
    margin-left: 2px;
    margin-top: 3px;
  }

  /* Angka di tengah pin bintang */
  .icon-number {
    position: absolute;
    top: -12px; /* Sesuaikan agar angka berada di tengah bintang */
    left: -10px; /* Sesuaikan agar angka berada di tengah bintang */
    font-size: 14px; /* Ukuran angka */
    font-weight: bold;
    color: black; /* Warna angka */
    z-index: 20; /* Pastikan angka di atas bintang */
    width: 20px; /* Lebar angka, menyesuaikan jarak */
    text-align: center; /* Posisikan angka di tengah */
    pointer-events: none; /* Agar angka tidak mengganggu interaksi hover bintang */
  }

  /* Mengatur posisi gambar di pojok kiri atas */
  .icon-top-left {
    position: absolute;
    top: -20px; /* Atur jarak dari atas */
    left: -20px; /* Atur jarak dari kiri */
    width: 40px; /* Lebar gambar */
    height: auto; /* Sesuaikan tinggi secara otomatis */
    z-index: 10; /* Pastikan gambar berada di atas elemen lain */
  }

  /*gambar buku dalam box*/
  .book-image {
    width: 150px; /* Anda bisa mengatur lebar sesuai kebutuhan */
    height: auto; /* Mengatur tinggi otomatis untuk menjaga proporsi */
    border-radius: 8px; /* Membuat sudut gambar membulat */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Menambahkan efek bayangan */
    transition: transform 0.3s, box-shadow 0.3s; /* Efek transisi saat hover */
    margin-left: 1px;
    display: block;
    margin-top: -35%;
  }

  /*code agar tampilan gambar buku menjadi muncul*/
  .book-image:hover {
    transform: scale(1.05); /* Membesar sedikit saat hover */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* Mengubah efek bayangan saat hover */
  }

  /* box belakang buku */
  .book-container {
    background-color: #D9D9D9; /* Warna latar belakang putih transparan */
    border-radius: 8px; /* Sudut membulat */
    padding: 40px; /* Memberikan sedikit ruang di dalam kotak */
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2); /* Bayangan di sekeliling kotak */
    display: inline-block; /* Menghindari elemen div membentang penuh */
    height: 300px;  /* Tambahkan tinggi agar cukup untuk teks */
    width: 170px;
    margin-left: 25px;
    position: relative;
  }

  /* menambahkan garis hitam di bawah gambar buku */
  .book-container::after {
    content: '';
    display: block;
    height: 2px; /* Ketebalan garis */
    background-color: black; /* Warna garis */
    width: 70%; /* Garis sepanjang kotak */
    position: absolute;
    bottom: 120px; /* Jarak dari bagian bawah kotak */
    left: 0;
    margin-left: 1.75pc;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s, box-shadow 0.3s;
  }

  /* menata teks buku di dalam box */
  .book-info {
    position: absolute;
    bottom: 10px; /* Menempatkan teks di bawah garis */
    left: 0;
    right: 0;
    text-align: center; /* Menjaga agar teks berada di tengah */
  }

  /* style untuk masing-masing teks - teks dalam box untuk judul */
  .book-title {
    font-size: 20px;
    font-weight: bold;
    color: #000000;
    margin-bottom: 1ch; /* Kurangi jarak antara judul dan penulis */
  }

  /*teks dalam box untuk penulis*/
  .book-author {
    font-size: 15px;
    color: #000000; /* Warna teks yang lebih halus */
    margin-bottom: 0.9ch; /* Sesuaikan jika perlu */
  }

  /*teks dalam box untuk kategori*/
  .book-genre {
    font-size: 15px;
    color: #000000; /* Warna lebih halus untuk genre */
  }

  /* tata letak gambar buku rekomendasi */
  .grid {
    margin-top: 15px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
    margin-left: -9px;
  }

  .video-container {
  display: grid;
  grid-template-columns: repeat(3, 2fr);
  justify-content: space-between; /* Memberi ruang antara kolom */
  gap: 70px; /* Mengurangi jarak antar kolom */
  margin-top: 40px; /* Hanya memberi margin atas */
  margin-left: 150px; /* Margin kiri tetap kecil */
  margin-right: -85px; /* Tambahkan margin kanan jika perlu */
}

iframe {
  width: 20vw; /* Mengatur lebar kolom agar ada tiga dalam satu baris */
  height: 200px;
  margin: 0; /* Menghapus margin untuk mengurangi jarak */
}

</style>