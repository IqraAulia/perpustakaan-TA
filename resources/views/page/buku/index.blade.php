@extends('layout.home')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Kelola Buku</h4>
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#addModal">
                                    <i class="fa fa-plus"></i>
                                    Add
                                </button>
                            </div>
                            <div class="h6" id="datetime"></div>
                            <div>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class=" datatables display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Judul</th>
                                            <th>Stok</th>
                                            <th>Status</th>
                                            <th>Detail</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bukus as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->kategori }}</td>
                                                <td>{{ $item->judul_buku }}</td>
                                                <td>{{ $item->stok }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#detailModal" data-id="{{ $item->id }}">
                                                        <i class="fas fa-info-circle" style="color: #1572E8"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-id="{{ $item->id }}"
                                                            data-bs-toggle="modal" data-bs-target="#editModal"
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" data-id="{{ $item->id }}"
                                                            class="btn btn-link btn-danger btn-delete"
                                                            data-original-title="Remove">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Detail Buku -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 rounded-lg shadow-sm">
                <div class="modal-header" style="background-color: #2A2F5B; color: white;">
                    <h1 class="modal-title fs-5" id="modalTitle">Loading...</h1>
                    <button type="button" class="btn-close btn-close-light" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Image Section -->
                    <div class="row mb-4">
                        <div class="col-12 text-center">
                            <div id="imageContainer" class="d-flex justify-content-center align-items-center">
                                <img id="modalImage" src="" alt="Book Image" class="img-fluid rounded border"
                                    style="max-height: 300px; object-fit: contain;">
                                <i id="noImageIcon" class="far fa-image text-muted"
                                    style="font-size: 100px; display: none;"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Details Section -->
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Kategori</th>
                                    <td id="kategori">Loading content...</td>
                                </tr>
                                <tr>
                                    <th>Pengarang</th>
                                    <td id="pengarang">Loading content...</td>
                                </tr>
                                <tr>
                                    <th>Penerbit</th>
                                    <td id="penerbit">Loading content...</td>
                                </tr>
                                <tr>
                                    <th>Tahun Terbit</th>
                                    <td id="tahunterbit">Loading content...</td>
                                </tr>
                                <tr>
                                    <th>Stok</th>
                                    <td id="stok">Loading content...</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td id="status">Loading content...</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- Daftar Isi Section -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Daftar Isi</h5>
                            <div id="daftarisi" style="max-height: 300px; overflow-y: auto; white-space: pre-wrap;">
                                Loading content...
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Modal --}}
    <div class="modal fade @if ($errors->any()) show @endif" id="addModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true"
        @if ($errors->any()) style="display:block;" @endif>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data"
                        id="addForm">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Example file input</label><br>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                name="gambar_buku" value="{{ old('gambar_buku') }}" />
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-select form-control" name="kategori_id">
                                <option value="">-Pilih-</option>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Judul buku</label>
                            <input type="text" class="form-control form-control" name="judul_buku"
                                value="{{ old('judul_buku') }}" />
                        </div>
                        <div class="form-group">
                            <label>Pengarang</label>
                            <select class="form-select form-control" name="pengarang_id">
                                <option value="">-Pilih-</option>
                                @foreach ($pengarang as $png)
                                    <option value="{{ $png->id }}">{{ $png->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Penerbit</label>
                            <select class="form-select form-control" name="penerbit_id">
                                <option value="">-Pilih-</option>
                                @foreach ($penerbit as $pnb)
                                    <option value="{{ $pnb->id }}">{{ $pnb->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" d-flex">
                            <div class="form-group">
                                <label>Tahun terbit</label>
                                <input type="number" class="form-control form-control" name="tahun_terbit"
                                    value="{{ old('tahun_terbit') }}" />
                            </div>
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" class="form-control form-control" name="stok"
                                    value="{{ old('stok') }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-select form-control" name="status">
                                <option value="">-Pilih-</option>
                                <option value="Tersedia"{{ old('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia
                                </option>
                                <option value="Kosong"{{ old('status') == 'Kosong' ? 'selected' : '' }}>Kosong</option>
                                <option value="Diajukan" {{ old('status') == 'Diajukan' ? 'selected' : '' }}>Diajukan
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="comment">Daftar isi</label>
                            <textarea class="form-control" id="comment" rows="5" name="daftar_isi" value="{{ old('daftar_isi') }}"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" style="border-radius: 15px;">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Silahkan masukan gambar buku</label>
                            <br>
                            <input type="file" class="form-control-file" id="editGambar" name="gambar_buku"
                                value="{{ old('gambar_buku') }}" />
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-select form-control" name="kategori_id" id="editKategori">
                                <option value="">-Pilih-</option>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Judul buku</label>
                            <input type="text" class="form-control form-control" id="editJudul" name="judul_buku"
                                value="{{ old('judul_buku') }}" />
                        </div>
                        <div class="form-group">
                            <label>Pengarang</label>
                            <select class="form-select form-control" name="pengarang_id" id="editPengarang">
                                <option value="">-Pilih-</option>
                                @foreach ($pengarang as $png)
                                    <option value="{{ $png->id }}">{{ $png->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Penerbit</label>
                            <select class="form-select form-control" name="penerbit_id" id="editPenerbit">
                                <option value="">-Pilih-</option>
                                @foreach ($penerbit as $pnb)
                                    <option value="{{ $pnb->id }}">{{ $pnb->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" d-flex">
                            <div class="form-group">
                                <label>Tahun terbit</label>
                                <input type="number" class="form-control form-control" id="editTahunTerbit"
                                    name="tahun_terbit" value="{{ old('tahun_terbit') }}" />
                            </div>
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" class="form-control form-control" id="editStok" name="stok"
                                    value="{{ old('stok') }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-select form-control" name="status" id="editStatus">
                                <option value="">-Pilih-</option>
                                <option value="Tersedia"{{ old('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia
                                </option>
                                <option value="Kosong"{{ old('status') == 'Kosong' ? 'selected' : '' }}>Kosong</option>
                                <option value="Diajukan" {{ old('status') == 'Diajukan' ? 'selected' : '' }}>Diajukan
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="comment">Daftar isi</label>
                            <textarea class="form-control" id="editDaftarIsi" rows="5" name="daftar_isi"
                                value="{{ old('daftar_isi') }}"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" style="border-radius: 15px;">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- modal hapus --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Konfirmasi Hapus</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus kategori ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                var addModal = new bootstrap.Modal(document.getElementById('addModal'), {});
                addModal.show();
            @endif

            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var id = button.data('id'); // Extract info from data-* attributes
                var modal = $(this);

                $.ajax({
                    url: '/buku/' + id + '/edit',
                    method: 'GET',
                    success: function(data) {
                        console.log(data.kategori_id);
                        modal.find('#editKategori').val(data.kategori_id);
                        modal.find('#editJudul').val(data.judul_buku);
                        modal.find('#editPengarang').val(data.pengarang_id);
                        modal.find('#editPenerbit').val(data.penerbit_id);
                        modal.find('#editTahunTerbit').val(data.tahun_terbit);
                        modal.find('#editStok').val(data.stok);
                        modal.find('#editStatus').val(data.status);
                        modal.find('#editDaftarIsi').val(data.daftar_isi);
                        modal.find('#editForm').attr('action', '/buku/' + id + '/update');
                    }
                });
            });

            // Delete functionality
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            var bukuIdToDelete;

            $('.btn-delete').click(function() {
                bukuIdToDelete = $(this).data('id');
                deleteModal.show();
            });

            $('#confirmDelete').click(function() {
                $.ajax({
                    url: '/buku/' + bukuIdToDelete,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseJSON.message);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('.detail-btn').on('click', function(e) {
                e.preventDefault();

                // Ambil ID buku dari atribut data-id
                var bookId = $(this).data('id');

                // Kirim permintaan AJAX untuk mengambil detail buku
                $.ajax({
                    url: '/buku/' + bookId + '/detail', // URL untuk mendapatkan data detail buku
                    type: 'GET',
                    success: function(response) {
                        // Tampilkan data yang didapatkan ke dalam modal
                        $('#book-details').html(response);

                        // Tampilkan modal
                        $('#detailModal').modal('show');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#detailModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var id = button.data('id'); // Extract info from data-* attributes
                var modal = $(this);

                $.ajax({
                    url: '/buku/' + id + '/detail', // Your route to fetch the book details
                    type: 'GET',
                    success: function(data) {
                        modal.find('.modal-title').text(data.judul_buku);
                        modal.find('#kategori').text(data.kategori);
                        modal.find('#pengarang').text(data.pengarang);
                        modal.find('#penerbit').text(data.penerbit);
                        modal.find('#tahunterbit').text(data.tahun_terbit);
                        modal.find('#stok').text(data.stok);
                        modal.find('#status').text(data.status);
                        modal.find('#daftarisi').text(data.daftar_isi);

                        if (data.gambar_buku) {
                            modal.find('#modalImage').attr('src', "{{ asset('storage') }}/" +
                                data.gambar_buku).show();
                            modal.find('#noImageIcon').hide();
                        } else {
                            modal.find('#modalImage').hide();
                            modal.find('#noImageIcon').show();
                        }
                    },
                    error: function() {
                        modal.find('.modal-title').text('Error');
                        modal.find(
                            '#kategori, #pengarang, #penerbit, #tahunterbit, #stok, #status, #daftarisi'
                        ).text('Failed to load data.');
                        modal.find('#modalImage').hide();
                        modal.find('#noImageIcon').show();
                    }
                });
            });
        });
    </script>
@endsection
