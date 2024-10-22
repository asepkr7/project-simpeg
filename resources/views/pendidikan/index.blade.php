@extends('template.main')
@section('container')
<div class="section">
            <div class="section-header">
                <h1>List Pendidikan &nbsp;</h1>
                @if (Auth::user()->level == 'Petugas')
                <div class="section-header-back">
                    <a href="/petugas/pendidikan/create" class="btn btn-icon btn-primary" title="Tambah Pendidikan">
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
                    <div class="breadcrumb-item  {{Request::is($link.'pendidikan')  ? 'active' : ''}}">
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
                            <form action="/petugas/pendidikan" method="get">
                        @elseif(Auth::user()->level == 'Pimpinan')
                            <form action="/pegawai/pendidikan" method="get">
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
                <div class="card-body row ">
                    <div class="table-responsive " >
                      <table class="table table-hover table-md  ">
                        <thead>
                            <tr>
                          <th scope="col">No</th>
                          <th scope="col">Pegawai</th>
                          <th scope="col">Nama Sekolah</th>
                          <th scope="col">Jenjang</th>
                          <th scope="col">Lokasi</th>
                          <th scope="col">No Ijazah</th>
                          <th scope="col">Tanggal Ijazah</th>
                          <th scope="col">Kepsek/Rektor</th>
                          <th scope="col">File Ijazah</th>
                          <th scope="col" class="text-center" width="10%">Action</th>
                        </tr>
                    </thead>
                        <tbody class="table-group-divider">
                        @foreach ($pendidikan as $key => $row)
                        <tr>
                            <td>{{ $pendidikan->firstItem() + $key }}</td>
                            <td>{{ $row->pegawai->nama }}</td>
                            <td>{{ $row->pendidikan }}</td>
                            <td>{{ $row->jenjang }}</td>
                            <td>{{ $row->lokasi }}</td>
                            <td>{{ $row->no_ijazah}}</td>
                            <td>{{ $row->tanggal_ijazah}}</td>
                            <td> {{ $row->nama_pimpinan }}</td>
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
                                @if(Auth::user()->level == 'Petugas')
                                        <div class="form-group row">
                                            <button class="btn btn-sm btn-primary mr-1" data-toggle="modal" data-target="#ModalUp{{ $row->id }}" ><i class="fas fa-upload"></i></button>
                                            <a href="/petugas/pendidikan/{{ $row->id }}/edit" class="btn btn-warning btn-sm "><i class="fa fa-edit" aria-hidden="true"></i></a>
                                            <form action="/petugas/pendidikan/{{ $row->id}}" method="post" class="align-content-center" id="del-{{ $row->id}}">
                                           @csrf
                                        @method('delete')
                                          <button class="btn btn-danger btn-sm mt-1 ml-3" data-confirm="Hapus Data?|Apakah Anda yakin Ingin Menghapus Data <br> Nama : {{ $row->pegawai->nama }} <br> Pangkat : {{ $row->pendidikan }} ?" data-confirm-yes="submitDel({{ $row->id}})">
                                          <i class="fas fa-trash"></i>
                                      </button>
                                          </form>
                                           @elseif(Auth::user()->level == 'Pegawai')
                                            <button class="btn btn-sm btn-primary ml-3" data-toggle="modal" data-target="#ModalUp{{ $row->id }}" ><i class="fas fa-upload"></i></button>
                                        </div>
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
                                                    @php
                                                        $lv = Auth::user()->level =='Petugas'  ? '/petugas' : '/pegawai'
                                                    @endphp
                                                    <form action="{{ $lv }}/pendidikan/{{ $row->id }}/upload" method="POST" enctype="multipart/form-data" class="modal-upload-form">
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
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <div class="text-left">
                   <i> Showing {{ $pendidikan->firstItem() }} to {{ $pendidikan->lastItem() }} of {{ $pendidikan->total() }} Entires</i>
                  </div>
                  <nav class="pull-right d-lg-inline-block">
                   <ul class="pagination mb-0">
                       <li class="page-item{{ ($pendidikan->onFirstPage()) ? ' disabled' : '' }}">
                           <a class="page-link" href="{{ $pendidikan->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                       </li>

                       @if ($pendidikan->lastPage() > 1)
                           @for ($i = 1; $i <= $pendidikan->lastPage(); $i++)
                               <li class="page-item{{ ($pendidikan->currentPage() === $i) ? ' active' : '' }}">
                                   <a class="page-link" href="{{ $pendidikan->url($i) }}">{{ $i }}</a>
                               </li>
                           @endfor
                       @endif

                       <li class="page-item{{ ($pendidikan->hasMorePages()) ? '' : ' disabled' }}">
                           <a class="page-link" href="{{ $pendidikan->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                       </li>
                   </ul>
                 </nav>
                        </div>
                  </div>
                </div>

            </div>
        </div>

@endsection
