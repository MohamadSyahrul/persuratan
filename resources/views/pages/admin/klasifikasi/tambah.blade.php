@extends('layouts.master')
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
                        <li class="breadcrumb-item"><a href="index.html">Klasifikasi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Klasifikasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Klasifikasi</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <form action="{{ route('klasifikasi-surat.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Kode Klasifikasi</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name" class="form-control" name="kode_klasifikasi"
                                                    placeholder="Masukan Kode Klasifikasi">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nama Klasifikasi</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="text-id" class="form-control" name="nama_klasifikasi"
                                                    placeholder="Masukan Nama Klasifikasi">
                                            </div>
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic Horizontal form layout section end -->
</div>
@endsection
