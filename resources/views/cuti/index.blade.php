@extends('template.main')
@section('container')
<div class="section">
            <div class="section-header">
                <h1>List Cuti &nbsp;</h1>
                <div class="section-header-back">
                    @if (Auth::user()->level == 'Pegawai')
                        <a href="/pegawai/pengajuan-cuti/create" class="btn btn-icon btn-primary" title="Ajukan Cuti">
                        <i class="fa fa-plus"></i></a>
                    @endif
                  </div>
                <div class="section-header-breadcrumb">
                   @php
                       if ( Auth::user()->level == 'Petugas') {
                        $link = '/petugas/';
                       }else{
                        $link = '/pegawai/';
                       }
                   @endphp
                    <div class="breadcrumb-item {{Request::is($link.'dashboard')  ? 'active' : ''}} ">
                        <a href="{{ $link.'dashboard' }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item  {{Request::is($link.'pengajuan-cuti')  ? 'active' : ''}}">
                        Cuti
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
            @if (session()->has('reject'))
                    <div class="alert alert-danger alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('reject') }}
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
            <div class="section-body">
                <div class="card">
                  <div class="card-header">
                    <h4>Data {{ $title }}</h4>
                    <div class="card-header-action">
                        @if (Auth::user()->level == 'Petugas')
                            <form action="/petugas/pengajuan-cuti" method="get">
                        @elseif(Auth::user()->level == 'Pegawai')
                            <form action="/pegawai/pengajuan-cuti" method="get">
                                @else
                        @endif

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
                <div class="card-body row col-12">
                    <div class="table-responsive "  >
                      <table class="table table-hover table-md ">
                        <thead>
                            <tr>
                          <th scope="col">No</th>
                          <th scope="col">Pegawai</th>
                          <th scope="col">Jenis Cuti</th>
                          <th scope="col">Alasan</th>
                          <th scope="col">No Surat</th>
                          <th scope="col">Tgl  Surat</th>
                          <th scope="col">Tgl. Pelaksanaan</th>
                          <th scope="col">Status</th>
                          <th scope="col" class="text-center" width="10%">Action</th>
                        </tr>
                    </thead>
                        <tbody class="table-group-divider">
                        @foreach ($pengajuan_cuti as $key => $cuti)
                        <tr>
                            <td>{{ $pengajuan_cuti->firstItem() + $key }}</td>
                            <td>{{ $cuti->pegawai->nama }}</td>
                            <td>{{ $cuti->jenis_cuti }}</td>
                            <td>{{ $cuti->alasan }}</td>
                            <td>{{ $cuti->no_surat}}</td>
                            <td>{{ Date::parse($cuti->tanggal_surat)->format('d F Y')}}</td>
                            <td>{{ Date::parse($cuti->mulai )->format('d F Y')}}-{{ Date::parse($cuti->selesai )->format('d F Y')}}</td>
                            <td> @if ($cuti->status == 'Pending')
                                  <span class="badge badge-warning"> {{ $cuti->status }}</span>
                                  @elseif ($cuti->status == 'Diterima')
                                    <span class="badge badge-success"> {{ $cuti->status }}</span>
                                  @else
                                    <span class="badge badge-danger"> {{ $cuti->status }}</span>

                                  @endif
                             </td>
                             <td>
                                 @switch(Auth::user()->level)
                                @case('Petugas')
                                    @if ($cuti->status == 'Pending')
                                        <div class="form-group row">
                                            <form action="/petugas/pengajuan-cuti/{{ $cuti->id }}/approve" method="POST" id="approve">
                                                @csrf
                                                @method('put')
                                                <button title="Terima" type="submit" class="btn btn-sm btn-icon btn-success ml-3 mr-1"><i class="fa fa-check" aria-hidden="true"></i></button>
                                            </form>
                                            <form action="/petugas/pengajuan-cuti/{{ $cuti->id }}/reject" method="POST">
                                                @csrf
                                                @method('put')
                                                <button title="Tolak" type="submit" class="btn btn-sm btn-icon btn-danger "><i class="fa fa-times" aria-hidden="true"></i></button>
                                            </form>
                                        </div>
                                    @elseif($cuti->status == 'Diterima')
                                        <a href="/petugas/pengajuan-cuti/print/{{ $cuti->id }}" class="btn btn-primary btn-sm ml-4" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                        @else
                                    @endif
                                    @break

                                @default
                                    @if ($cuti->status == 'Pending')
                                        <form action="/pegawai/pengajuan-cuti/{{ $cuti->id }}/cancel" method="POST" id="approve">
                                            @csrf
                                            @method('delete')
                                            <button title="Batal" type="submit" class="btn btn-sm btn-icon btn-danger ml-3 mr-1"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        </form>
                                    @elseif($cuti->status == 'Diterima')
                                        <a href="/pegawai/pengajuan-cuti/print/{{ $cuti->id }}" class="btn btn-primary btn-sm ml-4" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                        @else
                                    @endif
                            @endswitch
                                </div>
                          </td>
                          </tr>
                            @endforeach
                      </tbody>
                    </table>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <div class="text-left">
                   <i> Showing {{ $pengajuan_cuti->firstItem() }} to {{ $pengajuan_cuti->lastItem() }} of {{ $pengajuan_cuti->total() }} Entires</i>
                  </div>
                  <nav class="pull-right d-lg-inline-block">
                   <ul class="pagination mb-0">
                       <li class="page-item{{ ($pengajuan_cuti->onFirstPage()) ? ' disabled' : '' }}">
                           <a class="page-link" href="{{ $pengajuan_cuti->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                       </li>

                       @if ($pengajuan_cuti->lastPage() > 1)
                           @for ($i = 1; $i <= $pengajuan_cuti->lastPage(); $i++)
                               <li class="page-item{{ ($pengajuan_cuti->currentPage() === $i) ? ' active' : '' }}">
                                   <a class="page-link" href="{{ $pengajuan_cuti->url($i) }}">{{ $i }}</a>
                               </li>
                           @endfor
                       @endif

                       <li class="page-item{{ ($pengajuan_cuti->hasMorePages()) ? '' : ' disabled' }}">
                           <a class="page-link" href="{{ $pengajuan_cuti->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                       </li>
                   </ul>
                 </nav>
                        </div>
                  </div>
                </div>

            </div>
        </div>

@endsection
