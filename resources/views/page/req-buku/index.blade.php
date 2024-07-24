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
                          <button
                            class="btn btn-primary btn-round ms-auto"
                            data-bs-toggle="modal"
                            data-bs-target="#addRowModal"
                          >
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
                                        <th>Nama</th>
                                        <th>Role</th>
                                        <th>Jumlah Buku</th>
                                        <th>detail</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Alexus Morem</td>
                                        <td>Mahasiswa</td>
                                        <td>5</td>
                                        <td><i class="fas fa-info-circle" style="color: #1572E8"></i></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Alexus Morem</td>
                                        <td>Dosen</td>
                                        <td>6</td>
                                        <td><i class="fas fa-info-circle" style="color: #1572E8"></i></td>
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
