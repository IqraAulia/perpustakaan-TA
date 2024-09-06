@extends('layout.home')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h4 class="card-title">List Riwayat</h4>
                          
                        </div>
                        <div class="h6" id="datetime"></div>
                      </div>
                    <div class="card-body">
                        <div class="table-responsive"> 
                            <table id="basic-datatables" class=" datatables display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peminjam</th>
                                        <th>Tanggal pinjam</th>
                                        <th>Tanggal kembali</th>
                                        <th>Buku Dipinjam</th>
                                        <th>Denda</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjamans as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
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
