<aside>
    <!-- Content Sidebar -->
    <div class="sidebar">
        <div class="greeting flex items-center">
            <img src="{{ asset('storage/images/icon2.png') }}" alt="User Icon" class="icon-large" />
            <div class="ml-3 text-container">
                <p class="text-xl">Hello!</p>
                <span class="username block border-b border-gray-400 pb-1">Username</span>
            </div>
        </div>
        <ul class="menu">
            <div class="space-y-4">
                <!-- Home Icon with Text -->
                <li class="menu-item">
                    <a href="{{ url('/') }}" class="flex items-center gap-2">
                        <img src="{{ asset('storage/images/Icon.png') }}" alt="Home Icon" class="icon" />
                        <span class="text-sm font-medium">Home</span>
                    </a>
                </li>

                <!-- Katalog Icon with Text -->
                <li class="menu-item">
                    <a href="{{ url('/catalog') }}" class="flex items-center gap-2">
                        <img src="{{ asset('storage/images/Icon1.png') }}" alt="Katalog Icon" class="icon" />
                        <span class="text-sm font-medium">Katalog</span>
                    </a>
                </li>

                <!-- Status Icon with Text -->
                <li class="menu-item">
                    <a href="{{ url('/status') }}" class="flex items-center gap-2">
                        <img src="{{ asset('storage/images/status.png') }}" alt="Status Icon" class="icon-large" />
                        <span class="text-sm font-medium">Status</span>
                    </a>
                </li>

                <!-- Peminjaman Icon with Text -->
                <li class="menu-item">
                    <a href="{{ url('/peminjaman') }}" class="flex items-center gap-2">
                        <img src="{{ asset('storage/images/peminjaman.png') }}" alt="Peminjaman Icon" class="icon-large" />
                        <span class="text-sm font-medium">Peminjaman</span>
                    </a>
                </li>

                <!-- Pengembalian Icon with Text -->
                <li class="menu-item">
                    <a href="{{ url('/pengembalian') }}" class="flex items-center gap-2">
                        <img src="{{ asset('storage/images/pengembalian.png') }}" alt="Pengembalian Icon" class="icon-large" />
                        <span class="text-sm font-medium">Pengembalian</span>
                    </a>
                </li>

                <!-- E-Book Icon with Text -->
                <li class="menu-item">
                    <a href="{{ url('/ebooks') }}" class="flex items-center gap-2">
                        <img src="{{ asset('storage/images/E-Book.png') }}" alt="E-Book Icon" class="icon-large" />
                        <span class="text-sm font-medium">E-Book</span>
                    </a>
                </li>

                <!-- Setting Icon with Text -->
                <li class="menu-item">
                    <a href="{{ url('/setting') }}" class="flex items-center gap-2">
                        <img src="{{ asset('storage/images/Setting.png') }}" alt="Setting Icon" class="icon-large" />
                        <span class="text-sm font-medium">Setting</span>
                    </a>
                </li>
            </div>
        </ul>
    </div>
</aside>

<style>
    /* Styles are copied as-is from your Vue file */
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

    .icon, .icon-large {
        width: 24px; 
        height: 24px; 
    }

    .icon-large {
        width: 32px; 
        height: 32px; 
    }

    .icon:hover {
        background-color: #1a1a1a;
    }

    .icon:active {
        background-color: #333333;
    }

    .icon:focus {
        background-color: #444444;
        outline: none;
    }

    .menu-item img {
        display: inline-block;
        vertical-align: middle;
        margin-left: 5%;
    }

    .menu-item span {
        display: inline-block;
        vertical-align: middle;
    }

    .menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .menu-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 10px 0;
        padding: 7px;
        border-radius: 9px; 
        transition: background-color 0.3s; 
    }

    .menu-item:hover {
        background-color: #1061F7;
    }

    .menu-item:active {
        background-color: #1061F7;
    }

    .username {
        font-size: 19px;
        padding-bottom: 10px;
        margin-top: -2px;
        border-bottom: 2px solid white;
        width: 176%;
        position: relative;
        left: -25%;
        text-align: center;
    }

    .menu {
        margin-top: 20px;
    }

    .greeting {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        width: 176%;
        margin-left: -108%;
    }

    .greeting img {
        width: 40px;
        height: 40px;
        margin-top: -26px;
        margin-right: -10px;
    }

    .username::after {
        content: "";
        display: block;
        margin-top: 15px;
    }
</style>
