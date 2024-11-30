<template>
  <div id="app">
    <!-- Main Content -->
    <div class="main-content">
      <!-- Content Wrapper -->
      <div class="container">
        <div class="content-wrapper">
          <img :src="book.gambar" alt="Book Image" class="image-section" />
          <div class="peminjaman">
            <div class="form-section">
              <h2>{{book.judul_buku}}</h2>
              <h3>{{ book.penulis }}</h3>


              <button class="genre-button">{{book.kategori}}</button>

              <hr />
              <div class="form-group">
                <label for="id-buku">ID Buku</label>
                <input type="text" id="id-buku" v-model="id_buku">
              </div>
              <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" v-model="isbn" />
              </div>
              <div class="form-group">
                <label for="id-anggota">ID Anggota</label>
                <input type="text" id="id-anggota" v-model="id_anggota"/>
              </div>
              <div class="form-group">
                <label for="tanggal-pengembalian">Tanggal Pengembalian</label>
                <input type="date" id="tanggal-pengembalian" v-model="tanggal_pengembalian" />
              </div>
              <div class="form-group">
                <label for="status">Status</label>
                <input type="text" id="status" v-model="status"/>
              </div>
              <div class="form-group">
                <label for="denda">Denda</label>
                <input type="number" id="denda" v-model="denda"/>
              </div>
              <div class="button-container">
                <button id="book-availability" @click="handleReturnBook">KEMBALIKAN BUKU</button>
              </div>
            </div>
          </div>
        </div>
        <hr />

        <!-- Description Section -->
        <section class="description">
          <h2>DESKRIPSI</h2>
          <p>
            {{ book.keterangan }}
          </p>
        </section>

        <!-- Review Section -->
        <section class="review">
          <h3>ULASAN</h3>
          <p>Belum ada ulasan untuk buku ini. Jadilah yang pertama untuk mengulas!</p>
        </section>
      </div>
    </div>
  </div>
</template>

<script>
import axios from '../axios'
export default {
  name: "Pengembalian",
  data() {
    return {
      id_buku: null,
      isbn: '',
      id_peminjaman:'',
      status:'',
      denda:'',
      tanggal_pengembalian:'',
      id_anggota: null,
      isAvailable: true,
      book:[]
    };
  },
  created() {
    // Menangkap data dari query
    this.id_buku = this.$route.query.id_buku || "1111";
    this.isbn = this.$route.query.isbn || '';
    this.id_peminjaman = this.$route.query.id_peminjaman || '';
    this.id_anggota = JSON.parse(localStorage.getItem("user")).id || null;
    this.fetchBooks();
  },
  methods: {
    fetchBooks() {
        axios.get('/buku/detail/'+this.id_buku)
        .then(response => {
          this.book = response.data; // Update to directly assign the response data
          console.log("Books fetched successfully:", this.book);
        })
        .catch(error => {
          console.error("There was an error fetching the books:", error);
        });
    },
    handleReturnBook() {
      const peminjamanData = {
        id_peminjaman : this.id_peminjaman,
        id_buku: this.id_buku,
        isbn: this.isbn,
        id_anggota: this.id_anggota,
        status: document.getElementById('status').value,
        denda: document.getElementById('denda').value,
        tanggal_pengembalian: document.getElementById('tanggal-pengembalian').value,
      };

      axios.post('/kembalikan-buku', peminjamanData, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`
        }
      })
        .then(response => {
          if (response.data.success) {
            alert("Buku berhasil dikembalikan!");
            this.$router.push("/riwayat");
          } else {
            alert('Gagal mengembalikan buku: ' + response.data.message);
            this.goToStatus();
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Terjadi kesalahan saat mengembalikan buku.');
        });
      
    },
  },
};
</script>

<style scoped>
#app {
  font-family: Arial, sans-serif;
  display: flex;
}

.main-content {
  position: fixed;
  /* Mengatur posisi agar selalu di tempat */
  top: 0;
  /* Mulai dari atas */
  left: 250px;
  /* Menyesuaikan lebar sidebar */
  width: calc(100% - 200px);
  /* Sesuaikan lebar untuk mengisi sisa ruang */
  height: 100%;
  /* Mengisi tinggi layar */
  padding-top: 120px;
  /* Ruang untuk header */
  display: flex;
  flex-direction: column;
  overflow: hidden;
  /* Cegah scrolling horizontal */
  z-index: 5;
  /* Pastikan di atas elemen lain */
}

.form-section h2 {
font-size: 35px; /* Ukuran font lebih besar */
font-weight: bold; /* Agar teks terlihat lebih tegas */
color: white; /* Warna putih agar kontras dengan background */
margin-top: -100px; /* Geser teks ke atas */
margin-bottom: 10px; /* Memberi sedikit jarak dengan elemen di bawahnya */
}

.form-section h3 {
font-size: 35px; /* Ukuran font lebih besar */
font-weight: bold; /* Agar teks terlihat lebih tegas */
color: white; /* Warna putih agar kontras dengan background */
margin-top: -0px; /* Geser teks ke atas */
margin-bottom: 1px; /* Memberi sedikit jarak dengan elemen di bawahnya */
}

.container {
  width: 100%;
  /* Change to 100% to avoid overflow */
  height: 90vh;
  background-color: #5a7ac5;
  color: white;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  box-sizing: border-box;
  overflow: auto;
  /* Only vertical scrolling */
  z-index: 1;
}

.content-wrapper {
  display: flex;
  align-items: flex-start;
  padding: 20px;
  box-sizing: border-box;
}

.image-section {
  width: 40%; /* Lebar gambar tetap */
  height: 85vh; /* Tinggi tetap untuk menjaga gambar tidak bergerak */
  border-radius: 10px;
  margin-right: 50px; /* Ruang antara gambar dan konten */
  margin-left: 0px; /* Ruang antara gambar dan tepi */
  overflow: hidden; /* Mencegah konten melampaui batas */
  display: flex; /* Gunakan flex untuk gambar */
  align-items: center; /* Pusatkan gambar secara vertikal */
}

.peminjaman {
  width: 50%;
  position: sticky;
  top: 120px;
  /* Adjust to header height */
}

.form-section {
  flex: 2;
}

.form-group {
  display: flex;
  align-items: center;
  margin-bottom: 14px;
}

.form-group label {
  width: 700px;
  margin-right: 20px;
}

.form-group input {
  width: 100%;
  padding: 4px;
  border-radius: 4px;
  border: 1px solid #D9D9D9;
  box-sizing: border-box;
  color:#000;
}

.genre-button {
  background-color: rgba(255, 255, 255, 0.1); /* Semi-transparan */
  background-image: url('src/assets/label.png');
  background-size: 25px auto; /* Membuat gambar lebih kecil dan proporsional */
  background-position: 5px center; /* Posisi gambar di kiri dengan jarak */
  background-repeat: no-repeat;
  border: 2px solid white;
  border-radius: 9px;
  padding: 10px 10px 10px 40px; /* Padding kiri untuk memberi ruang gambar */
  font-weight: bold;
  margin-bottom: 10px;
  width: 80px; /* Lebar lebih leluasa */
  height: 30px; /* Tinggi lebih leluasa */
  color: white;
  text-align: left;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  transition: background-color 0.3s;
  gap: 100px; /* Tambahkan jarak antara label gambar dan teks */
  margin-left: -2px;
}

/* Button container styling */
.button-container {
  display: flex;
  justify-content: space-between;
}

/* General button styling */
button {
  border-radius: 5px;
  padding: 10px;
  border: none;
  background-color: rgba(211, 211, 211, 0.9);
  color: #ffffff;
  cursor: pointer;
  width: 43%;
margin-left: 315px;
}

button:hover {
  background-color: #ddd;
}

.description {
  flex-shrink: 0;
  /* Prevents it from shrinking when space is limited */
}

/* Styling untuk elemen .description dan .review */
.description,
.review {
  display: flex;
  flex-direction: column; /* Mengatur konten secara vertikal */
  justify-content: flex-start; /* Menyelaraskan konten ke atas */
  margin-top: -17px; /* Mengurangi jarak dari elemen lain */
}

.description h2,
.review h3 {
  background-color: rgba(211, 211, 211, 0.6);
  flex-shrink: 0; /* Mencegah penyusutan saat ruang terbatas */
  padding: 5px;
  margin-left: 24px; /* Menyelaraskan dengan lebar foto + margin */
  margin-bottom: -18px; /* Mengurangi jarak bawah untuk memindahkan teks ke atas */
  box-sizing: border-box;
  max-width: 120px;
  border-radius: 5px;
  font-weight: bold;
  font-size: 15px;
  text-align: center;
}


/* Gaya untuk paragraf agar menjadi 3 bagian */
.description p,
.review p {
  font-size: 15px;
  line-height: 1.6;
  margin: 10px 0;
  text-align: justify; /* Agar paragraf rata kiri-kanan */
  max-width: 1100px; /* Batasi lebar teks agar tidak terlalu panjang */
  word-wrap: break-word; /* Pastikan teks yang terlalu panjang terbungkus rapi */
}

.description button,
.review button {
  margin-top: 0; /* Pastikan tidak ada jarak di atas tombol */
  margin-bottom: 10px; /* Atur jarak bawah jika diperlukan */
}

/* Paragraph styling */
p {
  margin-top: 17px;
  line-height: 1.5;
  padding: 25px;
  text-align: justify;
  /* Optional: To justify the text */
}

.review {
  border-top: 2px solid #FFFF;
  padding-top: 20px; /* Ruang atas di dalam review section */
   margin-top: 1px; /* Menambah jarak antara garis atas dan teks */
}

hr {
  margin-top: 20px;
  margin-bottom: 36px;
  border: none;
  width: 100%;
  border-top: 2px solid #ffffff;
}

</style>