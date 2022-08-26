@extends('layouts.master')
@push('style')
    
@endpush

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                @if (Auth::user()->level == 'admin')
                <h3>Surat Masuk</h3>
                @else
                <h3>Surat Keluar</h3>
                @endif
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Pages</a></li>
                        @if (Auth::user()->level == 'admin')
                        <li class="breadcrumb-item active" aria-current="page">Surat Masuk</li>
                        @else
                        <li class="breadcrumb-item active" aria-current="page">Surat Keluar</li>
                        @endif
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    @if (Auth::user()->level == 'admin')
                    <h4 class="card-title">Buat Surat Masuk</h4>
                    @else
                    <h4 class="card-title">Buat Surat Keluar</h4>
                    @endif
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                                <form action="{{ route('createBaru') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="no_surat-label">No Surat</label>
                                                <input type="text" id="no_surat-label" class="form-control"
                                                    placeholder="Masukan No Surat" name="no_surat">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="perihal-label">Perihal</label>
                                                <input type="text" id="perihal-label" class="form-control"
                                                    placeholder="Masukan Perihal dari Surat" name="perihal">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="masukan-sifat">Sifat Surat</label>
                                                <input type="text" id="company-column" class="form-control"
                                                    name="sifat" placeholder="Masukan sifat surat">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="masukan-sifat">Asal Surat</label>
                                                <input type="text" id="company-column" class="form-control"
                                                    name="asal_surat" placeholder="Masukan asal surat">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="date-surat">Tanggal Surat</label>
                                                <input type="date" id="date-surat" class="form-control"
                                                    name="tgl_surat">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="country-floating">Klasifikasi Surat</label>
                                                    <select class="form-select" id="klasifikasi" name="id_klasifikasi" required>
                                                        <option>Pilih klasifikasi...</option>
                                                        @foreach ($klasifikasi as $row)
                                                            <option value="{{$row->id}}">{{$row->nama_klasifikasi}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="dokumen">Dokumen</label>
                                                <input type="file" id="dokumen" class="form-control"
                                                    name="dokumen" placeholder="Masukan File Surat" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <input type="text" id="keterangan" class="form-control"
                                                    name="keterangan" placeholder="Masukan Keterangan" required>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Kirim</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
