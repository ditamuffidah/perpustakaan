<template>
  <div class="app-container">
    <header>
       <button class="back-button" @click="goBack">&#8592;</button>
      <h1 class="warning-text">WARNING</h1>
      <div class="logo-container">
        <img alt="Matematika logo" class="logo" :src="book.gambar">
      </div>
      <div class="wrapper">
     <!-- Menampilkan batas waktu peminjaman -->
    <div class="batas-waktu-text">
      <p class="bold-text">Batas waktu peminjaman buku :</p>
      <span class="small-text bordered-text">{{ deadlineDays }} hari</span>
    </div>

    <!-- Sisa Waktu Pengembalian -->
    <div class="return-time-box">
      <p class="bold-text">Sisa waktu pengembalian :</p>
      <div class="running-time-box">
        <p class="time">{{ returnTime }}</p>
      </div>
    </div>

    <!-- Perpanjang Masa Peminjaman -->
    <div class="extension-box">
      <div class="extension-header">
        <p class="bold-text">
          Perpanjang masa peminjaman :
          <span class="days-text">{{ extendDays }} hari</span>
        </p>
      </div>
      <div class="days-controls">
        <button @click="decreaseDays">-</button>
        <button @click="increaseDays">+</button>
      </div>
      <div class="action-buttons">
        <button class="cancel-button" @click="cancelExtension">Batal</button>
        <button class="save-button" @click="saveExtension">Ok</button>
      </div>
      </div>

      </div>
    </header>
  </div>
</template>

<script>
import axios from '../axios'
export default {
  name: 'Warning',
  data() {
    return {
      deadline: new Date(), // Tanggal batas peminjaman default
      returnTime: '', // Waktu pengembalian
      deadlineDays: 0, // Hari tersisa hingga batas waktu
      extendDays: 0, // Hari tambahan yang diusulkan
      id_anggota: null,
      id_buku:null,
      id_peminjaman:null,
      book:[],
    };
  },

  created(){
    this.id_anggota = JSON.parse(localStorage.getItem("user")).id || null;
    this.fetchData();
  },
  beforeDestroy() {
    clearInterval(this.timeInterval);
    clearInterval(this.dayInterval);
  },
  methods: {
    fetchData() {
      axios.get('/buku/terpinjam/'+this.id_anggota)
        .then(response => {
          this.book = response.data; // Update to directly assign the response data
          this.id_peminjaman = this.book.id_peminjaman
          this.id_buku = this.book.id_buku
          console.log("Books fetched successfully:", this.book);
          this.deadline = new Date(this.book.tanggal_pengembalian); // Set deadline to the parsed date
          this.updateDeadlineDays();
          this.updateReturnTime();

          // Update waktu pengembalian setiap detik
          this.timeInterval = setInterval(this.updateReturnTime, 1000);
          this.dayInterval = setInterval(this.reduceOneDay, 1000 * 60 * 60 * 24);
        })
        .catch(error => {
          console.error("There was an error fetching the books:", error);
        });
    },
    // Method untuk tombol kembali
    goBack() {
      this.$router.push({ name: 'Home' }); // Mengarahkan ke halaman 'Home'
    },  
  
    // Menghitung hari tersisa hingga batas waktu
    updateDeadlineDays() {
      const now = new Date();
      const remainingTime = this.deadline - now;
      this.deadlineDays = Math.max(0, Math.ceil(remainingTime / (1000 * 60 * 60 * 24)));
    },

    // Update sisa waktu pengembalian
    updateReturnTime() {
      const now = new Date();
      const remainingTime = this.deadline - now;

      if (remainingTime <= 0) {
        this.returnTime = "Waktu Habis";
        clearInterval(this.timeInterval); // Hentikan interval jika waktu habis
        return;
      }

      const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
      this.returnTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    },

    // Kurangi 1 hari setiap 24 jam
    reduceOneDay() {
      if (this.deadlineDays > 0) {
        this.deadlineDays -= 1;
        this.updateReturnTime();
      }
    },

    increaseDays() {
      if (this.extendDays < 3) {
        this.extendDays += 1;
      } else {
        alert("Perpanjangan maksimal hanya 3 hari.");
      }
    },

    decreaseDays() {
      if (this.extendDays > 0) this.extendDays -= 1;
    },

    cancelExtension() {
      this.extendDays = 0;
    },

    // Simpan perpanjangan masa peminjaman
    saveExtension() {
      if (this.extendDays > 0) {
        // alert(`Perpanjangan peminjaman untuk ${this.extendDays} hari disimpan.`);
        // Tambahkan hari ke deadline
          const peminjamanData = {
            id_buku: this.id_buku,
            id_peminjaman:this.id_peminjaman,
            id_anggota: this.id_anggota,
            tambah_hari:this.extendDays
          };

        axios.post('/tambah-waktu', peminjamanData, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`
          }
        })
          .then(response => {
            if (response.data.success) {
              alert(`Perpanjangan peminjaman untuk ${this.extendDays} hari disimpan.`);
              // this.$router.push("/peminjaman");
            } else {
              alert('Gagal menambah durasi: ' + response.data.message);
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat meminjam buku.');
          });
        this.deadline.setDate(this.deadline.getDate() + this.extendDays);
        this.extendDays = 0;
        // Update batas waktu peminjaman setelah perpanjangan
        this.updateDeadlineDays();
        this.updateReturnTime();
      } else {
        alert("Tidak ada perpanjangan yang ditambahkan.");
      }
    },
  },
};
</script>



<style scoped>
.back-button {
  background: none; /* Menghilangkan kotak putih */
  border: none; /* Menghilangkan border */
  font-size: 42px; /* Ukuran font untuk panah */
  color: white; /* Mengubah warna tombol menjadi putih */
  cursor: pointer; /* Mengubah kursor saat hover */
  margin-left: -1500px; /* Spasi antara tombol dan judul */
  margin-top: -5px;
}
  /* Container Utama untuk aplikasi, mengatur warna latar belakang, ukuran, dan tata letak */
  .app-container {
    position: fixed;
    top: -10px;
    left: 0;
    background-color: #5a7ac5;
    min-height: 100vh; /* Menyesuaikan tinggi minimal dengan viewport */
    width: 100vw; /* Memastikan lebar penuh */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    box-sizing: border-box;
    padding: 20px; /* Opsional: tambahkan padding untuk konten */
}

  /* Header */
  header {
    text-align: center;
  }

  /* Teks Peringatan WARNING */
  .warning-text {
    color: #8E0909;
    font-size: 4rem;
    font-weight: bold;
    margin-bottom: 1rem;
    margin-left: 2%;
    margin-top: -65px;
  }

  /* Teks kecil yang muncul di batas waktu peminjaman buku. */
  .small-text {
    font-size: 1rem; /* Ukuran teks yang sesuai */
  }

  /* Container untuk Logo - Mengatur penataan logo */
  .logo-container {
    display: flex;
    justify-content: center;
    margin-bottom: 1rem;
  }

  /* Logo gambar "Matematika". */
  .logo {
    width: 125px;
    height: auto;
    border-radius: 9px;
    margin-left: 6%;
  }

  /* Container untuk elemen lain seperti waktu peminjaman, sisa waktu, dan perpanjangan. */
  .wrapper {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-end;
  }

  /* Kotak yang berisi sisa waktu pengembalian buku. */
  .return-time-box {
    padding: 0rem 1rem;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: flex-start; /* Mengatur alignment teks ke sebelah kiri */
    margin-bottom: 1rem;
    max-width: 600px;
    width: 100%; /* Pastikan lebar penuh agar teks bisa bergerak ke kiri */
    margin-left:-3%; /* Geser ke kiri */
    margin-top: 10px; /* Geser ke bawah */
     font-size: 2rem; /* Ubah ukuran teks sesuai kebutuhan */
  }

  /* Ukuran teks untuk sisa waktu pengembalian */
.remaining-time-text {
    font-size: 2rem; /* Ukuran teks yang lebih besar untuk sisa waktu pengembalian */
    color: #8E0909;
    font-weight: bold;
}

  /* Kotak waktu berjalan. */
  .running-time-box {
    font-size: 1.5rem; /* Ukuran teks yang lebih kecil untuk jam berjalan */
    color: #D34043;
    background-color: #D34043;
    padding: 0.1rem 1rem;
    border-radius: 5px;
    display: flex;
    align-items: center;
    margin-left: 3rem; /* Mengatur jarak antara teks dan waktu yang bergerak */
    opacity: 0.75; /* Transparansi 75% */
    font-weight: 600; /* Semi-bold */
  }

  /* Teks waktu yang berjalan. */
  .time {
    color: #8E0909;
    margin-left: 0.5rem;
  }

  /* Teks dengan latar belakang kotak (digunakan untuk menampilkan batas waktu). */
  .bordered-text {
    background-color: #D34043; /* Warna latar belakang merah */
    color: #8E0909; /* Warna teks merah */
    padding: 0.1rem 3rem;
    border-radius: 4px;
    margin-left: 20%;

  }/* Teks dengan latar belakang kotak (digunakan untuk menampilkan batas waktu). */
  .bordered-text {
    background-color: #D34043; /* Warna latar belakang merah */
    color: #8E0909; /* Warna teks merah */
    padding: 0.1rem 1rem; /* Sesuaikan padding agar kotak tetap terjaga */
    border-radius: 4px;
    margin-left: 50%;
    font-size: 1.5rem; /* Ukuran font yang lebih besar */
    opacity: 0.75; /* Transparansi 70% */
    font-weight: 600; /* Semi-bold */
    text-align: left; /* Menyelaraskan teks ke kiri */
  }

  .bordered-text-container {
    display: flex;
    align-items: center;
    gap: 0.5rem; /* Jarak antara teks */
     justify-content: flex-start; /* Memastikan konten berada di kiri */
  }

  /* Header di bagian perpanjangan waktu peminjaman. */
  .extension-header {
    display: flex;
    justify-content: space-between;
    padding: 0.1rem 1rem; /* Sesuaikan padding agar kotak tetap terjaga */
    border-radius: 8px;
    align-items: center;
    margin-bottom: 1rem;
    width: 100%;
    max-width: 600px;
    margin-top: 10px;
    margin-left: -3%;
    margin-right: 20px;
    font-size: 2rem; /* Ubah ukuran teks sesuai kebutuhan */
  }

  /* Kontrol untuk menambah dan mengurangi hari perpanjangan. */
  .days {
    font-size: 1rem; /* Ukuran font untuk teks hari */
    font-weight: regular; /* Membuat teks hari tebal */
  }
  .days-controls {
    display: flex; /* Mengatur kontrol hari dengan Flexbox untuk menyusun elemen secara horizontal */
    gap: 0.5rem; /* Jarak antara tombol kontrol hari (- dan +) */
    margin-bottom: 1rem; /* Jarak bawah antara kontrol dan elemen lainnya */
  }
  .days-wrapper {
    background-color: #D34043; /* Latar belakang merah untuk wrapper kontrol hari */
    padding: 0.1rem 1rem; /* Ruang di dalam wrapper */
    border-radius: 2px; /* Membuat sudut sedikit melengkung */
  }
  .days-text {
    background-color: #D34043; /* Warna latar belakang merah untuk teks hari */
    color: #8E0909; /* Warna teks merah */
    padding: 0.1rem 0.6rem; /* Ruang di sekitar teks */
    border-radius: 4px; /* Membuat sudut yang lebih melengkung */
    display: inline-block; /* Agar padding dan border-radius berfungsi dengan baik */
    margin-left: 1px; /* Jarak ke kiri, namun ini sepertinya harus dalam satuan seperti px */
    opacity: 0.75; /* Transparansi 70% */
    font-weight: 600; /* Semi-bold */
    font-size: 1.5rem;
  }

  .batas-waktu-text {
    display: flex; /* Mengatur elemen dalam batas waktu menggunakan Flexbox agar tersusun horizontal */
    align-items: center; /* Menyusun elemen secara vertikal agar rata di tengah */
    margin-left: 0.2; /* Menghilangkan margin kiri agar elemen berada di sebelah kiri */
}

.batas-waktu-text .bold-text {
    margin-right: 1.5rem; /* Jarak antara teks deskripsi 'Batas waktu peminjaman buku:' dan angka hari */
    font-size: 2rem; /* Ubah ukuran teks sesuai kebutuhan */
}

.batas-waktu-text .small-text {
    margin-left: 0.5rem; /* Jarak antara angka hari dan teks 'hari' */
}

.batas-waktu-text .bold-number {
    font-weight: bold; /* Menebalkan teks untuk angka hari */
    font-size: 1rem; /* Ukuran font untuk angka hari */
}

  /* Tombol Aksi (Batal dan OK) */
  .action-buttons
.days-controls {
    display: flex;
    justify-content: flex-start; /* Mengatur tombol ke sebelah kiri */
    gap: 0.1rem; /* Menambahkan sedikit jarak antar tombol */
    margin-bottom: 1rem; /* Jarak bawah untuk tombol */
}

/* Gaya dasar untuk semua tombol. */
button {
    padding: 0.5rem 1rem;
    background-color: #ffffff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold; /* Menebalkan teks */
    color: #000000; /* Warna teks hitam */
    margin: 0; /* Menghapus margin untuk mendekatkan tombol */
    margin-left: 16rem;
    margin-right: -14rem;
}

/* Tambahkan kelas untuk tombol minus dan plus jika perlu */
.button-minus {
    margin-right: 0.5rem; /* Memberikan jarak antar tombol */
  }

button:hover {
    background-color: #e0e0e0; /* Warna latar belakang saat hover */
}

.cancel-button,
.save-button {
    color: #000000; /* Warna teks hitam */
    font-weight: bold; /* Gaya teks tebal */
    margin-left: 4rem;
    margin-right: -0.3rem;
}

</style>