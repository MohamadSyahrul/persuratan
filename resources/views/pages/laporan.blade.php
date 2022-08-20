@extends('layouts.master')
@push('style')
<link rel="stylesheet" href="{{asset('assets/css/pages/datatables.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/pages/fontawesome.css')}}">
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

    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
            
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>No Surat</th>
                            <th>Nama Pembuat</th>
                            <th>Nama Penerima</th>
                            <th>Tanggal Surat</th>
                            <th>Dokuemen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (Auth::user()->level == 'pimpinan')
                            @foreach ($pimpinan as $row)
                                <tr>
                                    <td>{{$row->no_surat}}</td>
                                    <td>{{$row->pembuat->nama}}</td>
                                    <td>{{$row->user->nama}}</td>
                                    <td>{{$row->tgl_surat}}</td>
                                    <td>
                                        <a href="{{route('downloadpimpinan', $row->dokumen)}}">
                                            {{$row->dokumen}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        @if (Auth::user()->level == 'kepalabiro')                            
                            @foreach ($laporan as $item)
                                <tr>
                                    <td>{{$item->no_surat}}</td>
                                    <td>{{$item->pembuat->nama}}</td>
                                    <td>{{$item->user->nama}}</td>
                                    <td>{{$item->tgl_surat}}</td>
                                    <td>
                                        <a href="{{route('downloadkepalabiro', $item->dokumen)}}">
                                            {{$item->dokumen}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <!-- Basic Tables end -->
</div>
@endsection
@push('script')
<script src="{{asset('assets/js/extensions/datatables.js')}}"></script>

@endpush
