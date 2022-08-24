@extends('layouts.master')
@push('style')
    
@endpush

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Surat Baru</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Surat Baru</li>
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
                        <h4 class="card-title">Edit Surat Baru</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                                <form action="{{ route('updateSurat', $row->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="no_surat-label">Nomor Surat</label>
                                                <input type="text" id="no_surat-label" class="form-control" value="{{$row->no_surat}}"
                                                    placeholder="Masukan No Surat" name="no_surat">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="perihal-label">Perihal</label>
                                                <input type="text" id="perihal-label" class="form-control" value="{{$row->perihal}}"
                                                    placeholder="Masukan Perihal dari Surat" name="perihal">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="masukan-sifat">Sifat Surat</label>
                                                <input type="text" id="company-column" class="form-control" value="{{$row->sifat}}"
                                                    name="sifat" placeholder="Masukan sifat surat">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="masukan-sifat">Asal Surat</label>
                                                <input type="text" id="company-column" class="form-control"
                                                    name="asal_surat" value="{{$row->asal_surat}}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="date-surat">Tanggal Surat</label>
                                                <input type="date" id="date-surat" class="form-control" value="{{$row->tgl_surat}}"
                                                    name="tgl_surat">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="dokumen">Dokumen</label>
                                                <input type="file" id="dokumen" class="form-control" value="{{$row->dokumen}}"
                                                    name="dokumen" placeholder="file" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <input type="text" id="keterangan" class="form-control"
                                                    name="keterangan" value="{{$row->keterangan}}" required>
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
