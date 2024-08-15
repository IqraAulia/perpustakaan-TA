@extends('layout.home')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">List Buku</h4>
                            </div>
                            <div class="h6" id="datetime"></div>
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
@endsection

@section('js')
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
