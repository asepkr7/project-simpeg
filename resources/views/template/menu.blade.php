            @if (Auth::user()->level == 'Petugas')
                <li class="menu-header">Menu Menu</li>
              <li class="nav-item {{ Request::is('petugas/dashboard') ? 'active' : '' }}"><a href="/petugas/dashboard" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
              <li class="menu-header">Menu Petugas</li>
              <li class="nav-item {{ Request::is('petugas/data-pegawai') ? 'active' : '' }}"><a class="nav-link" href="/petugas/data-pegawai"><i class="fa fa-user" aria-hidden="true"></i><span>Data Pegawai</span></a></li>
              <li class="nav-item dropdown {{ Request::is('#keluarga') ? 'active' : '' }}">
                <a href="#keluarga" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-users" aria-hidden="true"></i> <span>Riwayat Keluarga</span></a>
                <ul class="dropdown-menu">
                  <li class="nav-item {{ Request::is('petugas/data-pasangan') ? 'active' : '' }}"><a class="nav-link" href="/petugas/data-pasangan">Suami/Istri</a></li>
                  <li class="nav-item {{ Request::is('petugas/data-anak') ? 'active' : '' }}"><a class="nav-link" href="/petugas/data-anak">Anak</a></li>
                  <li class="nav-item {{ Request::is('petugas/data-ortu') ? 'active' : '' }}"><a class="nav-link" href="/petugas/data-ortu">Orang Tua</a></li>
                </ul>
              </li>
              <li><a href="/petugas/pendidikan" class="nav-link"><i class="fa fa-university" aria-hidden="true"></i></i><span>Riwayat Pendidikan</span></a> </li>
              <li class="nav-item dropdown {{ Request::is('#kepegawaian') ? 'active' : '' }}">
                <a href="#kepegawaian" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-suitcase" aria-hidden="true"></i> <span>Riwayat Kepegawaian</span></a>
                <ul class="dropdown-menu">
                  <li class="nav-item {{ Request::is('petugas/pangkat') ? 'active' : '' }}"><a class="nav-link" href="/petugas/pangkat">Pangkat</a></li>
                  <li class="nav-item {{ Request::is('petugas/jabatan') ? 'active' : '' }}"><a class="nav-link" href="/petugas/jabatan">Jabatan</a></li>
                  <li class="nav-item {{ Request::is('petugas/diklat') ? 'active' : '' }}"><a class="nav-link" href="/petugas/diklat">Diklat</a></li>
                   <li class="nav-item {{ Request::is('pegawai/penghargaan') ? 'active' : '' }}"><a class="nav-link" href="/petugas/penghargaan">Penghargaan</a></li>
                  <li class="nav-item {{ Request::is('petugas/gapok') ? 'active' : '' }}"><a class="nav-link" href="/petugas/gapok">Gapok</a></li>
                </ul>
              </li>
              <li  class="nav-item {{ Request::is('petugas/pengajuan-cuti') ? 'active' : '' }}">
                <a class="nav-link" href="/petugas/pengajuan-cuti"> <i class="fas fa-calendar-check"></i></i> <span>Pengajuan Cuti</span></a>
              </li>
              <li  class="nav-item {{ Request::is('petugas/kgb') ? 'active' : '' }}">
                <a class="nav-link" href="/petugas/kgb"><i class="fas fa-money-check-alt"></i><span>KGB</span></a>
              </li>
              <li  class="nav-item {{ Request::is('petugas/pensiun') ? 'active' : '' }}">
                <a class="nav-link" href="/petugas/pensiun"><i class="fa fa-user-times" aria-hidden="true"></i><span>Pensiun</span></a>
              </li>
              <li  class="nav-item {{ Request::is('petugas/lampiran') ? 'active' : '' }}">
                <a class="nav-link" href="/petugas/lampiran"><i class="fa fa-file" aria-hidden="true"></i><span>Lampiran</span></a>
              </li>
              <li  class="nav-item {{ Request::is('petugas/users') ? 'active' : '' }}">
                <a href="/petugas/users"  class="nav-link"><i class="fa fa-user-plus" aria-hidden="true"></i> <span>Users</span></a>
              </li>
            @endif
            @if (Auth::user()->level == 'Pimpinan')
            <li class="menu-header">Menu Pimpinan</li>
              <li><a href="/pimpinan/dashboard" class="nav-link {{ Request::is('petugas/dashboard') ? 'active' : '' }}"><i class="fas fa-fire"></i><span>Dashboard</span></a> </li>
              <li><a class="nav-link" href="/pimpinan/data-pegawai"><i class="fa fa-user" aria-hidden="true"></i><span>Data Pegawai</span></a></li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-suitcase" aria-hidden="true"></i> <span>Kepegawaian</span></a>
                <ul class="dropdown-menu">
                  <li class="nav-item{{ Request::is('pimpinan/pangkat') ? 'active' : '' }} "><a class="nav-link" href="/pimpinan/pangkat">Pangkat</a></li>
                  <li class="nav-item{{ Request::is('pimpinan/jabatan') ? 'active' : '' }} "><a class="nav-link" href="/pimpinan/jabatan">Jabatan</a></li>
                  <li class="nav-item{{ Request::is('pimpinan/diklat') ? 'active' : '' }} "><a class="nav-link" href="/pimpinan/diklat">Diklat</a></li>
                   <li class="nav-item {{ Request::is('pimpinan/penghargaan') ? 'active' : '' }}"><a class="nav-link" href="/pimpinan/penghargaan">Penghargaan</a></li>
                  <li class="nav-item {{ Request::is('pimpinan/gapok') ? 'active' : '' }}"><a class="nav-link" href="/pimpinan/gapok">Gapok</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file" aria-hidden="true"></i><span>Laporan</span></a>
                <ul class="dropdown-menu">
                  <li class="nav-item{{ Request::is('pimpinan/duk') ? 'active' : '' }} "><a class="nav-link" href="/pimpinan/duk" target="_blank">DUK</a></li>
                  <li class="nav-item{{ Request::is('pimpinan/filterscuti') ? 'active' : '' }} "><a class="nav-link" href="/pimpinan/filterscuti">Cuti</a></li>
                  <li class="nav-item{{ Request::is('pimpinan/filterskgb') ? 'active' : '' }} "><a class="nav-link" href="/pimpinan/filterskgb" >KGB</a></li>
                   <li class="nav-item {{ Request::is('pimpinan/filterspensiun') ? 'active' : '' }}"><a class="nav-link" href="/pimpinan/filterspensiun">Pensiun</a></li>
                </ul>
              </li>
            @endif
            @if (Auth::user()->level == 'Pegawai')
            <li class="menu-header">Menu Pegawai</li>
              <li><a href="/pegawai/dashboard" class="nav-link {{ Request::is('petugas/dashboard') ? 'active' : '' }}"><i class="fas fa-fire"></i><span>Dashboard</span></a> </li>
              <li><a class="nav-link" href="/pegawai/profile"><i class="fa fa-user" aria-hidden="true"></i><span>Profile</span></a></li>
               <li class="nav-item dropdown {{ Request::is('#keluarga') ? 'active' : '' }}">
                <a href="#keluarga" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-users" aria-hidden="true"></i> <span>Riwayat Keluarga</span></a>
                <ul class="dropdown-menu">
                  <li class="nav-item {{ Request::is('pegawai/data-pasangan') ? 'active' : '' }}"><a class="nav-link" href="/pegawai/data-pasangan">Suami/Istri</a></li>
                  <li class="nav-item {{ Request::is('pegawai/data-anak') ? 'active' : '' }}"><a class="nav-link" href="/pegawai/data-anak">Anak</a></li>
                  <li class="nav-item {{ Request::is('pegawai/data-ortu') ? 'active' : '' }}"><a class="nav-link" href="/pegawai/data-ortu">Orang Tua</a></li>
                </ul>
              </li>
               <li class="nav-item dropdown {{ Request::is('#kepegawaian') ? 'active' : '' }}">
                <a href="#kepegawaian" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-suitcase" aria-hidden="true"></i> <span>Riwayat Kepegawaian</span></a>
                <ul class="dropdown-menu">
                  <li class="nav-item {{ Request::is('pegawai/pangkat') ? 'active' : '' }}"><a class="nav-link" href="/pegawai/pangkat">Pangkat</a></li>
                  <li class="nav-item {{ Request::is('pegawai/jabatan') ? 'active' : '' }}"><a class="nav-link" href="/pegawai/jabatan">Jabatan</a></li>
                  <li class="nav-item {{ Request::is('pegawai/diklat') ? 'active' : '' }}"><a class="nav-link" href="/pegawai/diklat">Diklat</a></li>
                  <li class="nav-item {{ Request::is('pegawai/penghargaan') ? 'active' : '' }}"><a class="nav-link" href="/pegawai/penghargaan">Penghargaan</a></li>
                  <li class="nav-item {{ Request::is('pegawai/gapok') ? 'active' : '' }}"><a class="nav-link" href="/pegawai/gapok">Gapok</a></li>
                </ul>
              </li>
              <li  class="nav-item {{ Request::is('pegawai/pengajuan-cuti') ? 'active' : '' }}">
                <a class="nav-link" href="/pegawai/pengajuan-cuti"> <i class="fas fa-calendar-check"></i><span>Pengajuan Cuti</span></a>
              </li>
              <li  class="nav-item {{ Request::is('pegawai/kgb') ? 'active' : '' }}">
                <a class="nav-link" href="/pegawai/kgb"><i class="fas fa-money-check-alt"></i><span>KGB</span></a>
              </li>
              <li  class="nav-item {{ Request::is('pegawai/pensiun') ? 'active' : '' }}">
                <a class="nav-link" href="/pegawai/pensiun"><i class="fa fa-user-times" aria-hidden="true"></i><span>Pensiun</span></a>
              </li>
              <li  class="nav-item {{ Request::is('pegawai/lampiran') ? 'active' : '' }}">
                <a class="nav-link" href="/pegawai/lampiran"><i class="fa fa-file" aria-hidden="true"></i><span>Lampiran</span></a>
              </li>
              <li class="nav-item dropdown">
            @endif

