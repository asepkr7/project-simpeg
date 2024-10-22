@extends('template.main')
@section('container')
<div class="section">
            <div class="section-header">
                <h1>List Anak &nbsp;</h1>
                <div class="section-header-back">
                    @if (Auth::user()->level == 'Petugas')
                    <a href="/petugas/data-anak/create" class="btn btn-icon btn-primary" title="Add Data Anak"><i class="fa fa-plus"></i></a>
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
                    <div class="breadcrumb-item ">
                        <a href="{{ $link.'dashboard' }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item active ">
                        Anak
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
                            <form action="/petugas/data-anak" method="get">
                        @elseif(Auth::user()->level == 'Pimpinan')
                            <form action="/pimpinan/data-anak" method="get">
                                @else
                                <form action="/pegawai/data-anak" method="get">
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
                <div class="card-body row">
                    <div class="table-responsive"  >
                      <table class="table table-hover table-md ">
                        <thead>
                            <tr>
                          <th scope="col">No</th>
                          <th scope="col">Pegawai</th>
                          <th scope="col">Nama</th>
                          <th scope="col">NIK</th>
                          <th scope="col">JK/TTL</th>
                          <th scope="col">Agama</th>
                          <th scope="col">Pendidikan</th>
                          <th scope="col">Status Anak</th>
                          @if (Auth::user()->level == 'Petugas')
                          <th scope="col" width="10%">Action</th>
                          @endif
                        </tr>
                    </thead>
                        <tbody class="table-group-divider">
                        @foreach ($anak as $key => $a)
                        <tr>
                            <td>{{ $anak->firstItem() + $key }}</td>
                            <td>{{ $a->pegawai->nama }}</td>
                            <td>{{ $a->nama }}</td>
                            <td>{{ $a->nik }}</td>
                            <td>{{ $a->gender == 'l' ? 'Laki-Laki':'Perempuan' }}/{{ $a->tempat_lahir}} {{$a->tanggal_lahir  }}</td>
                            <td>{{ $a->agama }}</td>
                            <td>{{ $a->pendidikan }}</td>
                            <td>{{ $a->status_anak }}</td>
                            <td>
                                @if (Auth::user()->level == 'Petugas')

                                <div class="form-group row">
                                    <a href="/petugas/data-anak/{{ $a->nik}}/edit" class="btn btn-warning btn-sm mt-1 "> <i class="fas fa-edit"></i></a>
                                    <form action="/petugas/data-anak/{{ $a->nik}}" method="POST" class="align-content-center" id="del-{{$a->nik}}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm mt-1 ml-1" data-confirm="Hapus Data?|Apakah Anda yakin Ingin Menghapus Data <br> Nama : {{ $a->pegawai->nama }} <br> Nip : {{ $a->nik }} ?" data-confirm-yes="submitDel({{$a->nik}})">
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
                   <i> Showing {{ $anak->firstItem() }} to {{ $anak->lastItem() }} of {{ $anak->total() }} Entires</i>
                  </div>
                  <nav class="pull-right d-lg-inline-block">
                   <ul class="pagination mb-0">
                       <li class="page-item{{ ($anak->onFirstPage()) ? ' disabled' : '' }}">
                           <a class="page-link" href="{{ $anak->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                       </li>

                       @if ($anak->lastPage() > 1)
                           @for ($i = 1; $i <= $anak->lastPage(); $i++)
                               <li class="page-item{{ ($anak->currentPage() === $i) ? ' active' : '' }}">
                                   <a class="page-link" href="{{ $anak->url($i) }}">{{ $i }}</a>
                               </li>
                           @endfor
                       @endif

                       <li class="page-item{{ ($anak->hasMorePages()) ? '' : ' disabled' }}">
                           <a class="page-link" href="{{ $anak->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                       </li>
                   </ul>
                 </nav>
                        </div>
                  </div>
                </div>

            </div>
        </div>

@endsection
