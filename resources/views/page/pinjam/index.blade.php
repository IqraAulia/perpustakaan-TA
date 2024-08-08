@extends('layout.home')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Pinjam buku</h4>
                            </div>
                            <div class="h6" id="datetime"></div>
                        </div>

                        <div class="card-body">
                            <div class="modal-body">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
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
                                <form action="{{ route('pinjam.store') }}" method="POST" enctype="multipart/form-data"
                                    id="addForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Pinjam</label>
                                                <input type="date" class="form-control" name="tgl_pinjam"
                                                    value="{{ old('tgl_pinjam', $tglPinjam) }}" readonly />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Kembali</label>
                                                <input type="date" class="form-control" name="tgl_kembali"
                                                    value="{{ old('tgl_kembali', $tglKembali) }}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div id="buku-items">
                                        <div class="row buku-item">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nama Buku</label>
                                                    <select class="form-select form-control" name="buku_id[]">
                                                        <option value="">-Pilih-</option>
                                                        @foreach ($bukus as $buku)
                                                            <option value="{{ $buku->id }}">{{ $buku->judul_buku }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Jumlah</label>
                                                    <input type="number" class="form-control" name="quantity[]"
                                                        min="1" value="1" />
                                                </div>
                                            </div>
                                            <div class="col-md-2 d-flex align-items-end">
                                                <button type="button"
                                                    class="btn btn-danger remove-buku-item">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" id="add-buku-item" class="btn btn-secondary">Tambah Buku</button>
                                    <hr>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary"
                                            style="border-radius: 15px;">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('add-buku-item').addEventListener('click', function() {
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

            document.getElementById('buku-items').addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-buku-item')) {
                    e.target.closest('.buku-item').remove();
                }
            });
        });
    </script>
@endsection
