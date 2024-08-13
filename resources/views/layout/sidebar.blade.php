<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <div class="" style="color: #ffffff">PERPUSTAKAAN</div>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                @if (auth()->user()->role == 'Super admin')
                    <li class="nav-item">
                        <a href="{{ route('home') }}">
                            <i class="fas fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kategori.index') }}">
                            <i class="fas fa-layer-group"></i>
                            <p>Kategori</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pengarang.index') }}">
                            <i class="fas fa-user-edit"></i>
                            <p>Pengarang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('penerbit.index') }}">
                            <i class="fas fa-marker"></i>
                            <p>Penerbit</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('buku.index') }}">
                            <i class="fas fa-book"></i>
                            <p>kelola Buku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}">
                            <i class="fas fa-desktop"></i>
                            <p>user</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('peminjaman.index') }}">
                            <i class="fas fa-arrow-left"></i>
                            <p>kelola peminjaman</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('riwayat.index') }}">
                            <i class="fas fa-history"></i>
                            <p>riwayat</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('list-buku.index') }}">
                            <i class="fab fa-readme"></i>
                            <p>Buku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pinjam.index') }}">
                            <i class="fas fa-book-reader"></i>
                            <p>Pinjam Buku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('req-buku.index') }}">
                            <i class="fas fa-plus-square"></i>
                            <p>Usulan Buku Baru</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->role == 'Kaprodi')
                    <li class="nav-item">
                        <a href="{{ route('home') }}">
                            <i class="fas fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->role == 'Admin')
                    <li class="nav-item">
                        <a href="{{ route('home') }}">
                            <i class="fas fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kategori.index') }}">
                            <i class="fas fa-layer-group"></i>
                            <p>Kategori</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pengarang.index') }}">
                            <i class="fas fa-user-edit"></i>
                            <p>Pengarang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('penerbit.index') }}">
                            <i class="fas fa-marker"></i>
                            <p>Penerbit</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('buku.index') }}">
                            <i class="fas fa-book"></i>
                            <p>kelola Buku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}">
                            <i class="fas fa-desktop"></i>
                            <p>user</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('peminjaman.index') }}">
                            <i class="fas fa-arrow-left"></i>
                            <p>kelola peminjaman</p>
                        </a>
                    </li>
                
                    <li class="nav-item">
                        <a href="{{ route('riwayat.index') }}">
                            <i class="fas fa-history"></i>
                            <p>riwayat</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->role == 'Petugas')
                    <li class="nav-item">
                        <a href="{{ route('home') }}">
                            <i class="fas fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kategori.index') }}">
                            <i class="fas fa-layer-group"></i>
                            <p>Kategori</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pengarang.index') }}">
                            <i class="fas fa-user-edit"></i>
                            <p>Pengarang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('penerbit.index') }}">
                            <i class="fas fa-marker"></i>
                            <p>Penerbit</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('buku.index') }}">
                            <i class="fas fa-book"></i>
                            <p>kelola Buku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('peminjaman.index') }}">
                            <i class="fas fa-arrow-left"></i>
                            <p>kelola peminjaman</p>
                        </a>
                    </li>
                
                    <li class="nav-item">
                        <a href="{{ route('riwayat.index') }}">
                            <i class="fas fa-history"></i>
                            <p>riwayat</p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->role == 'Mahasiswa')
                    <li class="nav-item">
                        <a href="{{ route('home') }}">
                            <i class="fas fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('list-buku.index') }}">
                            <i class="fab fa-readme"></i>
                            <p>Buku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pinjam.index') }}">
                            <i class="fas fa-book-reader"></i>
                            <p>Pinjam Buku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('riwayat.index') }}">
                            <i class="fas fa-history"></i>
                            <p>riwayat</p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->role == 'Dosen')
                    <li class="nav-item">
                        <a href="{{ route('home') }}">
                            <i class="fas fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('list-buku.index') }}">
                            <i class="fab fa-readme"></i>
                            <p>Buku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pinjam.index') }}">
                            <i class="fas fa-book-reader"></i>
                            <p>Pinjam Buku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('req-buku.index') }}">
                            <i class="fas fa-plus-square"></i>
                            <p>Usulan Buku Baru</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('riwayat.index') }}">
                            <i class="fas fa-history"></i>
                            <p>riwayat</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
