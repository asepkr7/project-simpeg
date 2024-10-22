@extends('template.main')
@section('container')
<div class="section">
            <div class="section-header">
                <h1>List {{ $title }} &nbsp;</h1>
                @if (Auth::user()->level == 'Pegawai')
                <div class="section-header-back">
                    <a href="/pegawai/lampiran/create" class="btn btn-icon btn-primary" title="Tambah {{ $title }}">
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
                    <div class="breadcrumb-item  {{Request::is($link.'lampiran')  ? 'active' : ''}}">
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
                            <form action="/petugas/lampiran" method="get">
                        @elseif(Auth::user()->level == 'Pimpinan')
                            <form action="/pimpinan/lampiran" method="get">
                                @else
                                <form action="/pegawai/lampiran" method="get">
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
                      <table class="table table-hover table-md ">
                        <thead>
                            <tr>
                          <th scope="col">No</th>
                          @if (Auth::user()->level == 'Petugas')
                          <th scope="col">Pegawai</th>
                          @endif
                          <th scope="col">Nama Berkas</th>
                          <th scope="col">Berkas</th>
                          <th scope="col">Keterangan</th>
                          <th scope="col">Waktu</th>
                          @if (Auth::user()->level == 'Pegawai')
                        <th scope="col" class="text-center" width="10%">Action</th>
                        @endif
                        </tr>
                    </thead>
                        <tbody class="table-group-divider">
                        @foreach ($lampiran as $key => $row)
                        <tr>
                            <td>{{ $lampiran->firstItem() + $key }}</td>
                            @if (Auth::user()->level == 'Petugas')
                            <td>{{ $row->pegawai->nama }}</td>
                            @endif
                            <td>{{ $row->nama }}</td>
                           <td>
                               @if ($row->file)
                                @php
                                    $fileUrl = asset('storage/'.$row->file);
                                    $fileExtension = pathinfo($fileUrl, PATHINFO_EXTENSION);
                                    $modalId = 'fileViewerModal_' . $row->id;
                                    $iframeId = 'fileViewer_' . $row->id;
                                @endphp

                                @if ($fileExtension === 'pdf')
                                    <button type="button" class="btn btn-primary open-file-modal" data-toggle="modal" data-target="#{{ $modalId }}">Lihat File</button>
                                @elseif (in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx']))
                                    <a href="{{ $fileUrl }}" class="btn btn-primary" target="_blank">Lihat File</a>
                                @else
                                    <span>Belum ada file.</span>
                                @endif

                                <!-- Modal untuk Menampilkan File -->
                                <div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <div class="modal-body">
                                                <iframe id="{{ $iframeId }}" src="{{ asset('pdfjs/web/viewer.html') }}?file={{ $fileUrl }}" width="100%" height="600px"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <span>Belum ada file</span>
                            @endif
                           </td>
                            <td>{{ $row->keterangan}}</td>
                            <td>{{ $row->waktu }}</td>

                             <td>
                                 <div class="form-group row mt-3">
                                @if(Auth::user()->level == 'Pegawai')
                                             <a href="/pegawai/lampiran/{{ $row->id }}/edit" class="btn btn-warning  btn-sm mt-1"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                             <form action="/pegawai/lampiran/{{ $row->id}}" method="post" class="align-content-center" id="del-{{ $row->id}}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm mt-1 ml-1" data-confirm="Hapus Data?|Apakah Anda yakin Ingin Menghapus Data <br> Nama : {{ $row->pegawai->nama }} <br> Berkas : {{ $row->nama }} ?" data-confirm-yes="submitDel({{ $row->id}})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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
                   <i> Showing {{ $lampiran->firstItem() }} to {{ $lampiran->lastItem() }} of {{ $lampiran->total() }} Entires</i>
                  </div>
                  <nav class="pull-right d-lg-inline-block">
                   <ul class="pagination mb-0">
                       <li class="page-item{{ ($lampiran->onFirstPage()) ? ' disabled' : '' }}">
                           <a class="page-link" href="{{ $lampiran->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                       </li>

                       @if ($lampiran->lastPage() > 1)
                           @for ($i = 1; $i <= $lampiran->lastPage(); $i++)
                               <li class="page-item{{ ($lampiran->currentPage() === $i) ? ' active' : '' }}">
                                   <a class="page-link" href="{{ $lampiran->url($i) }}">{{ $i }}</a>
                               </li>
                           @endfor
                       @endif

                       <li class="page-item{{ ($lampiran->hasMorePages()) ? '' : ' disabled' }}">
                           <a class="page-link" href="{{ $lampiran->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                       </li>
                   </ul>
                 </nav>
                        </div>
                  </div>
                </div>

            </div>
        </div>

@endsection
