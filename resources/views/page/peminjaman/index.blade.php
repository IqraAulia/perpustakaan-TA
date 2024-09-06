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
                                            <th>Nama peminjaman</th>
                                            <th>Tanggal pinjam</th>
                                            <th>Tanggal kembali</th>
                                            <th>Buku Dipinjam</th>
                                            <th>Denda</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($peminjamans as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    {{ $item->created_by_name ? $item->created_by_name . ' [' . $item->created_by_role . ']' : 'Petugas belum dipilih' }}
                                                </td>
                                                <td>{{$item->name}} [{{$item->role}}]</td>
                                                <td>{{$item->tgl_pinjam}}</td>
                                                <td>{{$item->tgl_kembali}}</td>
                                                <td>
                                                    <ul style="padding-left: 0; list-style: none;">
                                                        @foreach($item->peminjamanDetail as $detail)
                                                            <li style="margin-bottom: 8px;">
                                                                <strong>{{ $detail->buku->judul_buku }}</strong> <br>
                                                                <span style="font-size: 90%; color: #555;">Kondisi buku: {{ $detail->buku_kode ?? '-' }}</span> <br>
                                                                <span style="font-size: 90%; color: #555;">Jumlah: {{ $detail->jumlah }} buah</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    @if ($item->denda)
                                                        <p>Jumlah: {{ $item->denda->denda }} <br> Deskripsi: {{ $item->denda->deskripsi }}</li>
                                                    @else
                                                        Tidak ada denda
                                                    @endif
                                                </td>
                                                <td>{{$item->status}}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        @if ($item->status == 'booking')
                                                            <!-- Tombol untuk proses booking -->
                                                            <button type="button" data-id="{{ $item->id }}"
                                                                class="btn btn-link btn-success btn-approve"
                                                                data-original-title="Approve" data-bs-toggle="modal"
                                                                data-bs-target="#approveModal" data-peminjaman="{{ json_encode($item->peminjamanDetail) }}">
                                                                <i class="fa fa-check"></i> Approve
                                                            </button>

                                                            <button type="button" data-id="{{ $item->id }}"
                                                                class="btn btn-link btn-warning btn-reject"
                                                                data-original-title="Reject">
                                                                <i class="fa fa-times"></i> Reject
                                                            </button>
                                                        @elseif ($item->status == 'dipinjam')
                                                            <!-- Tombol untuk menyelesaikan peminjaman -->
                                                            <button type="button" data-id="{{ $item->id }}"
                                                                class="btn btn-link btn-info btn-complete"
                                                                data-original-title="Complete">
                                                                <i class="fa fa-check-circle"></i> Complete
                                                            </button>
                                                        @elseif ($item->status == 'ditolak')
                                                            <!-- Tombol untuk menghapus jika ditolak -->
                                                            <button type="button" data-id="{{ $item->id }}"
                                                                class="btn btn-link btn-danger btn-delete"
                                                                data-original-title="Remove">
                                                                <i class="fa fa-times"></i> Delete
                                                            </button>
                                                        @elseif ($item->status == 'selesai')
                                                            {{-- <!-- Tidak ada tombol untuk status selesai -->
                                                            <button type="button" class="btn btn-link btn-secondary">
                                                                <i class="fa fa-check"></i> Completed
                                                            </button> --}}
                                                        @endif
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
                                    <option value="{{ $petuga->id }}" 
                                        {{ auth()->user()->id == $petuga->id ? 'selected' : '' }}>
                                        {{ $petuga->name }}
                                    </option>
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

    {{-- modal complete delete --}}
    <div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="completeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="completeModalLabel">Complete Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="completeForm">
                        <div class="mb-3">
                            <label for="fine_amount" class="form-label">Denda (Opsional)</label>
                            <input type="number" class="form-control" id="fine_amount" name="fine_amount" placeholder="Masukkan jumlah denda">
                        </div>
                        <div class="mb-3">
                            <label for="fine_description" class="form-label">Catatan</label>
                            <textarea class="form-control" id="fine_description" name="fine_description" rows="3" placeholder="Masukkan Catatan"></textarea>
                        </div>
                        <input type="hidden" id="peminjaman_id" name="peminjaman_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitComplete">Complete</button>
                </div>
            </div>
        </div>
    
    </div>

    {{-- modal approve --}}
    <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel">Approve Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="approveForm" method="POST">
                        @csrf
                        <div id="bookList"></div>
                        <input type="hidden" name="peminjaman_id" id="peminjaman_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmApprove">Approve</button>
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
                        // modal.find('#editBuku').val(data.quantity[]);
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

        $(document).ready(function() {
            // Approve action with confirmation
            $('.btn-approve').on('click', function() {
                var peminjamanId = $(this).data('id');
                var peminjamanDetail = $(this).data('peminjaman');
                $('#peminjaman_id').val(peminjamanId);

                var bookListHtml = '';
                peminjamanDetail.forEach(function(detail) {
                    bookListHtml += `
                        <div class="mb-3">
                            <label>${detail.buku.judul_buku} - ${detail.jumlah} buah</label>
                            <input type="text" name="buku_kode[]" class="form-control" placeholder="Masukan kondisi buku" required>
                            <input type="hidden" name="peminjaman_detail_id[]" value="${detail.id}">
                        </div>`;
                });

                $('#approveForm').attr('action', `/peminjaman/${peminjamanId}/approve`);
                $('#bookList').html(bookListHtml);
            });

            $('#confirmApprove').on('click', function() {
                // Submit the form via AJAX
                var form = $('#approveForm');
                var url = form.attr('action');
                
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        // Close the modal
                        $('#approveModal').modal('hide');

                        // Show success message
                        Swal.fire('Approved!', 'Peminjaman has been approved.', 'success').then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        // Handle error
                        Swal.fire('Error!', 'Something went wrong. Please try again.', 'error');
                    }
                });
            });

            // Reject action with confirmation
            $('.btn-reject').click(function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to reject this peminjaman?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, reject it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/peminjaman/' + id + '/reject',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                Swal.fire('Rejected!', 'Peminjaman has been rejected.', 'success').then(() => {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            });

            // Complete action with confirmation and form
            $('.btn-complete').click(function() {
                let id = $(this).data('id');
                $('#peminjaman_id').val(id);
                $('#completeModal').modal('show');
            });

            $('#submitComplete').click(function() {
                let id = $('#peminjaman_id').val();
                $.ajax({
                    url: '/peminjaman/' + id + '/complete',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        denda: $('#fine_amount').val(),
                        deskripsi: $('#fine_description').val()
                    },
                    success: function(response) {
                        Swal.fire('Completed!', 'Peminjaman has been marked as complete.', 'success').then(() => {
                            location.reload();
                        });
                    }
                });
            });

            // Delete action with confirmation
            $('.btn-delete').click(function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to delete this peminjaman?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/peminjaman/' + id + '/destroy',
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                Swal.fire('Deleted!', 'Peminjaman has been deleted.', 'success').then(() => {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            });
        });

    </script>
@endsection
