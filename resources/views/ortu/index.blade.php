@extends('template.main')
@section('container')
<div class="section">
            <div class="section-header">
                <h1>List Ortu &nbsp;</h1>
                <div class="section-header-back">
                    @if (Auth::user()->level == 'Petugas')
                    <a href="/petugas/data-ortu/create" class="btn btn-icon btn-primary" title="Add Data Ortu"><i class="fa fa-plus"></i></a>
                    @endif
                  </div>
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
                    <div class="breadcrumb-item active">
                        <a href="{{ $link.'dashboard' }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        Ortu
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
            <div class="section-body">
                <div class="card">
                  <div class="card-header">
                    <h4>Data {{ $title }}</h4>
                    <div class="card-header-action">
                           @if (Auth::user()->level == 'Petugas')
                            <form action="/petugas/data-ortu" method="get">
                        @elseif(Auth::user()->level == 'Pimpinan')
                            <form action="/pimpinan/data-ortu" method="get">
                                @else
                                <form action="/pegawai/data-ortu" method="get">
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
                <div class="card-body row ">
                    <div class="table-responsive"  >
                      <table class="table table-hover table-md">
                        <thead>
                            <tr>
                          <th scope="col">No</th>
                          <th scope="col">Pegawai</th>
                          <th scope="col">Nama</th>
                          <th scope="col">NIK</th>
                          <th scope="col">JK/TTL</th>
                          <th scope="col">Agama</th>
                          <th scope="col">Pendidikan</th>
                          <th scope="col">Pekerjaan</th>
                          <th scope="col">Status Ortu</th>
                          @if (Auth::user()->level == 'Petugas')
                          <th scope="col" width="10%" class="text">Action</th>
                          @endif
                        </tr>
                    </thead>
                        <tbody>
                        @foreach ($ortu as $key => $o)
                        <tr>
                            <td>{{ $ortu->firstItem() + $key }}</td>
                            <td>{{ $o->pegawai->nama }}</td>
                            <td>{{ $o->nama }}</td>
                            <td>{{ $o->nik }}</td>
                            <td>{{ $o->gender == 'l' ? 'Laki-Laki':'Perempuan' }}/{{ $o->tempat_lahir}} {{$o->tanggal_lahir  }}</td>
                            <td>{{ $o->agama }}</td>
                            <td>{{ $o->pendidikan }}</td>
                            <td>{{ $o->pekerjaan }}</td>
                            <td>{{ $o->status_ortu }}</td>
                            <td>
                                @if (Auth::user()->level == 'Petugas')
                                <div class="form-group row">
                                    <a href="/petugas/data-ortu/{{ $o->nik}}/edit" class="btn btn-icon btn-warning btn-sm mt-1"> <i class="fas fa-edit"></i></a>
                                    <form action="/petugas/data-ortu/{{ $o->nik}}" method="POST" class="align-content-center" id="del-{{$o->nik}}">
                                        @csrf
                                        @method('delete')
                                    <button class="btn btn-danger btn-icon btn-sm mt-1 ml-1" data-confirm="Hapus Data?|Apakah Anda yakin Ingin Menghapus Data <br> Nama : {{ $o->pegawai->nama }} <br> Nip : {{ $o->nik }} ?" data-confirm-yes="submitDel({{$o->nik}})">
                                    <i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                            @endif
                          </td>
                          </tr>
                            @endforeach
                      </tbody>
                    </table>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <div class="text-left">
                   <i> Showing {{ $ortu->firstItem() }} to {{ $ortu->lastItem() }} of {{ $ortu->total() }} Entires</i>
                  </div>
                  <nav class="pull-right d-lg-inline-block">
                   <ul class="pagination mb-0">
                       <li class="page-item{{ ($ortu->onFirstPage()) ? ' disabled' : '' }}">
                           <a class="page-link" href="{{ $ortu->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                       </li>

                       @if ($ortu->lastPage() > 1)
                           @for ($i = 1; $i <= $ortu->lastPage(); $i++)
                               <li class="page-item{{ ($ortu->currentPage() === $i) ? ' active' : '' }}">
                                   <a class="page-link" href="{{ $ortu->url($i) }}">{{ $i }}</a>
                               </li>
                           @endfor
                       @endif

                       <li class="page-item{{ ($ortu->hasMorePages()) ? '' : ' disabled' }}">
                           <a class="page-link" href="{{ $ortu->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                       </li>
                   </ul>
                 </nav>
                        </div>
                  </div>
                </div>

            </div>
        </div>

@endsection
