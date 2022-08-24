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
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Dokumen</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($surat as $row)
                            <tr>
                                <td>{{$row->no_surat}}</td>
                                <td>{{$row->tgl_surat}}</td>
                                <td>
                                    <a href="{{route('downloadkepalabiro', $row->dokumen)}}">
                                        {{$row->dokumen ?? 'dokumen'}}
                                    </a>
                                </td>
                                <td>
                                    @if ($row->status_surat == 'pending')
                                        <div class="badge bg-warning">diproses</div>
                                    @endif
                                    @if ($row->status_surat == 'disetujui')
                                    <div class="badge bg-success">{{$row->status_surat}}</div>
                                    @endif
                                    @if ($row->status_surat == 'ditolak')
                                    <div class="badge bg-danger">diarsipkan</div>
                                    @endif

                                </td>
                                <td>
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                        id="dropdownMenuButtonEmoji" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="bi bi-file-check-fill"></i>Pilih
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonEmoji">
                                        <a class="dropdown-item" href="setujui/{{$row->id}}"><i class="bi bi-file-earmark-check-fill"></i>
                                            Setujui
                                        </a>
                                        <a class="dropdown-item" href="proses/{{$row->id}}"><i class="bi bi-file-earmark-minus-fill"></i>
                                            Proses
                                        </a>
                                        <a class="dropdown-item" href="arsipkan/{{$row->id}}"><i class="bi bi-file-earmark-excel-fill"></i>
                                            Arsipkan
                                        </a>
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
