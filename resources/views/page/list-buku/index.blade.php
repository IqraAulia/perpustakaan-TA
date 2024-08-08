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
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->kategori }}</td>
                                                <td>{{ $item->judul_buku }}</td>
                                                <td>{{ $item->stok }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                    <a href="#">
                                                        <i class="fas fa-info-circle" style="color: #1572E8"></i>
                                                    </a>
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

  
@endsection

@section('js')
    <script>
       
    </script>
@endsection
