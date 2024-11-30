<template>
    <aside>
        <!-- Content Sidebar -->
        <div class="sidebar">
            <div class="greeting flex items-center">
                <img src="@/assets/icon2.png" alt="User Icon" class="icon-large" />
                <div class="ml-3 text-container">
                    <p class="text-xl">Hello!</p>
                    <span class="username block border-b border-gray-400 pb-1">Username</span>
                </div>
            </div>
            <ul class="menu">
                <div class="space-y-4">
                    <!-- Home Icon with Text -->
                    <li class="menu-item">
                      <router-link to="/siswa" class="flex items-center gap-2">
                        <img src="@/assets/Icon.png" alt="Home Icon" class="icon" />
                        <span class="text-sm font-medium">Home</span>
                      </router-link>
                    </li>

                    <!-- Katalog Icon with Text -->
                    <li class="menu-item">
                      <router-link to="/siswa/catalog" class="flex items-center gap-2">
                        <img src="@/assets/Icon1.png" alt="Katalog Icon" class="icon" />
                        <span class="text-sm font-medium">Katalog</span>
                      </router-link>
                    </li>

                    <!-- Status Icon with Text -->
                    <li class="menu-item">
                      <router-link to="/siswa/status" class="flex items-center gap-2">
                        <img src="@/assets/status.png" alt="Status Icon" class="icon-large" />
                        <span class="text-sm font-medium">Status</span>
                      </router-link>
                    </li>

                    <!-- Peminjaman Icon with Text -->
                    <li class="menu-item">
                      <router-link to="/siswa/riwayat" class="flex items-center gap-2">
                        <img src="@/assets/peminjaman.png" alt="Peminjaman Icon" class="icon-large" />
                        <span class="text-sm font-medium">Riwayat</span>
                      </router-link>
                    </li>


                    <!-- E-Book Icon with Text -->
                    <li class="menu-item">
                      <router-link to="/siswa/ebooks" class="flex items-center gap-2">
                        <img src="@/assets/E-Book.png" alt="E-Book Icon" class="icon-large" />
                        <span class="text-sm font-medium">E-Book</span>
                      </router-link>
                    </li>

                    <!-- Setting Icon with Text -->
                    <li class="menu-item">
                      <router-link to="/siswa/setting" class="flex items-center gap-2">
                        <img src="@/assets/Setting.png" alt="Setting Icon" class="icon-large" />
                        <span class="text-sm font-medium">Setting</span>
                      </router-link>
                    </li>
                </div>
            </ul>
        </div>
    </aside>
</template>

<script>
    export default {
    name: 'Sidebar',
    };
</script>

<style scoped>
/*Margin icon menu sidebar*/
.sidebar {
  background: linear-gradient(135deg, #000000, #000103, #0E3286);
  color: white;
  padding: 20px;
  height: 100vh;
  width: 250px;
  position: fixed;
  left: 0;
  top: 0;
  z-index: 1000;
  overflow-y: auto;
}

/* Ukuran Icon Sidebar */
.icon, .icon-large {
  width: 24px; 
  height: 24px; 
}

.icon-large {
  width: 32px; 
  height: 32px; 
}

/* Efek saat menghover, mengklik, atau fokus pada icon */
.icon:hover {
  background-color: #1a1a1a; /* Warna ketika dihover */
}

.icon:active {
  background-color: #333333; /* Warna ketika diklik */
}

.icon:focus {
  background-color: #444444; /* Warna ketika fokus */
  outline: none; /* Menghilangkan outline bawaan browser */
}

/* margin sidebar kiri-kanan */
.menu-item img {
  display: inline-block;
  vertical-align: middle;
  margin-left: 5%;
}

/* Icon Sidebar bawah */
.menu-item span {
  display: inline-block;
  vertical-align: middle;
}

/*Menu icon sidebar*/
.menu {
  list-style: none;
  padding: 0;
  margin: 0;
}

/*Menu item sidebar*/
.menu-item {
  display: flex;
  align-items: center;
  gap: 10px;
  margin: 10px 0;
  padding: 7px;
  border-radius: 9px; 
  transition: background-color 0.3s; 
}

/* Efek ketika menu item dihover */
.menu-item:hover {
  background-color: #1061F7; /* Warna ketika menu item dihover */
}

.menu-item:active {
  background-color: #1061F7; /* Warna ketika menu item diklik */
}

/* Sidebar Username */
.username {
    font-size: 19px; /* Ukuran teks untuk "Username" */
    padding-bottom: 10px; /* Jarak dengan border bawah */
    margin-top: -2px; /* Naikkan sedikit teks */
    border-bottom: 2px solid white; /* Border bawah */
    width: 176%; /* Perlebar garis bawah dengan memperluas lebar elemen */
    position: relative; /* Mengatur posisi relatif untuk menggeser elemen */
    left: -25%; /* Menggeser elemen ke kiri untuk memperpanjang garis */
    text-align: center; /* Teks tetap di tengah */
  }

  /* Jarak antara hello username dengan menu sidebar */
.menu {
  margin-top: 20px;
}

/* Teks username */
.greeting {
  margin-top: 20px; /* Sesuaikan margin-top agar "Hello" naik */
  display: flex;
  justify-content: flex-end; /* Menggeser "Hello" ke kanan */
  align-items: center;
  width: 176%; /* Sesuaikan lebar agar sejajar dengan username */
  margin-left: -108%;
}

/* Icon teks username */
.greeting img {
  width: 40px;
  height: 40px;
  margin-top: -26px;
  margin-right: -10px;
}

/* Jarak hello dan username */
.username::after {
  content: "";
  display: block;
  margin-top: 15px;
}

</style>