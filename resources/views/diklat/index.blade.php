@extends('template.main')
@section('container')
<div class="section">
            <div class="section-header">
                <h1>List Diklat &nbsp;</h1>
                @if (Auth::user()->level == 'Petugas')
                <div class="section-header-back">
                    <a href="/petugas/diklat/create" class="btn btn-icon btn-primary" title="Tambah Diklat">
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
                    <div class="breadcrumb-item  {{Request::is($link.'diklat')  ? 'active' : ''}}">
                        Diklat
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
                            <form action="/petugas/diklat" method="get">
                        @elseif(Auth::user()->level == 'Pimpinan')
                            <form action="/pimpinan/diklat" method="get">
                                @else
                                <form action="/pegawai/diklat" method="get">
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
                      <table class="table table-hover table-resvonsive table-lg ">
                        <thead>
                            <tr>
                          <th scope="col">No</th>
                          <th scope="col">Pegawai</th>
                          <th scope="col">Nama Diklat</th>
                          <th scope="col">Jumlah Jam</th>
                          <th scope="col">Penyelanggara</th>
                          <th scope="col">Tahun</th>
                          <th scope="col">No STTPP</th>
                          <th scope="col">Berkas</th>
                          @if (Auth::user()->level == 'Petugas' || Auth::user()->level == 'Pegawai')
                        <th scope="col" class="text-center" width="10%">Action</th>
                        @endif
                        </tr>
                    </thead>
                        <tbody class="table-group-divider">
                        @foreach ($diklat as $key => $row)
                        <tr>
                            <td>{{ $diklat->firstItem() + $key }}</td>
                            <td>{{ $row->pegawai->nama }}</td>
                            <td>{{ $row->diklat }}</td>
                            <td>{{ $row->jumlah_jam}}</td>
                            <td>{{ $row->penyelenggara }}</td>
                            <td>{{ $row->tahun }}</td>
                            <td>{{ $row->no_sttpp }}</td>
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
                             <td>
                                 <div class="form-group row mt-3">
                                @if(Auth::user()->level == 'Petugas')
                                           <button class="btn btn-sm btn-primary mr-1" data-toggle="modal" data-target="#ModalUp{{ $row->id }}" ><i class="fas fa-upload"></i></button>
                                             <a href="/petugas/diklat/{{ $row->id }}/edit" class="btn btn-warning btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                             <form action="/petugas/diklat/{{ $row->id}}" method="post" class="align-content-center" id="del-{{ $row->id}}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm mt-1 ml-3" data-confirm="Hapus Data?|Apakah Anda yakin Ingin Menghapus Data <br> Nama : {{ $row->pegawai->nama }} <br> Diklat : {{ $row->diklat }} ?" data-confirm-yes="submitDel({{ $row->id}})">
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
                          <div class="modal fade" tabindex="-1" role="dialog" id="ModalUp{{ $row->id }}" aria-hidden="true" style="display: none;">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title">Upload</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">×</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <form action="/petugas/diklat/{{ $row->id }}/upload" method="POST" enctype="multipart/form-data" class="modal-upload-form">
                                                        @csrf
                                                        @method('put')
                                                        <div class="form-group">
                                                           <label for="file">Upload Sertifikat</label>
                                                           <div class="input-group">
                                                             <div class="input-group-prepend">
                                                               <div class="input-group-text">
                                                                 <i class="fas fa-file"></i>
                                                               </div>
                                                             </div>
                                                             <input type="file" class="form-control  @error('file') is-invalid @enderror" name="file" id="file" oldautocomplete="remove" autocomplete="off">
                                                             @error('file')
                                                             <div class="invalid-feedback">
                                                               {{ $message }}
                                                             </div>
                                                             @enderror
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-whitesmoke br">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Upload</button>
                                                        </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                            @endforeach
                      </tbody>
                    </table>
                    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                               <div class="modal-dialog">
                                                 <div class="modal-content">
                                                   <div class="modal-header">
                                                     <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Dokumen</h1>
                                                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                   </div>
                                                   <div class="modal-body">
                                                     <form action="/petugas/diklat/upload" method="post">
                                                        @csrf
                                                       <div class="form-group">
                                                         <label for="file">Lampiran</label>
                                                         <input type="file" class="form-control" id="file" name="file">
                                                       </div>
                                                   </div>
                                                   <div class="modal-footer">
                                                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                     <button type="submit" name="dataset" class="btn btn-primary">Save changes</button>
                                                   </div>
                                                   </form>
                                                 </div>
                                               </div>
                                             </div>
                  </div> --}}

                  <div class="card-footer text-right">
                    <div class="text-left">
                   <i> Showing {{ $diklat->firstItem() }} to {{ $diklat->lastItem() }} of {{ $diklat->total() }} Entires</i>
                  </div>
                  <nav class="pull-right d-lg-inline-block">
                   <ul class="pagination mb-0">
                       <li class="page-item{{ ($diklat->onFirstPage()) ? ' disabled' : '' }}">
                           <a class="page-link" href="{{ $diklat->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                       </li>

                       @if ($diklat->lastPage() > 1)
                           @for ($i = 1; $i <= $diklat->lastPage(); $i++)
                               <li class="page-item{{ ($diklat->currentPage() === $i) ? ' active' : '' }}">
                                   <a class="page-link" href="{{ $diklat->url($i) }}">{{ $i }}</a>
                               </li>
                           @endfor
                       @endif

                       <li class="page-item{{ ($diklat->hasMorePages()) ? '' : ' disabled' }}">
                           <a class="page-link" href="{{ $diklat->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                       </li>
                   </ul>
                 </nav>
                        </div>
                  </div>
                </div>

            </div>
        </div>

@endsection
