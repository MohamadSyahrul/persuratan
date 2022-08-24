@extends('layouts.master')
@push('style')
{{-- <link rel="stylesheet" href="{{asset('assets/css/pages/datatables.css')}}"> --}}
<link rel="stylesheet" href="{{asset('assets/css/pages/fontawesome.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.dataTables.min.css">
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
                <table id="table1" class="table display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No Surat</th>
                            <th>Nama Pembuat</th>
                            <th>Tanggal Surat</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan as $item)
                        <tr>
                            <td>{{$item->no_surat}}</td>
                            <td>{{$item->pembuat->nama}}</td>
                            <td>{{$item->tgl_surat}}</td>
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
{{-- <script src="{{asset('assets/js/extensions/datatables.js')}}"></script> --}}

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>

<script>
$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#table1 thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#table1 thead');
 
    var table = $('#table1').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();
 
                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });
});

</script>
@endpush
