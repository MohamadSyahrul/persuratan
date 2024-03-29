<div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="#">
                    Aplikasi Surat
                </a>
            </div>
            <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                    role="img" class="iconify iconify--system-uicons" width="20" height="20"
                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                    <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                            opacity=".3"></path>
                        <g transform="translate(-210 -1)">
                            <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                            <circle cx="220.5" cy="11.5" r="4"></circle>
                            <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                        </g>
                    </g>
                </svg>
                <div class="form-check form-switch fs-6">
                    <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                    <label class="form-check-label"></label>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                    role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet"
                    viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                    </path>
                </svg>
            </div>
            <div class="sidebar-toggler  x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">
                <div class="avatar avatar-lm">
                    @if (Auth::user()->level == 'tu')
                    <img src="{{asset('assets/images/faces/5.jpg')}}" alt="faces">&nbsp;
                    <span style="text-transform: capitalize;">
                        {{Auth::user()->nama}}
                    </span>
                    <p>&nbsp;&nbsp;({{Auth::user()->level}})</p>
                    @endif
                    @if (Auth::user()->level == 'admin')
                    <img src="{{asset('assets/images/faces/3.jpg')}}" alt="faces">&nbsp;
                    <span style="text-transform: capitalize;">
                        {{Auth::user()->nama}}
                    </span>
                    <p>&nbsp;&nbsp;({{Auth::user()->level}})</p>
                    @endif
                    @if (Auth::user()->level == 'kepalabiro')
                    <img src="{{asset('assets/images/faces/6.jpg')}}" alt="faces">&nbsp;
                    <span style="text-transform: capitalize;">
                        {{Auth::user()->nama}}
                    </span>
                    <p>&nbsp;&nbsp;({{Auth::user()->level}})</p>
                    @endif
                    @if (Auth::user()->level == 'pimpinan')
                    <img src="{{asset('assets/images/faces/7.jpg')}}" alt="faces">&nbsp;
                    <span style="text-transform: capitalize;">
                        {{Auth::user()->nama}}
                    </span>
                    <p>&nbsp;&nbsp;({{Auth::user()->level}})</p>
                    @endif
                </div>
            </li>

            <li class="sidebar-title">Menu</li>
            <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }} ">
                <a href="{{route('dashboard')}}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            @if (Auth::user()->level == 'tu')
            <li class="sidebar-item {{ Request::is('surat-baru') ? 'active' : '' }}">
                <a href="{{url('surat-baru')}}" class='sidebar-link'>
                    <i class="bi bi-journal-bookmark-fill"></i>
                    <span>Surat Baru</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('tu/surat-keluar') ? 'active' : '' }}">
                <a href="{{route('suratKeluarTU')}}" class='sidebar-link'>
                    <i class="bi bi-file-earmark-arrow-down-fill"></i>
                    <span>Surat Keluar</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('disposisi') ? 'active' : '' }}">
                <a href="{{route('disposisi')}}" class='sidebar-link'>
                    <i class="bi bi-chat-left-dots-fill"></i>
                    <span>Disposisi</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('klasifikasi') ? 'active' : '' }}">
                <a href="{{route('klasifikasi.index')}}" class='sidebar-link'>
                    <i class="bi bi-layers-fill"></i>
                    <span>Klasifikasi Surat</span>
                </a>
            </li>
           
            @endif
            @if (Auth::user()->level == 'pimpinan')

            <li class="sidebar-item {{ Request::is('surat-masuk-pimpinan') ? 'active' : '' }}">
                <a href="{{route('suratMasukPimpinan')}}" class='sidebar-link'>
                    <i class="bi bi-collection-fill"></i>
                    <span>Surat Masuk</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('disposisi-all') ? 'active' : '' }}">
                <a href="{{route('disposisiAll')}}" class='sidebar-link'>
                    <i class="bi bi-chat-left-dots-fill"></i>
                    <span>Disposisi</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('laporan') ? 'active' : '' }}">
                <a href="{{route('laporan')}}" class='sidebar-link'>
                    <i class="bi bi-archive-fill"></i>
                    <span>Laporan</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('pimpinan/arsip-surat') ? 'active' : '' }}">
                <a href="{{route('arsipPimpinan')}}" class='sidebar-link'>
                    <i class="bi bi-file-post-fill"></i>
                    <span>Arsip Surat</span>
                </a>
            </li>
            @endif
            @if (Auth::user()->level == 'kepalabiro')
            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-file-text-fill"></i>
                    <span>Data Surat</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="{{route('menyetujuiSurat')}}">Surat Masuk</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{route('menyetujuiSuratKeluar')}}">Surat Keluar</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item {{ Request::is('disposisi') ? 'active' : '' }}">
                <a href="{{route('disposisi')}}" class='sidebar-link'>
                    <i class="bi bi-chat-left-dots-fill"></i>
                    <span>Disposisi</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('laporan-kepalabiro') ? 'active' : '' }}">
                <a href="{{route('laporankepalabiro')}}" class='sidebar-link'>
                    <i class="bi bi-archive-fill"></i>
                    <span>Laporan</span>
                </a>
            </li>
            @endif




            @if (Auth::user()->level == 'admin')
            <li class="sidebar-item {{ Request::is('suratMasukAdmin') ? 'active' : '' }}">
                <a href="{{route('inputsurat')}}" class='sidebar-link'>
                    <i class="bi bi-journal-bookmark-fill"></i>
                    <span>Input Surat</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('suratMasukAdmin') ? 'active' : '' }}">
                <a href="{{route('suratMasukAdmin')}}" class='sidebar-link'>
                    <i class="bi bi-file-arrow-up-fill"></i>
                    <span>Data Surat Masuk</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('surat-keluar') ? 'active' : '' }}">
                <a href="{{route('suratKeluarAdmin')}}" class='sidebar-link'>
                    <i class="bi bi-file-earmark-arrow-down-fill"></i>
                    <span>Data Surat Keluar</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('managemen-anggota') ? 'active' : '' }}">
                <a href="{{route('managemen-anggota.index')}}" class='sidebar-link'>
                    <i class="bi bi-person-badge-fill"></i>
                    <span>Managemen User</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('klasifikasi') ? 'active' : '' }}">
                <a href="{{route('klasifikasi.index')}}" class='sidebar-link'>
                    <i class="bi bi-layers-fill"></i>
                    <span>Klasifikasi Surat</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('arsip') ? 'active' : '' }}">
                <a href="{{route('arsipAdmin')}}" class='sidebar-link'>
                    <i class="bi bi-file-post-fill"></i>
                    <span>Arsip Surat</span>
                </a>
            </li>
            <li class="sidebar-item ">
                <a href="{{route('disposisiadmin')}}" class='sidebar-link'>
                    <i class="bi bi-chat-left-dots-fill"></i>
                    <span>Disposisi</span>
                </a>
            </li>
            <li class="sidebar-item ">
                <a href="{{route('laporansuratmasuk')}}" class='sidebar-link'>
                    <i class="bi bi-folder-symlink-fill"></i>
                    <span>Laporan Surat Masuk</span>
                </a>
            </li>
            @endif

            <li class="sidebar-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class='sidebar-link' onclick="event.preventDefault();
                        this.closest('form').submit();">
                        <i class="bi bi-door-open-fill"></i>
                        <span>Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>
</div>
