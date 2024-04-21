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
                <i class="fas fa-users"></i>
                <span>Kaderisasi</span></a>
            </li>

          <li class="menu-header">Pertanyaan</li>
            <li class="nav-item {{ request()->is('admin-corporate/soal*') ? 'active' : '' }}">
              <a href="{{route('soal.index')}}" class="nav-link">
                <i class="fas fa-pen-square"></i>
                <span>Pertanyaan</span></a>
            </li>

          <li class="menu-header">List Jurnal Publish</li>
            <li class="nav-item {{ request()->is('admin-corporate/jurnal-publish*') ? 'active' : '' }}">
              <a href="{{route('jurnal-publish.index')}}" class="nav-link">
                <i class="fas fa-list-alt"></i>
                <span>List Jurnal Publish</span></a>
            </li>
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
                <i class="fas fa-clipboard"></i>
                <span>Penugasan</span></a>
            </li>

          <li class="menu-header">Verifikasi Jurnal</li>
            <li class="nav-item {{ request()->is('manager/verifikasi*') ? 'active' : '' }}">
              <a href="{{route('verifikasi-jurnal.index')}}" class="nav-link">
                <i class="fas fa-file-signature"></i>
                <span>Verifikasi Jurnal</span></a>
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
                <i class="fas fa-file-alt"></i>
                <span>Evaluasi Jurnal</span></a>
            </li>

          <li class="menu-header">Hasil Penilaian</li>
            <li class="nav-item {{ request()->is('karyawan/penilaian*') ? 'active' : '' }}">
              <a href="{{route ('penilaian.index')}}" class="nav-link">
                <i class="fas fa-award"></i>
                <span>Hasil Penilaian</span></a>
          
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
                <i class="fas fa-file-alt"></i>
                <span>Jurnal</span></a>
            </li>

          <li class="menu-header">Hasil Penilaian</li>
            <li class="nav-item {{ request()->is('karyawan/penilaian*') ? 'active' : '' }}">
              <a href="{{ route ('penilaian.index')}}" class="nav-link">
                <i class="fas fa-award"></i>
                <span>Hasil Penilaian</span></a>
        @endrole
      </ul>
    </aside>
  </div>