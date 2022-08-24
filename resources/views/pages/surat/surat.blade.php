@extends('layouts.master')
@push('style')
<link rel="stylesheet" href="{{asset('assets/css/pages/simple-datatables.css')}}">
@endpush
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{$pagename}}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$pagename}}</li>
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
                    <strong>Success!</strong> {{ $message }}
                </div>
                @endif
                <a href="javascript:;" class="btn icon icon-left btn-primary" data-bs-toggle="modal"
                    data-bs-target="#tambah-data"><i class="bi bi-send-plus-fill"></i>
                    Tambah Surat Keluar</a>
                {{-- modal tambah surat keluar --}}
                <div class="modal fade" id="tambah-data" tabindex="-1" role="dialog"
                    aria-labelledby="hapus-data" aria-hidden="true">
                    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                    aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('createPimpinan')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="no_surat-label">No Surat</label>
                                        <div class="form-group">
                                            <input type="text" id="no_surat-label" class="form-control"
                                            placeholder="Masukan No Surat" name="no_surat">
                                        </div>
                                        <label for="perihal-label">Perihal</label>
                                        <div class="form-group">
                                            <input type="text" id="perihal-label" class="form-control"
                                                    placeholder="Masukan Perihal dari Surat" name="perihal">
                                        </div>
                                        <label for="masukan-sifat">Sifat Surat</label>
                                        <div class="form-group">
                                            <input type="text" id="company-column" class="form-control"
                                                    name="sifat" placeholder="Masukan sifat surat">
                                        </div>
                                        <label for="masukan-sifat">Asal Surat</label>
                                        <div class="form-group">
                                            <input type="text" id="company-column" class="form-control"
                                                    name="asal_surat" placeholder="Masukan asal surat">
                                        </div>
                                        <label for="date-surat">Tanggal Surat</label>
                                        <div class="form-group">
                                            <input type="date" id="date-surat" class="form-control"
                                            name="tgl_surat">
                                        </div>
                                        <label for="country-floating">Klasifikasi Surat</label>
                                        <div class="form-group">
                                            <select class="form-select" id="klasifikasi" name="id_klasifikasi" required>
                                                <option>Pilih klasifikasi...</option>
                                                @foreach ($klasifikasi as $row)
                                                    <option value="{{$row->id}}">{{$row->nama_klasifikasi}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="dokumen">Dokumen</label>
                                        <div class="form-group">
                                            <input type="file" id="dokumen" class="form-control"
                                                    name="dokumen" placeholder="Masukan File Surat" required>
                                        </div>
                                        <label for="keterangan">Keterangan</label>
                                        <div class="form-group">
                                            <input type="text" id="keterangan" class="form-control"
                                                    name="keterangan" placeholder="Masukan Keterangan" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Close</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Kirim</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No Surat</th>
                            <th>Tanggal</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($surat as $item)
                        @if ($item->pembuat->level == 'pimpinan')
                        <tr>
                            <td>{{$item->no_surat}}</td>
                            <td>{{$item->tgl_surat}}</td>
                            <td>
                                <a href="{{route('downloadpimpinan', $item->dokumen)}}">
                                    {{$item->dokumen ?? 'dokumen'}}
                                </a>
                            </td>
                        </tr>
                        @endif
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
