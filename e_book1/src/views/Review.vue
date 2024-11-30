<template>
  <div id="app">
    <!-- Main Content -->
    <div class="main-content">
      <div class="container">
        <div class="card">
          <h2 class="card-title">Review Buku</h2>
          <div class="form-group">
            <label for="rating">Rating</label>
            <input
              type="number"
              id="rating"
              class="input-field"
              v-model="rating"
              placeholder="Masukkan rating (1-5)"
            />
          </div>
          <div class="form-group">
            <label for="review">Review</label>
            <textarea
              name="review_text"
              id="review_text"
              class="textarea-field"
              placeholder="Masukkan lama peminjaman (contoh: 7 hari)"></textarea>
          </div>
          <div class="button-container">
            <button class="borrow-button" @click="submitReview">Beri Review</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import axios from '../axios'
export default {
  name: "Review",
  data() {
    return {
      id_buku: null,
      id_peminjaman: '',
      id_anggota: null,
      isAvailable: true,
      book:[]
    };
  },
  created() {
    // Menangkap data dari query
    this.id_buku = this.$route.query.id_buku ;
    this.id_peminjaman = this.$route.query.id_peminjaman || '';
    this.id_anggota = JSON.parse(localStorage.getItem("user")).id || null;
  },
  methods: {
    goToStatus() {
      this.$router.push("/status");
    },
    submitReview() {
      const peminjamanData = {
        id_buku: this.id_buku,
        id_peminjaman: this.id_peminjaman,
        id_anggota: this.id_anggota,
        rating: document.getElementById('rating').value,
        review: document.getElementById('review_text').value,
      };

      axios.post('/review', peminjamanData, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`
        }
      })
        .then(response => {
          if (response.data.success) {
            alert('Berhasil memberikan review!');
            this.$router.push("/siswa/riwayat");
          } else {
            alert('Gagal memberikan review: ' + response.data.message);
            this.goToStatus();
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Terjadi kesalahan saat memberikan review.');
        });
    }

  }
};
</script>



<style scoped>
/* General Layout */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f5f5f5;
}

.main-content {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.container {
  width: 100%;
  max-width: 80vw;
  padding: 20px;
  box-sizing: border-box;
}

/* Card Design */
.card {
  background: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.card-title {
  font-size: 1.5rem;
  margin-bottom: 20px;
  color: #333;
}

/* Form Styles */
.form-group {
  margin-bottom: 15px;
  text-align: left;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
  color: #555;
}

.input-field,
.textarea-field {
  width: 100%;
  padding: 10px;
  font-size: 1rem;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
  outline: none;
  transition: border-color 0.3s ease;
}

.input-field:focus,
.textarea-field:focus {
  border-color: #007bff;
}

.textarea-field {
  height: 100px;
  resize: none;
}

/* Button Styles */
.button-container {
  margin-top: 20px;
}

.borrow-button {
  background-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  font-size: 1rem;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.borrow-button:hover {
  background-color: #0056b3;
}


</style>