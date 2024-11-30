@extends('fe.layouts.app')

@section('content')
<div id="app">
    <!-- Main Content -->
    <div class="main-content">
        <!-- Search and Buttons Section -->
        <div class="search-notification-wrapper">
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search..." />
                <span class="search-icon">
                    <img src="{{ asset('assets/search.png') }}" alt="Search Icon" width="50" height="50" />
                </span>
            </div>
            <div>
                <!-- Button Warning -->
                <button class="warning-button" onclick="location.href='{{ route('warning') }}'">
                    <span class="button-icon">
                        <img src="https://static.vecteezy.com/system/resources/previews/009/663/941/non_2x/warning-icon-transparent-free-png.png" alt="Warning Icon" width="50" height="50" />
                    </span>
                    <span class="button-text">Warning</span>
                </button>
            </div>
            <button class="notification-button" onclick="location.href='{{ route('notifikasi') }}'">
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
                    @foreach ($bestSellers as $index => $book)
                        <div class="text-center">
                            <div class="book-container" onclick="location.href='{{ route('peminjaman') }}'">
                                <img src="{{ asset('assets/pinbintang.png') }}" alt="icon" class="icon-top-left" />
                                <div class="icon-number">{{ $index + 1 }}</div>
                                <img src="{{ asset($book['image']) }}" class="book-image" alt="book image" />
                                <div class="book-info">
                                    <p class="book-title">Judul Buku</p>
                                    <p class="book-author">Penulis</p>
                                    <p class="book-genre">Kategori</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Rekomendasi Section -->
            <div>
                <h2 class="text-3xl font-bold">REKOMENDASI</h2>
                <div class="category-container">
                    @foreach ($categories as $category)
                        <div class="category-button" onclick="location.href='{{ route('catalog', ['category' => $category]) }}'">
                            {{ $category }}
                        </div>
                    @endforeach
                </div>
                <div class="grid">
                    @foreach ($recommendations as $book)
                        <div class="text-center">
                            <div class="book-container" onclick="location.href='{{ route('peminjaman') }}'">
                                <img src="{{ asset($book['image']) }}" class="book-image" alt="book image" />
                                <p class="mt-3 font-bold">{{ $book['title'] }}</p>
                                <div class="book-info">
                                    <p class="book-title">Judul Buku</p>
                                    <p class="book-author">Penulis</p>
                                    <p class="book-genre">Kategori</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div>
        <h2 class="video">DOKUMENTASI VIDEO</h2>
    </div>
    <div class="video-container">
        <!-- Menampilkan video YouTube -->
        @foreach ($videos as $video)
            <iframe src="{{ $video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        @endforeach
    </div>
</div>
@endsection
