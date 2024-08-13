@extends('layout.home')
@section('content')
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
                                                    <a href="#">
                                                        <i class="fas fa-info-circle" style="color: #1572E8"></i>
                                                    </a>
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
                    <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data" id="addForm">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Example file input</label><br>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="gambar_buku"
                                value="{{ old('gambar_buku') }}" />
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
                        modal.find('#editPengarang').val(data.penerbit_id);
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
    </script>
@endsection
