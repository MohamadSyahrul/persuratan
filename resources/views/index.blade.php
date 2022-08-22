@extends('layouts.master')


@section('content')
    <div class="page-heading">
        <h3>Dashboard Aplikasi Surat</h3>
    </div>
    <div class="page-content">
        @if (Auth::user()->level == 'user')
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Selamat Datang di Aplikasi Surat</h4>
                    </div>
                    <div class="card-body">
                        Mohon konfirmasi ke admin terlebih dahulu terkait akses untuk akunmu!
                    </div>
                </div>
            </section>
        @else
            <section class="row">
                <div class="col-12 col-lg-9">
                    <div class="row">
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon purple">
                                                <i class="bi bi-file-earmark-text-fill"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Total Surat</h6>
                                            <h6 class="font-extrabold mb-0">{{$total}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon green">
                                                <i class="bi bi-file-check-fill"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Surat disetujui</h6>
                                            <h6 class="font-extrabold mb-0">{{$setuju}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon red">
                                                <i class="bi bi-file-earmark-excel-fill"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Surat ditolak</h6>
                                            <h6 class="font-extrabold mb-0">{{$tolak}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon blue">
                                                <i class="bi bi-file-earmark-minus-fill"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Surat Pending</h6>
                                            <h6 class="font-extrabold mb-0">{{$pending}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-body py-4 px-5">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                    <img src="assets/images/faces/1.jpg" alt="Face 1">
                                </div>
                                <div class="ms-3 name">
                                    <h5 class="font-bold">{{Auth::user()->nama}}</h5>
                                    <h6 class="text-muted mb-0">{{Auth::user()->email}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistik Surat</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="bar-chart" width="500" height="150"></canvas>

                        </div>
                    </div>
                </div>
            </div>

        @endif
    </div>
    
@endsection

@push('script')
    <script src="{{asset('assets/js/pages/dashboard.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <script>
            let setuju = <?= $setuju ?>;
            let tolak = <?= $tolak ?>;
            let pending = <?= $pending ?>;
        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
            labels: ["Disetujui", "Ditolak", "Pending"],
            datasets: [
                {
                label: "Surat",
                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f"],
                data: [setuju,tolak,pending]
                }
            ]
            },
            options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'statistik surat'
            }
            }
        });
    </script>
@endpush