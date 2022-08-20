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
                Data {{$pagename}}
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No Surat</th>
                            <th>Nama Penerima</th>
                            <th>Tanggal Surat</th>
                            <th>Dokumen</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @if ($disposisi)
                            @foreach ($disposisi as $item)
                                <tr>
                                    <td>{{$item->surat->no_surat}}</td>
                                    <td>{{$item->namapenerima->nama}}</td>
                                    <td>{{$item->surat->tgl_surat}}</td>
                                    <td>
                                        <a href="{{route('downloadadmin', $item->surat->dokumen)}}">
                                            {{$item->surat->dokumen}}
                                        </a>
                                    </td>
                                    <td>
                                        @if ($item->surat->status_surat == 'pending')
                                        <div class="badge bg-warning">{{$item->surat->status_surat}}</div>
                                        @endif
                                        @if ($item->surat->status_surat == 'disetujui')
                                        <div class="badge bg-success">{{$item->surat->status_surat}}</div>
                                        @endif
                                        @if ($item->surat->status_surat == 'ditolak')
                                        <div class="badge bg-danger">{{$item->surat->status_surat}}</div>
                                        @endif
        
                                    </td>
                                </tr>
                            @endforeach    
                        @endif

                        @foreach ($suratmasuk as $row)
                        <tr>
                            <td>{{$row->no_surat}}</td>
                            <td>{{$row->user->nama}}</td>
                            <td>{{$row->tgl_surat}}</td>
                            <td>
                                <a href="{{route('downloadadmin', $row->dokumen)}}">
                                    {{$row->dokumen ?? 'dokumen'}}
                                </a>
                            </td>
                            <td>
                                @if ($row->status_surat == 'pending')
                                <div class="badge bg-warning">{{$row->status_surat}}</div>
                                @endif
                                @if ($row->status_surat == 'disetujui')
                                <div class="badge bg-success">{{$row->status_surat}}</div>
                                @endif
                                @if ($row->status_surat == 'ditolak')
                                <div class="badge bg-danger">{{$row->status_surat}}</div>
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
