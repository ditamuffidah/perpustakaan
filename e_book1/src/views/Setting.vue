<template>
  <div class="setting-container">
    <div class="header">
      <div class="img-container">
        <!-- Binding gambar menggunakan `dok1Image` dari data -->
        <img :src="dok1Image" alt="Dok1" class="dok1-img" />
      </div>
      <div class="header-text">
        <h1>Setting</h1>
      </div>
    </div>
    <div class="account-label">
      <h3>Akun</h3>
    </div>
    <div class="account-section">
      <div class="account-icon">
        <!-- Placeholder for icon -->
      </div>
      <div class="account-name">
        <h1>{{ this.nama }}</h1>
      </div>
    </div>
    <div class="settings-form">
      <div class="setting-item">
        <input type="text" id="nama" v-model="nama">
      </div>
      <!-- <div class="setting-item">
        <span class="bold-text">0000987765</span>
      </div> -->
      <div class="setting-item">
        <input type="text" id="nama" v-model="email">
      </div>
      <div class="setting-item">
        <input type="password" id="password" v-model="password" placeholder="password (kosongkan jika tidak dirubah)">
      </div>
      <div class="setting-item">
        <button class="borrow-button" @click="simpanData"> Simpan</button>
      </div>

      
    </div>
  </div>
</template>

<script>
import dok1Image from '@/assets/logosetting.png';

export default {
  name: 'Setting',
  data() {
    return {
      dok1Image,
      nama:'',
      email:'',
      id_anggota:null
    };
  },
  created() {
    this.nama = JSON.parse(localStorage.getItem("user")).name || null;
    this.email = JSON.parse(localStorage.getItem("user")).email || null;
    this.id_anggota = JSON.parse(localStorage.getItem("user")).id || null;
  },
  methods: {
    simpanData() {
      const peminjamanData = {
        id_user: this.id_anggota,
        name: document.getElementById('nama').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value,
      };

      axios.post('/update-profile', peminjamanData, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`
        }
      })
        .then(response => {
          if (response.data.success) {
            alert('Profil berhasil di update!');
          } else {
            alert('Gagal update profile: ' + response.data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Terjadi kesalahan saat update profile.');
        });
    },
    edit(field) {
      // Logika untuk mengedit field yang dipilih
      console.log(`Edit ${field}`);
    },
    save() {
      // Logika untuk menyimpan perubahan
      console.log('Changes saved');
    },
    cancel() {
      // Logika untuk membatalkan perubahan
      console.log('Changes canceled');
    }
  }
}
</script>

<style scoped>
.borrow-button {
  width: 43%; /* Ukuran tombol "+ PINJAM BUKU" */
}


button:hover {
  background-color: #ddd;
}
/*latar belakang*/
.setting-container {
  background-color: #5a7ac5;
  width: 90vw;
  height: 84vh;
  padding: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
   position: fixed;
  top: 120px;
  left: auto;
  right: -70px;
  overflow: hidden;
}

/*garis*/
.header {
  width: 90%;
  display: flex;
  align-items: center;
  padding: 15px 0;
  border-bottom: 1px solid white;
  margin-bottom: 25px;
  margin-left: -20px;
}

/*teks setting*/
.header-text {
  font-size: 1.7rem;
  margin-left: 1.2%;
  font-weight: bold;
  color: white;
  margin-top: -10px;
}

/*gambar setting*/
.dok1-img {
  width: 40px; /* Sesuaikan lebar gambar */
  height: auto; /* Mempertahankan rasio aspek gambar */
  margin-left: 10%;
  object-fit: contain; /* Memastikan gambar tidak terdistorsi */
  filter: contrast(1.2) brightness(1.2); /* Meningkatkan kontras dan kecerahan jika diperlukan */
  margin-top: -10px;
}
/*teks akun*/
.account-label {
font-size: 1.3rem;
  margin-left: -85%;
  text-align: left;
  padding: 0;
  color: white;
  margin-bottom: -5px;
  font-weight: bold;
  margin-top: -1%;
}
/*teks nama pengguna*/
.account-section {
  display: flex;
  flex-direction: column; /* Pastikan elemen dalam flex terletak di kolom */
  text-align: left; /* Atur teks agar rata kiri */
  margin-top: 1%;
  margin-left: -900px; /* Hapus margin negatif agar teks tidak tergeser */
  color: white;
  margin-bottom: 20px;
  font-size: 28px;
  font-weight: bold;
}

/*kotak putih*/
.settings-form {
  background-color: #E6E6E6;
  border-radius: 40px;
  width: 50%;
  padding: 30px;
  color: #0E0101;
  margin-top: 15px;
  margin-left: 10px;
}
.setting-item {
  display: flex;
  align-items: center;
  justify-content: center; /* Ubah space-between menjadi center */
  margin-bottom: 20px;
  margin-top: 20px;
  font-size: 23px;
  text-align: center; /* Jika Anda ingin teks dalam elemen juga rata tengah */
}

.setting-item a:hover {
  text-decoration: underline;
}
</style>
