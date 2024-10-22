@extends('template.main')
@section('container')
<div class="section">
            <div class="section-header">
                <h1>List Pasangan &nbsp;</h1>
                <div class="section-header-back">
                    @if (Auth::user()->level == 'Petugas')
                    <a href="/petugas/data-pasangan/create" class="btn btn-icon btn-primary" title="Add Data Pasangan"><i class="fa fa-plus"></i></a>
                    @endif
                  </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="">Pasangan</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="">List</a>
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
                            <form action="/petugas/data-pasangan" method="get">
                        @elseif(Auth::user()->level == 'Pimpinan')
                            <form action="/pimpinan/data-pasangan" method="get">
                                @else
                                <form action="/pegawai/data-pasangan" method="get">
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
                          <th scope="col">Pekerjaan</th>
                          <th scope="col">Status Pasangan</th>
                          @if (Auth::user()->level == 'Petugas')
                          <th scope="col" width="10%" class="text">Action</th>
                          @endif
                        </tr>
                    </thead>
                        <tbody>
                        @foreach ($pasangan as $key => $p)
                        <tr>
                            <td>{{ $pasangan->firstItem() + $key }}</td>
                            <td>{{ $p->pegawai->nama }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->nik }}</td>
                            <td>{{ $p->gender == 'l' ? 'Laki-Laki':'Perempuan' }}/{{ $p->tempat_lahir}} {{$p->tanggal_lahir  }}</td>
                            <td>{{ $p->agama }}</td>
                            <td>{{ $p->pendidikan }}</td>
                            <td>{{ $p->pekerjaan }}</td>
                            <td>{{ $p->status_pasangan }}</td>
                            <td>
                                @if (Auth::user()->level == 'Petugas')
                                <div class="form-group row">
                                    <a href="/petugas/data-pasangan/{{ $p->nik}}/edit" class="btn btn-warning btn-sm mt-1"> <i class="fas fa-edit"></i></a>
                                    <form action="/petugas/data-pasangan/{{ $p->nik}}" method="POST" class="align-content-center" id="del-{{$p->nik}}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm mt-1 ml-1" data-confirm="Hapus Data?|Apakah Anda yakin Ingin Menghapus Data <br> Nama : {{ $p->pegawai->nama }} <br> Nip : {{ $p->nik }} ?" data-confirm-yes="submitDel({{$p->nik}})">
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
                   <i> Showing {{ $pasangan->firstItem() }} to {{ $pasangan->lastItem() }} of {{ $pasangan->total() }} Entires</i>
                  </div>
                  <nav class="pull-right d-lg-inline-block">
                   <ul class="pagination mb-0">
                       <li class="page-item{{ ($pasangan->onFirstPage()) ? ' disabled' : '' }}">
                           <a class="page-link" href="{{ $pasangan->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                       </li>

                       @if ($pasangan->lastPage() > 1)
                           @for ($i = 1; $i <= $pasangan->lastPage(); $i++)
                               <li class="page-item{{ ($pasangan->currentPage() === $i) ? ' active' : '' }}">
                                   <a class="page-link" href="{{ $pasangan->url($i) }}">{{ $i }}</a>
                               </li>
                           @endfor
                       @endif

                       <li class="page-item{{ ($pasangan->hasMorePages()) ? '' : ' disabled' }}">
                           <a class="page-link" href="{{ $pasangan->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                       </li>
                   </ul>
                 </nav>
                        </div>
                  </div>
                </div>

            </div>
        </div>

@endsection
