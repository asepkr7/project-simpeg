@extends('template.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/pegawai/lampiran" class="btn" title="Back"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h6 class="text-center  mt-2">Create Data {{ $title }} &nbsp;</h6>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item {{Request::is('pegawai/dashboard')  ? 'active' : ''}}">
                        <a href="/pegawai/dashboard">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item {{Request::is('pegawai/lampiran')  ? 'active' : ''}}">
                        <a href="/pegawai/lampiran">{{ $title }}</a>
                    </div>
                    <div class="breadcrumb-item">
                        Create
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Data {{ $title }}</h4>
                    </div>
                    <div class="card-body col-md-12">
                        <form action="/pegawai/lampiran" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                <div class="col-md-9">
                                    <label for="pegawai_id">Pegawai</label>
                                    <select name="pegawai_id" id="pegawai_id" class="form-control select2 select2-hidden-accessible @error('pegawai_id') is-invalid @enderror">
                                        <option value="{{ auth()->user()->pegawai->id }}" selected >{{ auth()->user()->pegawai->nama }}</option>
                                    </select>
                                    @error('pegawai_id')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                                 <div class="form-group">
                                    <div class="col-md-9">
                                        <label for="nama">Nama Berkas</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama')}}">
                                        @error('nama')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                    <label for="file">File</label>
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
                                </div>
                        <div class="form-group ">
                                    <div class="col-md-9">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control  @error('keterangan') is-invalid @enderror" name="keterangan" value="{{ old('keterangan') }}">
                                        @error('keterangan')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                                 <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> Simpan</button>
                      <button class="btn btn-secondary" type="reset"><i class="fa fa-recycle" aria-hidden="true"></i> Reset</button>
                       <a href="/pegawai/lampiran" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
