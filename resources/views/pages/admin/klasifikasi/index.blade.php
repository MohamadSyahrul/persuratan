@extends('layouts.master')
@push('style')
<link rel="stylesheet" href="{{asset('assets/css/pages/simple-datatables.css')}}">
@endpush
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Klasifikasi Surat</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Klasifikasi Surat</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i>
                    <strong>Success!</strong> {{ $message }}
                </div>
                @endif
                @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    <i class="bi bi-file-excel"></i>
                    <strong>Success!</strong> {{ $message }}
                </div>
                @endif
                <a href="#" class="btn icon btn-primary" data-bs-toggle="modal" data-bs-target="#tambahsurat">Tambah
                </a>
                <!--tambah form Modal -->
                <div class="modal fade text-left" id="tambahsurat" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Form Tambah Anggota</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form action="{{ route('klasifikasi.store') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="col-md-4">
                                        <label>Kode Klasifikasi</label>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input type="text" id="first-name" class="form-control" name="kode_klasifikasi"
                                            placeholder="Masukan Kode Klasifikasi">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Nama Klasifikasi</label>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input type="text" id="text-id" class="form-control" name="nama_klasifikasi" required
                                            placeholder="Masukan Nama Klasifikasi">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                    <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Simpan</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Kode Klasifikasi</th>
                            <th>Nama Klasifikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($klasifikasi as $row)
                        <tr>
                            <td>{{$row->kode_klasifikasi}}</td>
                            <td>{{$row->nama_klasifikasi}}</td>

                            <td>
                                <a href="#" class="btn icon btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#edit{{$row->id}}"><i class="bi bi-pencil-square"></i></a>

                                <!--Edit form Modal -->
                                <div class="modal fade text-left" id="edit{{$row->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel33" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel33">Update Klasifikasi </h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('klasifikasi.update',$row->id)}}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body">
                                                    <div class="col-md-4">
                                                        <label>Kode Klasifikasi</label>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <input type="text" id="first-name" class="form-control"
                                                            name="kode_klasifikasi"
                                                            placeholder="Masukan Kode Klasifikasi"
                                                            value="{{$row->kode_klasifikasi}}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Nama Klasifikasi</label>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <input type="text" id="text-id" class="form-control"
                                                            name="nama_klasifikasi" required
                                                            placeholder="Masukan Nama Klasifikasi"
                                                            value="{{$row->nama_klasifikasi}}">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Close</span>
                                                    </button>
                                                    <button type="submit" class="btn btn-primary ml-1"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Update</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <a href="javascript:;" class="btn icon btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#hapus-data{{$row->id}}">
                                    <i class="bi bi-trash"></i>
                                </a>
                                <div class="modal fade" id="hapus-data{{$row->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="hapus-data" aria-hidden="true">
                                    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="modal-title-notification">Hapus Data
                                                    Klasifikasi</h6>
                                                <button type="button" class="btn-close text-dark"
                                                    data-bs-dismiss="modal" aria-label="Close">

                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('klasifikasi.destroy', $row->id)}}"
                                                    method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="py-3 text-center">
                                                        <i class="ni ni-bell-55 ni-3x"></i>
                                                        <h4 class="text-gradient text-primary mt-4">Apakah Kamu Akan
                                                            Menghapus Data Kalsifikasi
                                                            ?
                                                        </h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                        <button type="button"
                                                            class="btn btn-white text-secondary ml-auto"
                                                            data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection
@push('script')
<script src="{{asset('assets/js/extensions/simple-datatables.js')}}"></script>
@endpush
