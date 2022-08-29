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
                            <th>Tanggal Surat</th>
                            <th>Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($SuratKeluar as $row)
                        <tr>
                            <td>{{$row->no_surat}}</td>
                            <td>{{$row->tgl_surat}}</td>
                            @if (Auth::user()->level == 'tu')
                            <td>
                                <a href="{{route('downloadDokumen', $row->dokumen)}}">
                                    {{$row->dokumen ?? 'dokumen'}}
                                </a>
                            </td>
                            @endif
                            @if (Auth::user()->level == 'pimpinan')
                            <td>
                                <a href="{{route('downloadpimpinan', $row->dokumen)}}">
                                    {{$row->dokumen ?? 'dokumen'}}
                                </a>
                            </td>
                            @endif
                            @if (Auth::user()->level == 'admin')
                            <td>
                                <a href="{{route('downloadadmin', $row->dokumen)}}">
                                    {{$row->dokumen ?? 'dokumen'}}
                                </a>
                            </td>
                            @endif



                            @if (Auth::user()->level == 'tu')
                            <td>
                                <a href="{{route('detailSurat', $row->id)}}" class="btn icon btn-primary"><i
                                        class="bi bi-files"></i></a>

                                <a href="{{route('editSurat', $row->id)}}" class="btn icon btn-warning"><i
                                        class="bi bi-pencil-square"></i></a>

                                <a href="javascript:;" class="btn icon btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#hapus-data{{$row->id}}">
                                    <i class="bi bi-trash"></i>
                                </a>
                                <div class="modal fade" id="hapus-data{{$row->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="hapus-data" aria-hidden="true">
                                    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close text-dark"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('deleteSurat', $row->id)}}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="py-3 text-center">
                                                        <i class="ni ni-bell-55 ni-3x"></i>
                                                        <h4 class="text-gradient mt-4">Apakah Kamu Akan Menghapus Surat
                                                            dengan nomor
                                                            <span class="text-danger">{{$row->no_surat}}</span>
                                                            ?
                                                        </h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                        <button type="button"
                                                            class="btn btn-white text-secondary ml-auto"
                                                            data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </td>
                            @endif
                            @if (Auth::user()->level == 'pimpinan')
                            <td>
                                @if ($row->status_dispo == 'sudah')
                                <a href="javascript:;" class="btn icon icon-left btn-primary disabled"
                                    data-bs-toggle="modal" data-bs-target="#hapus-data{{$row->id}}"><i
                                        class="bi bi-send-plus-fill"></i>
                                    Disposisi</a>
                                @else
                                <a href="javascript:;" class="btn icon icon-left btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#hapus-data{{$row->id}}"><i class="bi bi-send-plus-fill"></i>
                                    Disposisi</a>
                                @endif
                                {{-- modal disposisi --}}
                                <div class="modal fade" id="hapus-data{{$row->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="hapus-data" aria-hidden="true">
                                    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close text-dark"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('dispo')}}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <label>No Surat: </label>
                                                        <div class="form-group">
                                                            <input type="text" value="{{$row->no_surat}}"
                                                                class="form-control" disabled>
                                                            <input type="text" name="id_surat" value="{{$row->id}}"
                                                                class="form-control" hidden>
                                                        </div>
                                                        <label>Asal Pengirim: </label>
                                                        <div class="form-group">
                                                            <input type="text" value="{{$row->pembuat->nama}}"
                                                                class="form-control" disabled>
                                                        </div>
                                                        <label>Perihal: </label>
                                                        <div class="form-group">
                                                            <input type="text" value="{{$row->perihal}}"
                                                                class="form-control" disabled>
                                                        </div>
                                                        <label>Penerima Disposi</label>
                                                        <select class="form-select" id="basicSelect" name="id_user">
                                                            <option>Pilih Penerima...</option>
                                                            @foreach (App\Models\User::where(function($query) {
                                                            return $query->where('level','kepalabiro')
                                                            ->orWhere('level','tu');
                                                            })
                                                            ->get() as $item)
                                                            <option value="{{$item->id}}">{{$item->nama}}
                                                                ({{$item->level}})</option>
                                                            @endforeach
                                                        </select>
                                                        <label>Tanggal: </label>
                                                        <div class="form-group">
                                                            <input type="date" id="date-dispo" class="form-control"
                                                                name="batas_waktu">
                                                        </div>
                                                        {{-- <label>Status Disposisi: </label>
                                                        <div class="form-group">
                                                            <input type="text" name="status_disposisi" placeholder="Masukan Status Disposisi"
                                                                class="form-control">
                                                        </div> --}}
                                                        <label>Catatan: </label>
                                                        <div class="form-group">
                                                            <input type="text" name="catatan"
                                                                placeholder="Masukan Catatan" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary"
                                                            data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>
                                                        <button type="submit" class="btn btn-primary ml-1"
                                                            data-bs-dismiss="modal">
                                                            <i class="bx bx-check d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Kirim</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            @endif
                            @if (Auth::user()->level == 'admin')
                            <td>
                                Tidak ada aksi
                            </td>
                            @endif
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
