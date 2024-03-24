<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">PTDI</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">PTDI</a>
      </div>

      <ul class="sidebar-menu">
        @role('admin-corporate')
          <li class="menu-header">Dashboard Admin Corporate</li>
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
              <a href="{{route('dashboard')}}" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Dashboard</span></a>
            </li>
          
          {{-- <li class="menu-header">Manajemen User</li>
            <li class="nav-item dropdown 
              {{ request()->is('super-admin/adminJurusan*') ? 'active' : ''}} ||
              {{ request()->is('super-admin/bagianAkademik*') ? 'active' : ''}} ||">
    
              <a class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="far fa-user"></i> 
                <span>Manajemen User</span>
              </a>
              <ul class="dropdown-menu">
                <li class="{{ request()->is('super-admin/bagianAkademik*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('bagianAkademik.index')}}">
                    Bagian Akademik
                  </a>
                </li>
                <li class="{{ request()->is('super-admin/adminJurusan*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('adminJurusan.index')}}">
                    Admin Jurusan
                  </a>
                </li>
              </ul>
            </li>
          <li class="menu-header">Pengajuan</li>
            <li class="nav-item dropdown
            {{ request()->is('menu-admin/pengajuan-aktif-kuliah*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-izin-penelitian*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-verifikasi-ijazah*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-legalisir*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-dispensasi*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-pengantar-pkl*') ? 'active' : ''}}">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Pengajuan</span></a>
              <ul class="dropdown-menu">
                <li class="{{ request()->is('menu-admin/pengajuan-aktif-kuliah*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-aktif-kuliah.index')}}">
                    Surat Aktif Kuliah
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-pengantar-pkl*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-pengantar-pkl.index')}}">
                    Pengantar PKL
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-izin-penelitian*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-izin-penelitian.index')}}">
                    Izin Penelitian
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-dispensasi*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-dispensasi.index')}}">
                    Surat Dispensasi
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-legalisir*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-legalisir.index')}}">
                    Legalisir
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-verifikasi-ijazah*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-verifikasi-ijazah.index')}}">
                    Verifikasi Ijazah
                  </a>
                </li>
              </ul>
            </li>
          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div> --}}
        @endrole

        @role('admin-it')
          <li class="menu-header">Dashboard Admin IT</li>
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
              <a href="{{route('dashboard')}}" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Dashboard</span></a>
            </li>
          
          <li class="menu-header">Manajemen User</li>
            <li class="nav-item dropdown 
              {{ request()->is('admin-it/user*') ? 'active' : ''}} ||">
    
              <a class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="far fa-user"></i> 
                <span>Manajemen User</span>
              </a>
              <ul class="dropdown-menu">
                <li class="{{ request()->is('admin-it/user*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('user.index')}}">
                    Pengguna
                  </a>
                </li>
                <li class="{{ request()->is('admin-it/karyawan*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('karyawan.index')}}">
                    Karyawan
                  </a>
                </li>
              </ul>
            </li>
            
          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div>
        @endrole

        @role('manager')
          <li class="menu-header">Dashboard Manager</li>
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
              <a href="{{route('dashboard')}}" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Dashboard</span></a>
            </li>
          
          {{-- <li class="menu-header">Manajemen User</li>
            <li class="nav-item dropdown 
              {{ request()->is('super-admin/adminJurusan*') ? 'active' : ''}} ||
              {{ request()->is('super-admin/bagianAkademik*') ? 'active' : ''}} ||">
    
              <a class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="far fa-user"></i> 
                <span>Manajemen User</span>
              </a>
              <ul class="dropdown-menu">
                <li class="{{ request()->is('super-admin/bagianAkademik*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('bagianAkademik.index')}}">
                    Bagian Akademik
                  </a>
                </li>
                <li class="{{ request()->is('super-admin/adminJurusan*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('adminJurusan.index')}}">
                    Admin Jurusan
                  </a>
                </li>
              </ul>
            </li>
          <li class="menu-header">Pengajuan</li>
            <li class="nav-item dropdown
            {{ request()->is('menu-admin/pengajuan-aktif-kuliah*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-izin-penelitian*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-verifikasi-ijazah*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-legalisir*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-dispensasi*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-pengantar-pkl*') ? 'active' : ''}}">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Pengajuan</span></a>
              <ul class="dropdown-menu">
                <li class="{{ request()->is('menu-admin/pengajuan-aktif-kuliah*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-aktif-kuliah.index')}}">
                    Surat Aktif Kuliah
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-pengantar-pkl*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-pengantar-pkl.index')}}">
                    Pengantar PKL
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-izin-penelitian*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-izin-penelitian.index')}}">
                    Izin Penelitian
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-dispensasi*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-dispensasi.index')}}">
                    Surat Dispensasi
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-legalisir*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-legalisir.index')}}">
                    Legalisir
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-verifikasi-ijazah*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-verifikasi-ijazah.index')}}">
                    Verifikasi Ijazah
                  </a>
                </li>
              </ul>
            </li>
          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div> --}}
        @endrole

        @role('karyawan-senior')
          <li class="menu-header">Dashboard Karyawan Senior</li>
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
              <a href="{{route('dashboard')}}" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Dashboard</span></a>
            </li>
          
          {{-- <li class="menu-header">Manajemen User</li>
            <li class="nav-item dropdown 
              {{ request()->is('super-admin/adminJurusan*') ? 'active' : ''}} ||
              {{ request()->is('super-admin/bagianAkademik*') ? 'active' : ''}} ||">
    
              <a class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="far fa-user"></i> 
                <span>Manajemen User</span>
              </a>
              <ul class="dropdown-menu">
                <li class="{{ request()->is('super-admin/bagianAkademik*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('bagianAkademik.index')}}">
                    Bagian Akademik
                  </a>
                </li>
                <li class="{{ request()->is('super-admin/adminJurusan*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('adminJurusan.index')}}">
                    Admin Jurusan
                  </a>
                </li>
              </ul>
            </li>
          <li class="menu-header">Pengajuan</li>
            <li class="nav-item dropdown
            {{ request()->is('menu-admin/pengajuan-aktif-kuliah*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-izin-penelitian*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-verifikasi-ijazah*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-legalisir*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-dispensasi*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-pengantar-pkl*') ? 'active' : ''}}">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Pengajuan</span></a>
              <ul class="dropdown-menu">
                <li class="{{ request()->is('menu-admin/pengajuan-aktif-kuliah*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-aktif-kuliah.index')}}">
                    Surat Aktif Kuliah
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-pengantar-pkl*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-pengantar-pkl.index')}}">
                    Pengantar PKL
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-izin-penelitian*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-izin-penelitian.index')}}">
                    Izin Penelitian
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-dispensasi*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-dispensasi.index')}}">
                    Surat Dispensasi
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-legalisir*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-legalisir.index')}}">
                    Legalisir
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-verifikasi-ijazah*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-verifikasi-ijazah.index')}}">
                    Verifikasi Ijazah
                  </a>
                </li>
              </ul>
            </li>
          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div> --}}
        @endrole

        @role('karyawan-junior')
          <li class="menu-header">Dashboard Karyawan Junior</li>
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
              <a href="{{route('dashboard')}}" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Dashboard</span></a>
            </li>
          
          {{-- <li class="menu-header">Manajemen User</li>
            <li class="nav-item dropdown 
              {{ request()->is('super-admin/adminJurusan*') ? 'active' : ''}} ||
              {{ request()->is('super-admin/bagianAkademik*') ? 'active' : ''}} ||">
    
              <a class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="far fa-user"></i> 
                <span>Manajemen User</span>
              </a>
              <ul class="dropdown-menu">
                <li class="{{ request()->is('super-admin/bagianAkademik*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('bagianAkademik.index')}}">
                    Bagian Akademik
                  </a>
                </li>
                <li class="{{ request()->is('super-admin/adminJurusan*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('adminJurusan.index')}}">
                    Admin Jurusan
                  </a>
                </li>
              </ul>
            </li>
          <li class="menu-header">Pengajuan</li>
            <li class="nav-item dropdown
            {{ request()->is('menu-admin/pengajuan-aktif-kuliah*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-izin-penelitian*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-verifikasi-ijazah*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-legalisir*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-dispensasi*') ? 'active' : ''}} ||
            {{ request()->is('menu-admin/pengajuan-pengantar-pkl*') ? 'active' : ''}}">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Pengajuan</span></a>
              <ul class="dropdown-menu">
                <li class="{{ request()->is('menu-admin/pengajuan-aktif-kuliah*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-aktif-kuliah.index')}}">
                    Surat Aktif Kuliah
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-pengantar-pkl*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-pengantar-pkl.index')}}">
                    Pengantar PKL
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-izin-penelitian*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-izin-penelitian.index')}}">
                    Izin Penelitian
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-dispensasi*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-dispensasi.index')}}">
                    Surat Dispensasi
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-legalisir*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-legalisir.index')}}">
                    Legalisir
                  </a>
                </li>
                <li class="{{ request()->is('menu-admin/pengajuan-verifikasi-ijazah*') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('pengajuan-verifikasi-ijazah.index')}}">
                    Verifikasi Ijazah
                  </a>
                </li>
              </ul>
            </li>
          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div> --}}
        @endrole
      </ul>
    </aside>
  </div>