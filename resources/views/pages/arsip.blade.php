@extends('layouts.master')
@push('style')
<link rel="stylesheet" href="{{asset('assets/css/pages/simple-datatables.css')}}">
@endpush
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Arsip Surat</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Managemen Anggota</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">

                <!--tambah form Modal -->
                <div class="modal fade text-left" id="tambahAnggota" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Form Tambah Anggota</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form action="{{ route('managemen-anggota.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">

                                    <label for="nik">NIK</label>
                                    <div class="form-group">
                                    <input class="form-control" required aria-required="true" id="nik" name="nik"
                                        type="number">
                                    </div>
                                    <label for="nama">Nama</label>
                                    <div class="form-group">
                                    <input class="form-control" required aria-required="true" id="nama" name="nama"
                                        type="text">
                                    </div>
                                    <label for="username">Username</label>
                                    <div class="form-group">
                                    <input class="form-control" required aria-required="true" id="username" name="username"
                                        type="text">
                                    </div>
                                    <label for="email">Email</label>
                                    <div class="form-group">
                                    <input class="form-control" required aria-required="true" id="email" name="email"
                                        type="text">
                                    </div>
                                    <label for="country-floating">Level User</label>         
                                    <select class="form-select" id="basicSelect" name="level">
                                        <option>Pilih level...</option>
                                            <option value="admin">Admin</option>
                                            <option value="tu">TU</option>
                                            <option value="pimpinan">Pimpinan</option>
                                            <option value="kepalabiro">Kepala Biro</option>

                                    </select>
                                    <label for="foto">Foto</label>
                                    <div class="form-group">
                                    <input type="file" id="input-file-now" name="foto" class="form-control"
                                        data-default-file="" accept="image/*" />
                                    </div>
                                    <label for="ttd">Tanda Tangan</label>
                                    <div class="form-group">
                                    <input type="file" id="input-file-now" name="ttd" class="form-control"
                                        data-default-file="" accept="image/*" />
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
                            <th>No Surat</th>
                            <th>Nama Pembuat</th>
                            <th>Tanggal Surat</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arsip as $row)
                        <tr>
                            <td>{{$row->no_surat}}</td>
                            <td>{{$row->pembuat->nama}}</td>
                            <td>{{$row->tgl_surat}}</td>
                            <td>
                                    @if (Auth::user()->level == 'pimpinan')
                                    <a href="{{route('downloadpimpinan', $row->dokumen)}}">
                                        {{$row->dokumen}}
                                    </a>
                                    @endif
                                    @if (Auth::user()->level == 'admin')
                                    <a href="{{route('downloadadmin', $row->dokumen)}}">
                                        {{$row->dokumen}}
                                    </a>
                                    @endif
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
