@extends('template.main')
@section('container')
<div class="section">
            <div class="section-header">
                <h1>List {{ $title }} &nbsp;</h1>
                @if (Auth::user()->level == 'Petugas')
                <div class="section-header-back">
                    <a href="/petugas/kgb/create" class="btn btn-icon btn-primary" title="Tambah {{ $title }}">
                        <i class="fa fa-plus"></i></a>
                  </div>
                @endif
                <div class="section-header-breadcrumb">
                   @php
                       if ( Auth::user()->level == 'Petugas') {
                        $link = '/petugas/';
                       }elseif (Auth::user()->level == 'Pimpinan') {
                        $link = '/pimpinan/';
                       }else{
                        $link = '/pegawai/';
                       }
                   @endphp
                    <div class="breadcrumb-item {{Request::is($link.'dashboard')  ? 'active' : ''}} ">
                        <a href="{{ $link.'dashboard' }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item  {{Request::is($link.'kgb')  ? 'active' : ''}}">
                        {{ $title }}
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
            <div class="section-body">
                <div class="card">
                  <div class="card-header">
                    <h4>Data {{ $title }}</h4>
                    <div class="card-header-action">
                        @if (Auth::user()->level == 'Petugas')
                            <form action="/petugas/kgb" method="get">
                        @elseif(Auth::user()->level == 'Pimpinan')
                            <form action="/pimpinan/kgb" method="get">
                                @else
                                <form action="/pegawai/kgb" method="get">
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
                <div class="card-body row lg-12">
                    <div class="table"  >
                      <table class="table table-hover table-resvonsive table-md ">
                        <thead>
                            <tr>
                          <th scope="col">No</th>
                          <th scope="col">Pegawai</th>
                          <th scope="col">Gapok Lama</th>
                          <th scope="col">TMT Lama</th>
                          <th scope="col">Gapok Baru</th>
                          <th scope="col">TMT Baru</th>
                          <th scope="col">Naik Selanjutnya</th>
                          @if (Auth::user()->level == 'Petugas' || Auth::user()->level == 'Pegawai')
                        <th scope="col" class="text-center" width="10%">Action</th>
                        @endif
                        </tr>
                    </thead>
                        <tbody class="table-group-divider">
                        @foreach ($kgb as $key => $row)
                        <tr>
                            <td>{{ $kgb->firstItem() + $key }}</td>
                            <td>{{ $row->pegawai->nama }}</td>
                            <td>{{ $row->gapok_lama }}</td>
                            <td>{{ $row->tmt_lama}}</td>
                            <td>{{ $row->gapok_baru}}</td>
                            <td>{{ $row->tmt_baru }}</td>
                            <td>{{ $row->naik_lanjut }}</td>
                                                         <td>
                                 <div class="form-group row mt-3">
                                @if(Auth::user()->level == 'Petugas')
                                             <a href="/petugas/kgb/print/{{ $row->id }}" class="btn btn-primary btn-sm mr-1" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                             <a href="/petugas/kgb/{{ $row->id }}/edit" class="btn btn-warning btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                             <form action="/petugas/kgb/{{ $row->id}}" method="post" class="align-content-center" id="del-{{ $row->id}}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm mt-1 ml-3" data-confirm="Hapus Data?|Apakah Anda yakin Ingin Menghapus Data <br> Nama : {{ $row->pegawai->nama }} <br> Gaji Pokok Baru : {{ $row->gapok_baru }} ?" data-confirm-yes="submitDel({{ $row->id}})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @elseif(Auth::user()->level == 'Pegawai')
                                            <button class="btn btn-sm btn-primary ml-3" data-toggle="modal" data-target="#ModalUp{{ $row->id }}" ><i class="fas fa-upload"></i></button>
                                        </div>
                                    </td>
                                    @else
                                    @endif
                          </tr>

                            @endforeach
                      </tbody>
                    </table>
                  <div class="card-footer text-right">
                    <div class="text-left">
                   <i> Showing {{ $kgb->firstItem() }} to {{ $kgb->lastItem() }} of {{ $kgb->total() }} Entires</i>
                  </div>
                  <nav class="pull-right d-lg-inline-block">
                   <ul class="pagination mb-0">
                       <li class="page-item{{ ($kgb->onFirstPage()) ? ' disabled' : '' }}">
                           <a class="page-link" href="{{ $kgb->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                       </li>

                       @if ($kgb->lastPage() > 1)
                           @for ($i = 1; $i <= $kgb->lastPage(); $i++)
                               <li class="page-item{{ ($kgb->currentPage() === $i) ? ' active' : '' }}">
                                   <a class="page-link" href="{{ $kgb->url($i) }}">{{ $i }}</a>
                               </li>
                           @endfor
                       @endif

                       <li class="page-item{{ ($kgb->hasMorePages()) ? '' : ' disabled' }}">
                           <a class="page-link" href="{{ $kgb->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                       </li>
                   </ul>
                 </nav>
                        </div>
                  </div>
                </div>

            </div>
        </div>

@endsection
