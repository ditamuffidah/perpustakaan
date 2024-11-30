<template>
    <header>
        <div class="header-content">
          <!-- Logo Image -->
          <img src="@/assets/smk2.png" alt="Profile Image" class="logo-img" />
          <!-- Text Container -->
          <div class="text-container">
            <h4 class="logo-top">PERPUSTAKAAN</h4>
            <div class="logo-bottom">SMK NEGERI 2 SUMEDANG</div>
          </div>
        </div>
    </header>
</template>

<script>
    export default {
    name: 'Header',
    };
</script>

<style scoped>
    header {
  position: fixed;
  top: 0;
  left: 250px;
  right: 0;
  background: linear-gradient(135deg, #000000, #000103, #0E3286);
  color: white;
  padding: 20px;
  height: 120px;
  z-index: 999;
  display: flex;
  align-items: center;
}

/*Tata letak untuk header*/
.header-content {
  display: flex;
  align-items: center;
}

/*ukuran gambar untuk logo SMK*/
.logo-img {
  width: 100px; /* Adjusted size */
  height: 100px; /* Adjusted size */
  object-fit: contain;
}

/*center untuk tampilan header perpus + hello username*/
.text-container {
  position: relative;
  text-align: center;
  margin-left: 110px; /* Geser kontainer secara keseluruhan */
}

/*teks untuk tampilan perpustakaan*/
.logo-top {
  font-size: 35px;
  font-weight: bold;
  margin: 0;
  position: relative; /* Posisi relatif untuk kontrol lebih lanjut */
}

/* bold teks smk */
.logo-bottom {
  font-size: 35px;
  font-weight: bold;
}
</style>