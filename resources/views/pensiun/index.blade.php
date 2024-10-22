@extends('template.main')
@section('container')
<div class="section">
            <div class="section-header">
                <h1>List {{$title}} &nbsp;</h1>
                @if (Auth::user()->level == 'Petugas')
                <div class="section-header-back">
                    <a href="/petugas/pensiun/create" class="btn btn-icon btn-primary" title="Tambah {{$title}}">
                        <i class="fa fa-plus"></i></a>
                  </div>
                @endif
                <div class="section-header-breadcrumb">
                   @php
                       if ( Auth::user()->level == 'Petugas') {
                        $link = '/petugas/';
                       }elseif (Auth::user()->level == 'Pimpinan') {
                        $link = '/pimpinan/';
                       }else
                   @endphp
                    <div class="breadcrumb-item {{Request::is($link.'dashboard')  ? 'active' : ''}} ">
                        <a href="{{ $link.'dashboard' }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item  {{Request::is($link.'pensiun')  ? 'active' : ''}}">
                        Pensiun
                    </div>

                </div>
            </div>
            <div class="section-body">
                    <div class="card">
                            <div class="card-header">
                                <div class="card-header-form">
                                    <label for="tahun" class="control-label">Pilih Periode :</label>
                         <form action="/petugas/pensiun" method="GET">
                    <div class="float-left">
                        <select name="tahun" id="tahun" class="custom-select" style="width: 155pt; position: relative;">
                             @php
                            $currentYear = Carbon\Carbon::now()->year;
                          @endphp
                            <option value="{{ $currentYear }}">{{ $currentYear }}</option>
                    <option value="{{ $currentYear + 1 }}" {{ $selectedYear == $currentYear + 1 ? 'selected' : '' }}>{{ $currentYear + 1 }}</option>
                    <option value="{{ $currentYear + 2 }}" {{ $selectedYear == $currentYear + 2 ? 'selected' : '' }}>{{ $currentYear + 2 }}</option>
                    <option value="all" {{ $selectedYear == 'all' ? 'selected' : '' }}>Semua</option>
                        </select>
                    </div>
                    <div class="float-right ml-2">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                         </form>
                        </div>
                        </div>
                     </div>
            </div>
            @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('success') }}
                      </div>
                    </div>
                @endif
            @if (session()->has('delete'))
                    <div class="alert alert-danger alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('delete') }}
                      </div>
                    </div>
                @endif
            @if (session()->has('edit'))
                    <div class="alert alert-warning alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('edit') }}
                      </div>
                    </div>
                @endif
            @if (session()->has('active'))
                    <div class="alert alert-primary alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('active') }}
                      </div>
                    </div>
                @endif

                @if ($selectedYear || $selectedYear == 'all')

                <div class="section-body">
               <div class="card">
                 <div class="card-header">
                   <h4>Data {{ $title }}</h4>
                   {{-- <div class="card-header-action">

                           <div class="float-left">
                               <input type="text" name="search" id="search" style="width: 155pt;" value="{{ request('search') }}" placeholder="Keyword Pencarian" class="form-control">
                           </div>
                           <div class="float-right ml-2">
                               <button class="btn btn-primary" type="submit"> <i class="fas fa-search"></i></button>
                           </div>
                       </div> --}}
                   </div>
<form action="/petugas/pensiun" method="GET">
                   <div class="ml-4">

                               <select hidden name="show_entries" id="show_entries" class="form-actions">
                                   <option value="10" hidden {{ request()->input('show_entries') == '10' ? 'selected' : '' }}>10</option>
                                   <option value="20" hidden {{ request()->input('show_entries') == '20' ? 'selected' : '' }}>20</option>
                                   <option value="50" hidden {{ request()->input('show_entries') == '50' ? 'selected' : '' }}>50</option>
                                   <option value="100" hidden {{ request()->input('show_entries') == '100' ? 'selected' : '' }}>100</option>
                               </select>

                           </div>
                       </form>
               <div class="card-body row col-md-12">
                   <div class="table"  >
                     <table class="table table-hover table-responsive table-md table-1"  id="table-1">
                       <thead>
                           <tr>
                         <th scope="col">No</th>
                         <th scope="col">Pegawai</th>
                         <th scope="col">Jenis Kelamin</th>
                         <th scope="col">Masuk Pensiun</th>
                         <th scope="col">Umur</th>
                         <th scope="col">Tanggal Lahir</th>
                         <th scope="col">Jabatan</th>
                         <th scope="col">Pangkat</th>
                         <th scope="col" class="text-center" width="10%">Action</th>
                       </tr>
                   </thead>
                       <tbody class="table-group-divider">
                       @foreach ($pegawai as $key => $row)
                       <tr>
                           <td>{{ $pegawai->firstItem() + $key }}</td>
                           <td>{{ $row->nama }}</td>
                           <td>{{ $row->gender == 'l' ? 'Laki-Laki':'Perempuan' }}</td>
                           <td>
                             @php
                               $tanggalLahir = Carbon\Carbon::parse($row->tanggal_lahir);
                               $umurSekarang = $tanggalLahir->age;
                               $tanggalMencapaiUmur58 = $tanggalLahir->addYears(58);

                               // Jika tanggal yang diperoleh melebihi tanggal saat ini, kita kurangi satu tahun
                               if ($tanggalMencapaiUmur58->isFuture()) {
                                   $tanggalMencapaiUmur58->subYear();
                               }
                           @endphp
                          {{ $tanggalMencapaiUmur58->format('d/m/Y') }} </td>

                          <td>{{ Carbon\Carbon::parse($row->tanggal_lahir)->age }}</td>

                           <td>{{ $row->tanggal_lahir}}</td>

                           <td>@foreach ($row->jabatan as $item)
                               {{ $item->jabatan }}
                           @endforeach</td>
                           <td>@foreach ($row->pangkat as $item)
                               {{ $item->pangkat }}
                           @endforeach</td>
                            <td>
                               @if(Auth::user()->level == 'Petugas')
                                       <div class="form-group row">
                                           <a href="/petugas/pensiun/{{ $row->nip }}/notif" class="btn btn-primary btn-sm ml-3 mt-3" title="Kirim Pemberitahun" > <i class="fas fa-bell"></i></a>
                                       </div>
                                   @endif
                                </div>
                            </td>
                         </tr>
                           @endforeach
                     </tbody>
                   </table>
                   </div>
                 </div>
                 {{-- <div class="card-footer text-right">
                   <div class="text-left">
                  <i> Showing {{ $pegawai->firstItem() }} to {{ $pegawai->lastItem() }} of {{ $pegawai->total() }} Entires</i>
                 </div>
                 <nav class="pull-right d-lg-inline-block">
                  <ul class="pagination mb-0">
                      <li class="page-item{{ ($pegawai->onFirstPage()) ? ' disabled' : '' }}">
                          <a class="page-link" href="{{ $pegawai->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                      </li>

                      @if ($pegawai->lastPage() > 1)
                          @for ($i = 1; $i <= $pegawai->lastPage(); $i++)
                              <li class="page-item{{ ($pegawai->currentPage() === $i) ? ' active' : '' }}">
                                  <a class="page-link" href="{{ $pegawai->url($i) }}">{{ $i }}</a>
                              </li>
                          @endfor
                      @endif

                      <li class="page-item{{ ($pegawai->hasMorePages()) ? '' : ' disabled' }}">
                          <a class="page-link" href="{{ $pegawai->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                      </li>
                  </ul>
                </nav>
                       </div> --}}
                 </div>
               </div>
                @else
                 <div class="section-body">
                <div class="card">
                  <div class="card-header">
                    <h4>Data {{ $title }}</h4>
                    <div class="card-header-action">
                        <form action="/petugas/pensiun" method="get">
                            <div class="float-left">
                                <input type="text" name="search" id="search" style="width: 155pt;" value="{{ request('search') }}" placeholder="Keyword Pencarian" class="form-control">
                            </div>
                            <div class="float-right ml-2">
                                <button class="btn btn-primary" type="submit"> <i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="ml-4">
                                <label for="show_entries" class="form-label">Show :</label>
                                <select name="show_entries" id="show_entries" class="form-actions">
                                    <option value="10" {{ request()->input('show_entries') == '10' ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request()->input('show_entries') == '20' ? 'selected' : '' }}>20</option>
                                    <option value="50" {{ request()->input('show_entries') == '50' ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request()->input('show_entries') == '100' ? 'selected' : '' }}>100</option>
                                </select>
                                <label for=""> Entries</label>
                            </div>
                        </form>
                <div class="card-body row col-md-12">
                    <div class="table"  >
                      <table class="table table-hover table-responsive table-md ">
                        <thead>
                            <tr>
                          <th scope="col">No</th>
                          <th scope="col">Pegawai</th>
                          <th scope="col">Jenis Pensiun</th>
                          <th scope="col">TMT Pensiun</th>
                          <th scope="col">Masa Kerja</th>
                          <th scope="col">Alamat Pensiun</th>
                          <th scope="col">No Surat</th>
                          <th scope="col" class="text-center" width="10%">Action</th>
                        </tr>
                    </thead>
                        <tbody class="table-group-divider">
                        @foreach ($pensiun as $key => $row)
                        <tr>
                            <td>{{ $pensiun->firstItem() + $key }}</td>
                            <td>{{ $row->pegawai->nama }}</td>
                            <td>{{ $row->jenis_pensiun }}</td>
                            <td>{{ $row->tmt_pensiun }} </td>
                           <td>{{ $row->masa_kerja }}</td>
                            <td>{{ $row->alamat_pensiun}}</td>
                            <td>{{ $row->no_surat }}</td>
                             <td>
                                @if (Auth::user()->level == 'Petugas')

                                <div class="form-group row">
                                    <a href="/petugas/pensiun/print/{{ $row->id }}" class="btn btn-primary btn-sm mr-1" target="_blank" > <i class="fas fa-print"></i></a>
                                    <a href="/petugas/pensiun/{{ $row->id}}/edit" class="btn btn-warning btn-sm  "> <i class="fas fa-edit"></i></a>
                                    <form action="/petugas/pensiun/{{ $row->id}}" method="POST" class="align-content-center" id="del-{{$row->id}}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm mt-1 ml-3" data-confirm="Hapus Data?|Apakah Anda yakin Ingin Menghapus Data <br> Nama : {{ $row->pegawai->nama }} <br> Jenis Pensiun : {{ $row->jenis_pensiun }} ?" data-confirm-yes="submitDel({{$row->id}})">
                                            <i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                    @endif
                          </tr>
                            @endforeach
                      </tbody>
                    </table>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <div class="text-left">
                   <i> Showing {{ $pensiun->firstItem() }} to {{ $pensiun->lastItem() }} of {{ $pensiun->total() }} Entires</i>
                  </div>
                  <nav class="pull-right d-lg-inline-block">
                   <ul class="pagination mb-0">
                       <li class="page-item{{ ($pensiun->onFirstPage()) ? ' disabled' : '' }}">
                           <a class="page-link" href="{{ $pensiun->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                       </li>

                       @if ($pensiun->lastPage() > 1)
                           @for ($i = 1; $i <= $pensiun->lastPage(); $i++)
                               <li class="page-item{{ ($pensiun->currentPage() === $i) ? ' active' : '' }}">
                                   <a class="page-link" href="{{ $pensiun->url($i) }}">{{ $i }}</a>
                               </li>
                           @endfor
                       @endif

                       <li class="page-item{{ ($pensiun->hasMorePages()) ? '' : ' disabled' }}">
                           <a class="page-link" href="{{ $pensiun->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                       </li>
                   </ul>
                 </nav>
                        </div>
                  </div>
                </div>
                                    @endif

@endsection
