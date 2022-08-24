@extends('layouts.master')
@push('style')
<link rel="stylesheet" href="{{asset('assets/css/pages/simple-datatables.css')}}">
@endpush
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Managemen User</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Managemen User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn icon btn-primary" data-bs-toggle="modal" data-bs-target="#tambahAnggota">Tambah
                    User</a>

                <!--tambah form Modal -->
                <div class="modal fade text-left" id="tambahAnggota" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Form Tambah User</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form action="{{ route('managemen-anggota.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">

                                    <label for="nik">NIK</label>
                                    <div class="form-group">
                                    <input class="form-control" required aria-required="true" id="nik" name="nik"
                                        type="number">
                                    </div>
                                    <label for="nama">Nama</label>
                                    <div class="form-group">
                                    <input class="form-control" required aria-required="true" id="nama" name="nama"
                                        type="text">
                                    </div>
                                    <label for="username">Username</label>
                                    <div class="form-group">
                                    <input class="form-control" required aria-required="true" id="username" name="username"
                                        type="text">
                                    </div>
                                    <label for="email">Email</label>
                                    <div class="form-group">
                                    <input class="form-control" required aria-required="true" id="email" name="email"
                                        type="text">
                                    </div>
                                    <label for="country-floating">Level User</label>         
                                    <select class="form-select" id="basicSelect" name="level">
                                        <option>Pilih level...</option>
                                            <option value="admin">Admin</option>
                                            <option value="tu">TU</option>
                                            <option value="pimpinan">Pimpinan</option>
                                            <option value="kepalabiro">Kepala Biro</option>

                                    </select>
                                    <label for="foto">Foto</label>
                                    <div class="form-group">
                                    <input type="file" id="input-file-now" name="foto" class="form-control"
                                        data-default-file="" accept="image/*" />
                                    </div>
                                    <label for="ttd">Tanda Tangan</label>
                                    <div class="form-group">
                                    <input type="file" id="input-file-now" name="ttd" class="form-control"
                                        data-default-file="" accept="image/*" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                    <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Simpan</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nik</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Email</th>
                            <th>TTD</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usr as $item)
                            <tr>
                                <td>
                                    @if ($item->foto)
                                    <div class="avatar avatar-xl">
                                        <img src="{{asset('img/profil/'.$item->foto)}}" alt="">
                                    </div>  
                                    @else
                                    no image                                        
                                    @endif
                                </td>
                                <td>{{$item->nik}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->username}}</td>
                                <td>{{$item->level}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    @if ($item->ttd)
                                    <div class="avatar avatar-xl">
                                        <img src="{{asset('img/profil/'.$item->ttd)}}" alt="">
                                    </div>  
                                    @else
                                    no image                                        
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn icon btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editAnggota{{$item->id}}"><i class="bi bi-pencil-square"></i></a>

                                    <!--Edit form Modal -->
                                    <div class="modal fade text-left" id="editAnggota{{$item->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel33" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel33">Login Form </h4>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <form action="{{ route('managemen-anggota.update',$item->id)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <label for="nik">NIK</label>
                                                        <div class="form-group">
                                                        <input class="form-control" required aria-required="true" value="{{ $item->nik }}" id="nik" name="nik"
                                                            type="number">
                                                        </div>
                                                        <label for="nama">Nama</label>
                                                        <div class="form-group">
                                                        <input class="form-control" required aria-required="true" value="{{ $item->nama }}" id="nama" name="nama"
                                                            type="text">
                                                        </div>
                                                        <label for="username">Username</label>
                                                        <div class="form-group">
                                                        <input class="form-control" required aria-required="true" value="{{ $item->username }}" id="username" name="username"
                                                            type="text">
                                                        </div>
                                                        <label for="email">Email</label>
                                                        <div class="form-group">
                                                        <input class="form-control" required aria-required="true" value="{{ $item->email }}" id="email" name="email"
                                                            type="text">
                                                        </div>
                                                        <label for="country-floating">Level User</label>         
                                                        <select class="form-select" id="basicSelect" name="level">
                                                            <option value="{{$item->level}}">Level saat ini : {{$item->level}}</option>
                                                                <option value="admin">Admin</option>
                                                                <option value="tu">TU</option>
                                                                <option value="pimpinan">Pimpinan</option>
                                                                <option value="kepalabiro">Kepala Biro</option>
                    
                                                        </select>
                                                        <label for="foto">Foto</label>
                                                        <div class="form-group">
                                                        <input type="file" id="input-file-now" name="foto" class="form-control"
                                                            data-default-file="" accept="image/*" />
                                                        </div>
                                                        <label for="ttd">Tanda Tangan</label>
                                                        <div class="form-group">
                                                        <input type="file" id="input-file-now" name="ttd" class="form-control"
                                                            data-default-file="" accept="image/*" />
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
                                                            <span class="d-none d-sm-block">Update</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="javascript:;" class="btn icon btn-danger" data-bs-toggle="modal" data-bs-target="#hapus-data{{$item->id}}">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <div class="modal fade" id="hapus-data{{$item->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="hapus-data" aria-hidden="true">
                                        <div class="modal-dialog modal-danger modal-dialog-centered modal-"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-notification">Hapus Data
                                                        User</h6>
                                                    <button type="button" class="btn-close text-dark"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('managemen-anggota.destroy', $item->id)}}"
                                                        method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="py-3 text-center">
                                                            <i class="ni ni-bell-55 ni-3x"></i>
                                                            <h4 class="text-gradient text-primary mt-4">Apakah Kamu Akan Menghapus Data User {{$item->nama}}
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
