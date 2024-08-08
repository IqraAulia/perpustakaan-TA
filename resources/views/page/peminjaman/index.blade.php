@extends('layout.home')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">List Peminjaman</h4>
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
                                            <th>Nama Petugas</th>
                                            <th>Sebagai</th>
                                            <th>Nama peminjaman</th>
                                            <th>role</th>
                                            <th>Tanggal pinjam</th>
                                            <th>tanggal kembali</th>
                                            <th>detail</th>
                                            <th>aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($peminjaman as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->role}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->role}}</td>
                                                <td>{{$item->tgl_pinjam}}</td>
                                                <td>{{$item->tgl_kembali}}</td>
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

    {{-- modal --}}
    <div class="modal fade @if ($errors->any()) show @endif" id="addModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true"
        @if ($errors->any()) style="display:block;" @endif>
        <div class="modal-dialog modal-lg modal-dialog-centered">
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
                    <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data" id="addForm">
                        @csrf
                        <div class="form-group">
                            <label>Nama Petugas</label>
                            <select class="form-select form-control" name="created_by">
                                <option value="">-Pilih-</option>
                                @foreach ($petugas as $petuga)
                                <option value="{{ $petuga->id }}">{{ $petuga->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Peminjam</label>
                            <select class="form-select form-control" name="user_id">
                                <option value="">-Pilih-</option>
                                @foreach ($peminjam as $pinjam)
                                <option value="{{ $pinjam->id }}">{{ $pinjam->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">    
                                    <label>Tanggal Pinjam</label>
                                    <input type="date" class="form-control" name="tgl_pinjam" value="{{ old('tgl_pinjam', $tglPinjam) }}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">    
                                    <label>Tanggal Kembali</label>
                                    <input type="date" class="form-control" name="tgl_kembali" value="{{ old('tgl_kembali', $tglKembali) }}" />
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div id="buku-items">
                            <div class="row buku-item">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Buku</label>
                                        <select class="form-select form-control" name="buku_id[]">
                                            <option value="">-Pilih-</option>
                                            @foreach ($bukus as $buku)
                                            <option value="{{ $buku->id }}">{{ $buku->judul_buku }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="number" class="form-control" name="quantity[]" min="1" value="1" />
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-buku-item">Hapus</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add-buku-item" class="btn btn-secondary">Tambah Buku</button>
                        <hr>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" style="border-radius: 15px;">Tambah</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="POST">
                        <div class="form-group">
                            <label>Nama Petugas</label>
                            <select class="form-select form-control" name="created_by" id="editCreated">
                                <option value="">-Pilih-</option>
                                @foreach ($petugas as $petuga)
                                <option value="{{ $petuga->id }}">{{ $petuga->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Peminjam</label>
                            <select class="form-select form-control" name="user_id" id="editUser">
                                <option value="">-Pilih-</option>
                                @foreach ($peminjam as $pinjam)
                                <option value="{{ $pinjam->id }}">{{ $pinjam->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">    
                                    <label>Tanggal Pinjam</label>
                                    <input type="date" class="form-control" name="tgl_pinjam" value="{{ old('tgl_pinjam', $tglPinjam) }}"  id="editTgl_pinjam"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">    
                                    <label>Tanggal Kembali</label>
                                    <input type="date" class="form-control" name="tgl_kembali" value="{{ old('tgl_kembali', $tglKembali) }}" id="editTgl_kembali" />
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div id="buku-items">
                            <div class="row buku-item">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Buku</label>
                                        <select class="form-select form-control" name="buku_id[]" id="editBuku">
                                            <option value="">-Pilih-</option>
                                            @foreach ($bukus as $buku)
                                            <option value="{{ $buku->id }}">{{ $buku->judul_buku }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="number" class="form-control" name="quantity[]" min="1" value="1" />
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-buku-item">Hapus</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add-buku-item" class="btn btn-secondary">Tambah Buku</button>
                        <hr>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" style="border-radius: 15px;">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal confirm delete --}}
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
                    url: '/peminjaman/' + id + '/edit',
                    method: 'GET',
                    success: function(data) {
                        modal.find('#editCreated').val(data.created_by);
                        modal.find('#editUser').val(data.user_id);
                        modal.find('#editTgl_pinjam').val(data.tgl_pinjam);
                        modal.find('#editTgl_kembali').val(data.tgl_kembali);
                        modal.find('#editBuku').val(data.quantity[]);
                        modal.find('#editForm').attr('action', '/peminjaman/' + id + '/update');
                    }
                });
            });

            // Delete functionality
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            var categoryIdToDelete;

            $('.btn-delete').click(function() {
                categoryIdToDelete = $(this).data('id');
                deleteModal.show();
            });

            $('#confirmDelete').click(function() {
                $.ajax({
                    url: '/peminjaman/' + categoryIdToDelete,
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

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('add-buku-item').addEventListener('click', function () {
                let bukuItemsContainer = document.getElementById('buku-items');
                let newItem = document.createElement('div');
                newItem.classList.add('row', 'buku-item');
                newItem.innerHTML = `
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Buku</label>
                            <select class="form-select form-control" name="buku_id[]">
                                <option value="">-Pilih-</option>
                                @foreach ($bukus as $buku)
                                <option value="{{ $buku->id }}">{{ $buku->judul_buku }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" class="form-control" name="quantity[]" min="1" value="1" />
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-buku-item">Hapus</button>
                    </div>
                `;
                bukuItemsContainer.appendChild(newItem);
            });

            document.getElementById('buku-items').addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-buku-item')) {
                    e.target.closest('.buku-item').remove();
                }
            });
        });
    </script>
@endsection
