@extends('layouts.master')

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
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Buat Surat Baru</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <h6>Klasifikasi</h6>
                            <fieldset class="form-group">
                                <select class="form-select" id="basicSelect">
                                    <option>IT</option>
                                    <option>Blade Runner</option>
                                    <option>Thor Ragnarok</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-12 mb-4">
                            <h6>Penerima</h6>
                            <fieldset class="form-group">
                                <select class="form-select" id="basicSelect">
                                    <option>IT</option>
                                    <option>Blade Runner</option>
                                    <option>Thor Ragnarok</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-12 mb-4">
                            <h6>Tanggal Surat</h6>
                            <div class="form-group">
                                <input type="date" id="roundText" class="form-control round"
                                    placeholder="Rounded Input">
                            </div>
                        </div>
                        <div class="buttons">
                        <button type="subbmit" class="btn btn-primary rounded-pill">Save</button>
                        <button type="reset" class="btn btn-secondary  rounded-pill">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection
