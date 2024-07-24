@extends('layout.home')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Detail Buku</h4>
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Add Row
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
                                                <i class="fas fa-info-circle" style="color: #1572E8"></i>
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
                                            <td><i class="fas fa-info-circle" style="color: #1572E8"></i></td>

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
                                            <td><i class="fas fa-info-circle" style="color: #1572E8"></i></td>

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
@endsection
