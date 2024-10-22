<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
   <title>Simpeg</title>

   <link rel="icon" href="/img/logo1.png">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="/template/node_modules/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="/template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
  {{-- <script src="https://kit.fontawesome.com/1cfe60370c.js" crossorigin="anonymous"></script> --}}
  <link rel="stylesheet" href="/template/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/template/node_modules/datatables/media/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="/template/node_modules/bootstrap-daterangepicker/daterangepicker.css">
 <link rel="stylesheet" href="/template/node_modules/prismjs/themes/prism.css">
 <link rel="stylesheet" href="/template/node_modules/select2/dist/css/select2.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>


  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="/template/assets/css/style.css">
  <link rel="stylesheet" href="/template/assets/css/components.css">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">

            <div class="sidebar-brand sidebar-brand">
                <h6 class="title mt-3"><font color="#fff"> Dinas Penanaman Modal Dan Pelayanan Terpadu Situbondo</font></h6>
            </div>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            @if (auth()->user()->pegawai->image)
            <img src="{{asset('storage/'.auth()->user()->pegawai->image) }}"  alt="Foto Pegawai" class="rounded-circle mr-1">
            @else
             <img src="/template/assets/img/avatar/avatar-1.png" alt="Foto Pegawai" class="rounded-circle mr-1">
             @endif
            {{-- <img alt="image" src="/template/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1"> --}}
            <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->pegawai->nama }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="/logout" class="dropdown-item has-icon text-danger" id="logout" data-confirm="Logout?|Yakin Keluar Aplikasi?" data-confirm-yes="returnlogout()">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2" style="overflow: hidden;">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="#">Simpeg</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">SIMPEG</a>
          </div>
          <ul class="sidebar-menu">
              @include('template.menu')
            </ul>
        </aside>
      </div>
<div class="main-content">

<section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item  {{ Request::is('petugas/dashboard') ? 'active' : '' }}"><a href="javascript:;" class="btn btn-sm btn-primary m-b-10"><i class="far fa-calendar-alt"></i><font style="font-size: 10px;">
   <script type='text/javascript'>

						var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
						var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
						var date = new Date();
						var day = date.getDate();
						var month = date.getMonth();
						var thisDay = date.getDay(),
							thisDay = myDays[thisDay];
						var yy = date.getYear();
						var year = (yy < 1000) ? yy + 1900 : yy;
						document.write( day + ' ' + months[month] + ' ' + year);
						//-->
						</script></font></a></div>
            </div>
          </div>
          <div class="section-body">
              @if (Auth::user()->level == 'Petugas')
              <h6 class="text"><marquee behavior="" direction=""><b> Selamat Datang {{ Auth::user()->pegawai->nama }} Anda Login Sebagai {{ Auth::user()->level }} </b></marquee></h6>
                   <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-calendar-check"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pengajuan Cuti</h4>
                  </div>
                  <div class="card-body">
                    {{ $cuti }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                 <i class="fas fa-money-check-alt"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>KGB</h4>
                  </div>
                  <div class="card-body">
                    {{ $kgb }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                 <i class="fas fa-user-times"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pensiun</h4>
                  </div>
                  <div class="card-body">
                    {{$pensiun}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                   <i class="fas fa-user-tie"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Pegawai</h4>
                  </div>
                  <div class="card-body">
                    {{$pegawai}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                      <div class="card-header">
                        <h4>Diagram Pegawai Berdasar Kelamin</h4>
                      </div>
                      <div class="card-body">
                        <canvas id="myChart3"></canvas>
                      </div>
                    </div>
                  </div>
              <div class="col-12 col-md-6 col-lg-6 ">
                    <div class="card">
                      <div class="card-header">
                        <h4>Grafik Data Kepegawaian</h4>
                      </div>
                      <div class="card-body">
                        <canvas id="myChart2"></canvas>
                      </div>
                    </div>
                  </div>
                    </div>
          </div>
               @endif
               <div class="section-body">
               @if (Auth::user()->level == 'Pimpinan')
              <h6 class="text"><marquee behavior="" direction=""><b> Selamat Datang {{ Auth::user()->pegawai->nama }} Anda Login Sebagai {{ Auth::user()->level }} </b></marquee></h6>
               <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                      <div class="card-header">
                        <h4>Bar Chart</h4>
                      </div>
                      <div class="card-body">
                        <canvas id="myChart3"></canvas>
                      </div>
                    </div>
                  </div>
              <div class="col-12 col-md-6 col-lg-6 ">
                    <div class="card">
                      <div class="card-header">
                        <h4>Grafik Data Kepegawaian</h4>
                      </div>
                      <div class="card-body">
                        <canvas id="myChart2"></canvas>
                      </div>
                    </div>
                  </div>
                    </div>
         </div>
               @endif
               <div class="section-body">
               @if (Auth::user()->level == 'Pegawai')
                <h6 class="text"><marquee behavior="" direction=""><b> Selamat Datang {{ Auth::user()->pegawai->nama }} Anda Login Sebagai {{ Auth::user()->level }} </b></marquee></h6>
                <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-calendar-check"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Cuti</h4>
                  </div>
                  <div class="card-body">
                    {{ $total_cuti }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                 <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Jumlah Keluarga</h4>
                  </div>
                  <div class="card-body">
                    {{ $total }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                 <i class="fas fa-user-times"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Batas Usia Pensiun</h4>
                  </div>
                  <div class="card-body">
                    <font style="font-size: 15px">
                        @php
                               $tanggalLahir = Carbon\Carbon::parse(Auth::user()->pegawai->tanggal_lahir);
                               $umurSekarang = $tanggalLahir->age;
                               $tanggalMencapaiUmur58 = $tanggalLahir->addYears(58);

                               // Jika tanggal yang diperoleh melebihi tanggal saat ini, kita kurangi satu tahun
                               if ($tanggalMencapaiUmur58->isFuture()) {
                                   $tanggalMencapaiUmur58->subYear();
                               }
                           @endphp
                        {{  $tanggalMencapaiUmur58->format('d/m/Y') }}
                    </font>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                   <i class="fas fa-user-tie"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Status Kepegawaian</h4>
                  </div>
                  <div class="card-body">
                    <font style="font-size: 15px">
                        {{ Auth::user()->pegawai->status_kepegawaian }}
                    </font>
                  </div>
                </div>
              </div>
            </div>
          </div>
                </div>
             </div>
            </section>
            @endif

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Developed By <a href="">Asep Ripa'i</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>
 </div>
  <!-- General JS Scripts -->
  <script src="/template/node_modules/jquery/dist/jquery.min.js"></script>

  <script src="/template/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="/template/node_modules/tooltip.js"></script>
  <script src="/template/node_modules/select2/dist/js/select2.full.min.js"></script>
  <script src="/template/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
   <script src="/template/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
   <script src="/template/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
   <script src="/template/node_modules/chart.js/dist/Chart.min.js"></script>
   <script src="/template/assets/js/page/modules-chartjs.js"></script>
   <script>

const xValues = ["PNS", "CPNS", "PPPK", "TKK", "Honorer", "Magang",];
const yValues = [{{ $pns }}, {{ $cpns }}, {{ $pppk }}, {{ $tkk }}, {{ $honorer }}, {{ $magang }},];
const barColors = ["purple", "green", "red", "orange", "brown", "blue",];

new Chart("myChart2", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [
            {
                backgroundColor: barColors,
                data: yValues,
            },
        ],
    },
    options: {
        legend: { display: false },
        title: {
            display: true,
            text: "World Wine Production 2018",
        },
    },
});

</script>

<script>
const aValues = ["Laki-Laki", "Perempuan"];
const bValues = [{{ $pria }}, {{ $wanita }}];
const abarColors = [
  "#b91d47",
  "#00aba9"
//   "#2b5797",
//   "#e8c3b9",
//   "#1e7145"
];

new Chart("myChart3", {
  type: "pie",
  data: {
    labels: aValues,
    datasets: [{
      backgroundColor: abarColors,
      data: bValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "World Wide Wine Production 2018"
    }
  }
});
</script>

  <!-- Page Specific JS File -->


  <script src="/template/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
  <script src="/template/assets/js/stisla.js"></script>

    <script src="/template/assets/js/page/bootstrap-modal.js"></script>
    <script src="/template/node_modules/prismjs/prism.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="/template/assets/js/scripts.js"></script>
  <script src="/template/assets/js/custom.js"></script>


</body>
</html>

