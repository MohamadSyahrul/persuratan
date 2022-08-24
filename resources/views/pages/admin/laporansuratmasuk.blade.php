@extends('layouts.master')
@push('style')
<link rel="stylesheet" href="{{asset('assets/css/pages/simple-datatables.css')}}">
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
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No Surat</th>
                            <th>Asal Surat</th>
                            <th>Perihal</th>
                            <th>Tanggal Surat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan as $item)
                        <tr>
                            <td>{{$item->no_surat}}</td>
                            <td>{{$item->tgl_surat}}</td>
                            <td>{{$item->asal_surat}}</td>
                            <td>{{$item->perihal}}</td>
                            <td>
                                @if (Auth::user()->level == 'kepalabiro')
                                    <a href="{{route('downloadkepalabiro', $item->dokumen)}}">
                                        {{$item->dokumen}}
                                    </a>                                    
                                @endif
                                @if (Auth::user()->level == 'pimpinan')
                                    <a href="{{route('downloadpimpinan', $item->dokumen)}}">
                                        {{$item->dokumen}}
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
    <!-- Basic Tables end -->
</div>
@endsection

@push('script')
<script src="{{asset('assets/js/extensions/simple-datatables.js')}}"></script>
@endpush
