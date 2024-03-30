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

          <li class="menu-header">Kaderisasi</li>
            <li class="nav-item {{ request()->is('admin-corporate/kaderisasi*') ? 'active' : '' }}">
              <a href="{{route('kaderisasi.index')}}" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Kaderisasi</span></a>
            </li>

          <li class="menu-header">List Jurnal Publish</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-home"></i>
                <span>List Jurnal Publish</span></a>
            </li>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div>
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
              {{ request()->is('admin-it/user*') ? 'active' : ''}} ||
              {{ request()->is('admin-it/karyawan*') ? 'active' : ''}} ||">
    
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

          <li class="menu-header">Penugasan</li>
            <li class="nav-item {{ request()->is('manager/penugasan*') ? 'active' : '' }}">
              <a href="{{route('penugasan.index')}}" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Penugasan</span></a>
            </li>

          <li class="menu-header">Verifikasi Jurnal</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Verifikasi Jurnal</span></a>
            </li>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div>
        @endrole

        @role('karyawan-senior')
          <li class="menu-header">Dashboard Karyawan Senior</li>
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
              <a href="{{route('dashboard')}}" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Dashboard</span></a>
            </li>

          <li class="menu-header">Evaluasi</li>
            <li class="nav-item {{ request()->is('karyawan-senior/evaluasi*') ? 'active' : '' }}">
              <a href="{{route('evaluasi.index')}}" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Jurnal</span></a>
            </li>

          <li class="menu-header">Hasil Penilaian</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Hasil Penilaian</span></a>
            </li>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div>
        @endrole

        @role('karyawan-junior')
          <li class="menu-header">Dashboard Karyawan Junior</li>
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
              <a href="{{route('dashboard')}}" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Dashboard</span></a>
            </li>

          <li class="menu-header">Jurnal</li>
            <li class="nav-item {{ request()->is('karyawan-junior/jurnal*') ? 'active' : '' }}">
              <a href="{{route('jurnal.index')}}" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Jurnal</span></a>
            </li>

          <li class="menu-header">Hasil Penilaian</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Hasil Penilaian</span></a>
            </li>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div>
        @endrole
      </ul>
    </aside>
  </div>