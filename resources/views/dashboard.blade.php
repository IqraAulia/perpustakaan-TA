@extends('layout.home')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard {{ Auth::user()->role }}</h3>
                    <div class="h6" id="datetime"></div>
                </div>
            </div>
            @if (auth()->user()->role == 'Kaprodi' || auth()->user()->role == 'Super admin')
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <i class="fas fa-desktop"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">User</p>
                                            <h4 class="card-title">{{ $user }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="fab fa-readme"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Buku</p>
                                            <h4 class="card-title">{{ $bukusTersedia }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-success bubble-shadow-small">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Mahasiswa</p>
                                            <h4 class="card-title">{{ $mahasiswa }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                            <i class="fas fa-arrow-left"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Peminjaman</p>
                                            <h4 class="card-title">{{ $peminjaman }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <i class="fas fa-layer-group"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Kategori</p>
                                            <h4 class="card-title">{{ $kategori }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="fas fa-user-edit"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Pengarang</p>
                                            <h4 class="card-title">{{ $pengarang }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-success bubble-shadow-small">
                                            <i class="fas fa-marker"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Penerbit</p>
                                            <h4 class="card-title">{{ $penerbit }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                            <i class="fas fa-plus-square"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Usulan buku baru</p>
                                            <h4 class="card-title">{{ $bukusDiajukan }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Daftar buku yang diajukan</h4>
                                    <button class="btn btn-primary btn-round ms-auto"
                                        onclick="window.location.href='{{ route('pdf.export') }}'">
                                        <i class="fa fa-download"></i>
                                        Download PDF
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatables-diajukan"
                                        class=" datatables display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori</th>
                                                <th>Judul</th>
                                                <th>Pengarang</th>
                                                <th>penerbit</th>
                                                <th>Tahun terbit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listDiajukan as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->kategori }}</td>
                                                    <td>{{ $item->judul_buku }}</td>
                                                    <td>{{ $item->pengarang }}</td>
                                                    <td>{{ $item->penerbit }}</td>
                                                    <td>{{ $item->tahun_terbit }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (auth()->user()->role == 'Kaprodi')
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Daftar buku yang dipinjam</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatables-dipinjam"
                                            class=" datatables display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Petugas</th>
                                                    <th>Nama peminjam</th>
                                                    <th>Tanggal pinjam</th>
                                                    <th>Tanggal kembali</th>
                                                    <th>Buku Dipinjam</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listpeminjamans as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            {{ $item->created_by_name ? $item->created_by_name . ' [' . $item->created_by_role . ']' : 'Petugas belum dipilih' }}
                                                        </td>
                                                        <td>{{ $item->name }} [{{ $item->role }}]</td>
                                                        <td>{{ $item->tgl_pinjam }}</td>
                                                        <td>{{ $item->tgl_kembali }}</td>
                                                        <td>
                                                            <ul>
                                                                @foreach ($item->peminjamanDetail as $detail)
                                                                    <li>{{ $detail->buku->judul_buku }} -
                                                                        [{{ $detail->jumlah }} buah]</li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                        <td>{{ $item->status }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Riwayat peminjaman</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class=" datatables display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Petugas</th>
                                                    <th>Tanggal pinjam</th>
                                                    <th>Tanggal kembali</th>
                                                    <th>Buku Dipinjam</th>
                                                    <th>Denda</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($riwayat as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            {{ $item->created_by_name ? $item->created_by_name . ' [' . $item->created_by_role . ']' : 'Petugas belum dipilih' }}
                                                        </td>
                                                        <td>{{ $item->tgl_pinjam }}</td>
                                                        <td>{{ $item->tgl_kembali }}</td>
                                                        <td>
                                                            <ul>
                                                                @foreach ($item->peminjamanDetail as $detail)
                                                                    <li>{{ $detail->buku->judul_buku }} -
                                                                        [{{ $detail->jumlah }} buah]</li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            @if ($item->denda)
                                                                <p>Jumlah: {{ $item->denda->denda }} <br> Deskripsi:
                                                                    {{ $item->denda->deskripsi }}</li>
                                                                @else
                                                                    Tidak ada denda
                                                            @endif
                                                        </td>
                                                        <td>{{ $item->status }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">User Roles</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="userRoleChart" style="width: 50%; height: 50%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Kategori Buku</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Penerbit Buku</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="penerbitChart" style="width: 50%; height: 50%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Pengarang Buku</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="pengarangChart" style="width: 50%; height: 50%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (auth()->user()->role == 'Dosen')
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="fab fa-readme"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Buku</p>
                                            <h4 class="card-title">{{ $bukusTersedia }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                            <i class="fas fa-arrow-left"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Peminjaman</p>
                                            <h4 class="card-title">{{ $peminjamans }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <i class="fas fa-layer-group"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Kategori</p>
                                            <h4 class="card-title">{{ $kategori }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="fas fa-user-edit"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Pengarang</p>
                                            <h4 class="card-title">{{ $pengarang }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-success bubble-shadow-small">
                                            <i class="fas fa-marker"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Penerbit</p>
                                            <h4 class="card-title">{{ $penerbit }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                            <i class="fas fa-plus-square"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Usulan buku baru</p>
                                            <h4 class="card-title">{{ $bukusDiajukan }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Daftar buku yang diajukan</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class=" datatables display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori</th>
                                                <th>Judul</th>
                                                <th>Pengarang</th>
                                                <th>penerbit</th>
                                                <th>Tahun terbit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listDiajukan as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->kategori }}</td>
                                                    <td>{{ $item->judul_buku }}</td>
                                                    <td>{{ $item->pengarang }}</td>
                                                    <td>{{ $item->penerbit }}</td>
                                                    <td>{{ $item->tahun_terbit }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">User Roles</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="userRoleChart" style="width: 50%; height: 50%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Kategori Buku</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Penerbit Buku</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="penerbitChart" style="width: 50%; height: 50%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Pengarang Buku</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="pengarangChart" style="width: 50%; height: 50%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (auth()->user()->role == 'Mahasiswa')
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="fab fa-readme"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Buku</p>
                                            <h4 class="card-title">{{ $bukusTersedia }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                            <i class="fas fa-arrow-left"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Peminjaman</p>
                                            <h4 class="card-title">{{ $peminjamans }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <i class="fas fa-layer-group"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Kategori</p>
                                            <h4 class="card-title">{{ $kategori }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="fas fa-user-edit"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Pengarang</p>
                                            <h4 class="card-title">{{ $pengarang }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-success bubble-shadow-small">
                                            <i class="fas fa-marker"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Penerbit</p>
                                            <h4 class="card-title">{{ $penerbit }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">User Roles</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="userRoleChart" style="width: 50%; height: 50%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Kategori Buku</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Penerbit Buku</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="penerbitChart" style="width: 50%; height: 50%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Pengarang Buku</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="pengarangChart" style="width: 50%; height: 50%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    timer: 1000, // waktu dalam milidetik sebelum alert menghilang
                    showConfirmButton: false // tombol konfirmasi tidak ditampilkan
                });
            @endif
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($chartkategori->keys()) !!}, // Nama kategori
                datasets: [{
                    data: {!! json_encode($chartkategori->values()) !!}, // Jumlah per kategori
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('penerbitChart').getContext('2d');
        var penerbitChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($chartPenerbit->keys()) !!}, // Nama penerbit
                datasets: [{
                    data: {!! json_encode($chartPenerbit->values()) !!}, // Jumlah buku per penerbit
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>
    <script>
        var ctxPengarang = document.getElementById('pengarangChart').getContext('2d');
        var pengarangChart = new Chart(ctxPengarang, {
            type: 'pie',
            data: {
                labels: {!! json_encode($chartPengarang->keys()) !!}, // Nama pengarang
                datasets: [{
                    data: {!! json_encode($chartPengarang->values()) !!}, // Jumlah per pengarang
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('userRoleChart').getContext('2d');
        var userRoleChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($chartUserRoles->keys()) !!}, // Role names
                datasets: [{
                    data: {!! json_encode($chartUserRoles->values()) !!}, // Number of users per role
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>
@endsection
