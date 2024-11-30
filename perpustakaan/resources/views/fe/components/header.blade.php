<header>
    <div class="header-content">
        <!-- Logo Image -->
        <img src="{{ asset('storage/images/smk2.png') }}" alt="Profile Image" class="logo-img" />
        <!-- Text Container -->
        <div class="text-container">
            <h4 class="logo-top">PERPUSTAKAAN</h4>
            <div class="logo-bottom">SMK NEGERI 2 SUMEDANG</div>
        </div>
    </div>
</header>

<style>
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

    .header-content {
        display: flex;
        align-items: center;
    }

    .logo-img {
        width: 100px; /* Adjusted size */
        height: 100px; /* Adjusted size */
        object-fit: contain;
    }

    .text-container {
        position: relative;
        text-align: center;
        margin-left: 110px; /* Geser kontainer secara keseluruhan */
    }

    .logo-top {
        font-size: 35px;
        font-weight: bold;
        margin: 0;
        position: relative; /* Posisi relatif untuk kontrol lebih lanjut */
    }

    .logo-bottom {
        font-size: 35px;
        font-weight: bold;
    }
</style>
