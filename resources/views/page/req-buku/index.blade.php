@extends('layout.home')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Usulan Buku Baru</h4>

                            </div>
                            <div class="h6" id="datetime"></div>
                        </div>
                        <div class="card-body">
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
                            <form action="{{ route('req-buku.store') }}" method="POST" enctype="multipart/form-data"
                                id="addForm">
                                @csrf
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
                                        @foreach ($pengarang as $pengarang)
                                            <option value="{{ $pengarang->id }}">{{ $pengarang->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Penerbit</label>
                                    <select class="form-select form-control" name="penerbit_id">
                                        <option value="">-Pilih-</option>
                                        @foreach ($penerbit as $penerbit)
                                            <option value="{{ $penerbit->id }}">{{ $penerbit->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tahun terbit</label>
                                    <input type="number" class="form-control form-control" name="tahun_terbit"
                                        value="{{ old('tahun_terbit') }}" />
                                </div>
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
@endsection
