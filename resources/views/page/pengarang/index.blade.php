@extends('layout.home')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">List Pengarang</h4>
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
                                            <th>NO</th>
                                            <th>Nama pengarang</th>
                                            <th>tanggal lahir</th>
                                            <th>alamat</th>
                                            <th>aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengarang as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->tgl_lahir }}</td>
                                                <td>{{ $item->alamat }}</td>
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
                    <form action="{{ route('pengarang.store') }}" method="POST" enctype="multipart/form-data"
                        id="addForm">
                        @csrf
                        <div class="gambar">
                            <div class="form-group">
                                <label>Nama pengarang</label>
                                <input type="text" class="form-control form-control" name="nama" placeholder=""
                                    value="{{ old('nama') }}" />
                            </div>
                            <div class="form-group">
                                <label>Tanggal lahir</label>
                                <input type="date" class="form-control form-control" name="tgl_lahir" placeholder=""
                                    value="{{ old('tgl_lahir') }}" />
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control form-control" name="alamat" placeholder=""
                                    value="{{ old('alamat') }}" />
                            </div>
                        </div>
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
        <div class="modal-dialog modal-dialog-centered">
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
                            <label>Nama</label>
                            <input type="text" class="form-control" id="editNama" name="nama" />
                        </div>
                        <div class="form-group">
                            <label>Tanggal lahir</label>
                            <input type="date" class="form-control" id="editTgl_lahir" name="tgl_lahir" />
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" id="editAlamat" name="alamat" />
                        </div>
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
                    <p>Apakah Anda yakin ingin menghapus data ini?</p>
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
                    url: '/pengarang/' + id + '/edit',
                    method: 'GET',
                    success: function(data) {
                        modal.find('#editNama').val(data.nama);
                        modal.find('#editTgl_lahir').val(data.tgl_lahir);
                        modal.find('#editAlamat').val(data.alamat);
                        modal.find('#editForm').attr('action', '/pengarang/' + id + '/update');
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
                    url: '/pengarang/' + categoryIdToDelete,
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
