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
                                    data-bs-target="#add">
                                    <i class="fa fa-plus"></i>
                                    Tambah Buku
                                </button>
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
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Vivamus</td>
                                            <td>Lorem ipsum dolor sit amet Donec tempor purus ideeeeeeeee </td>
                                            <td>2024</td>
                                            <td>Tersedia</td>
                                            <td>
                                                <a href="{{ route('buku.detail') }}">
                                                    <i class="fas fa-info-circle" style="color: #1572E8"></i>
                                                </a>
                                            </td>

                                            <td>
                                                <button type="button" data-bs-toggle="tooltip" title=""
                                                    class="btn btn-link btn-danger" data-original-title="Remove">
                                                    <i class="fa fa-times"></i>
                                                </button>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>consectetur</td>
                                            <td>consectetur adipiscing elit Vestibulum ante ipsum primis </td>
                                            <td>2024</td>
                                            <td>Kosong</td>
                                            <td>
                                                <a href="{{ route('buku.detail') }}">
                                                    <i class="fas fa-info-circle" style="color: #1572E8"></i>
                                                </a>
                                            </td>

                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-danger" data-original-title="Remove">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Vestibulum</td>
                                            <td>Nam efficitur dapibus lectus ac purus feugiat </td>
                                            <td>2024</td>
                                            <td>diajukan</td>
                                            <td>
                                                <a href="{{ route('buku.detail') }}">
                                                    <i class="fas fa-info-circle" style="color: #1572E8"></i>
                                                </a>
                                            </td>

                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-danger" data-original-title="Remove">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="gambar">
                        <div class="d-flex justify-content-start gap-2 form-group">
                            <div class="avatar-xxl">
                                <img src="{{ asset('kaiadmin-lite-1.0.0/assets/img/mentahan.jpg') }}" alt="..."
                                    class="avatar-img rounded">
                            </div>
                            <div class="p-1 ">
                                <div class="mt-3 mb-3">
                                    <button class="border border-primary "
                                        style="background-color: #ECF4FF; color:#1572e8; border-radius:15px; padding-bottom:5px; padding-top:5px; padding-right: 20px; padding-left:20px ">Upload</button>
                                </div>
                                <div class="" style="padding-right: ">
                                    <button class="border border-danger"
                                        style="background-color: #FFECEC; color:#e81515; border-radius:15px; padding-bottom:5px; padding-top:5px; padding-right: 25px; padding-left:25px ">Batal</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="defaultSelect">Kategori</label>
                            <select class="form-select form-control" id="defaultSelect">
                                <option>Vivamus</option>
                                <option>consectetur</option>
                                <option>Vestibulum</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="largeInput">Judul buku</label>
                            <input type="text" class="form-control form-control" id="defaultInput"
                                placeholder="Masukan Judul Buku" />
                        </div>
                        <div class="form-group">
                            <label for="largeInput">Pengarang</label>
                            <input type="text" class="form-control form-control" id="defaultInput"
                                placeholder="Masukan Pengarang" />
                        </div>
                        <div class="form-group">
                            <label for="largeInput">Penerbit</label>
                            <input type="text" class="form-control form-control" id="defaultInput"
                                placeholder="Masukan Penerbit" />
                        </div>
                        <div class=" d-flex">
                            <div class="form-group">
                                <label for="largeInput">Tahun terbit</label>
                                <input type="number" class="form-control form-control" id="defaultInput"
                                    placeholder="Masukan tahun terbit" />
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Stok</label>
                                <input type="number" class="form-control form-control" id="defaultInput"
                                    placeholder="Masukan stokt" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment">Daftar isi</label>
                            <textarea class="form-control" id="comment" rows="5">
                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" style="border-radius: 15px;">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
