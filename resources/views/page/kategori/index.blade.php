@extends('layout.home')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h4 class="card-title">List Kategori</h4>
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
                                        <th>NO</th>
                                        <th>Nama Kategori</th>
                                        <th>Status Kategori</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Vivamus</td>
                                        <td>aktif</td>
                                            <td>
                                                <div class="form-button-action">
                                                  <button
                                                    type="button"
                                                    data-bs-toggle="tooltip"
                                                    title=""
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Task"
                                                  >
                                                    <i class="fa fa-edit"></i>
                                                  </button>
                                                  <button
                                                    type="button"
                                                    data-bs-toggle="tooltip"
                                                    title=""
                                                    class="btn btn-link btn-danger"
                                                    data-original-title="Remove"
                                                  >
                                                    <i class="fa fa-times"></i>
                                                  </button>
                                                </div>
                                              </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>consectetur</td>
                                        <td>tidak aktif</td>
                                            <td>
                                                <div class="form-button-action">
                                                  <button
                                                    type="button"
                                                    data-bs-toggle="tooltip"
                                                    title=""
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Task"
                                                  >
                                                    <i class="fa fa-edit"></i>
                                                  </button>
                                                  <button
                                                    type="button"
                                                    data-bs-toggle="tooltip"
                                                    title=""
                                                    class="btn btn-link btn-danger"
                                                    data-original-title="Remove"
                                                  >
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
