@extends('layouts.master')
@push('style')
<link rel="stylesheet" href="{{asset('assets/css/pages/fontawesome.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">
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
                <table cellspacing="5" cellpadding="5" border="0">
                    @if (Auth::user()->level == 'pimpinan')
                    <form action="{{route('laporan')}}" method="GET">
                    @endif
                    @if (Auth::user()->level == 'kepalabiro')
                    <form action="{{route('laporankepalabiro')}}" method="GET">
                    @endif
                        {{-- @csrf --}}
                        <div class="row g-3 ">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="start_date" id="surat" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="end_date" id="surat" required></div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select class="form-control" id="statu" name="status">
                                        <option>Pilih..</option>
                                        <option value="masuk">Masuk</option>
                                        <option value="keluar">Keluar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" class="btn bg-primary text-white">Filter</button>
                                </div>
                            </div>
                        <div>
                    </form>
                </table>
                <table id="example" class="table display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No Surat</th>
                            <th>Nama Pembuat</th>
                            <th>Tanggal Surat</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>

<script>
    var minDate, maxDate;

    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = minDate.val();
            var max = maxDate.val();
            var date = new Date(data[4]);

            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        }
    );

    $(document).ready(function () {
        // Create date inputs
        minDate = new DateTime($('#min'), {
            format: 'YYYY-MM-DD'
        });
        maxDate = new DateTime($('#max'), {
            format: 'YYYY-MM-DD'
        });

        // DataTables initialisation
        var table = $('#example').DataTable();

        // Refilter the table
        $('#min, #max').on('change', function () {
            table.draw();
        });
    });

</script>
@endpush
