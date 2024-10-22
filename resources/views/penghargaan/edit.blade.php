@extends('template.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/petugas/penghargaan" class="btn" title="Back"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h6 class="text-center  mt-2">Edit Data {{ $title }} &nbsp;</h6>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="/petugas/dashboard">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="/petugas/penghargaan">{{ $title }}</a>
                    </div>
                    <div class="breadcrumb-item">
                        Edit
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Data {{ $title }}</h4>
                    </div>
                    <div class="card-body col-md-12">
                        <form action="/petugas/penghargaan/{{ $penghargaan->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="pegawai_id">Pegawai</label>
                                    <select name="pegawai_id" id="pegawai_id" class="form-control select2 select2-hidden-accessible @error('pegawai_id') is-invalid @enderror">
                                        <option value="">-Pilih Pegawai-</option>
                                        @foreach($pegawai as $p)
                                        @if ( old('pegawai_id', $penghargaan->pegawai_id) ==  $p->id)
                                        <option value="{{ $p->id }}" selected>{{ $p->nama }}</option>
                                        @endif
                                        <option value="{{ $p->id }}" >{{ $p->nama }}</option>
                                        @endforeach
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
                                        <label for="penghargaan">Nama Penghargaan</label>
                                        <input type="text" class="form-control @error('penghargaan') is-invalid @enderror" name="penghargaan" id="penghargaan" value="{{ old('penghargaan', $penghargaan->penghargaan)}}">
                                        @error('penghargaan')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label for="tingkat_kegiatan">Tingkat Kegiatan</label>
                                        <input type="text" class="form-control @error('tingkat_kegiatan') is-invalid @enderror" name="tingkat_kegiatan" id="tingkat_kegiatan" value="{{ old('tingkat_kegiatan', $penghargaan->tingkat_kegiatan)}}">
                                        @error('tingkat_kegiatan')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-12 row">
                                    <div class="col-md-5 ml-1">
                                        <label for="tempat">Tempat</label>
                                        <input type="text" class="form-control  @error('tempat') is-invalid @enderror" name="tempat" value="{{ old('tempat', $penghargaan->tempat) }}">
                                        @error('tempat')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control  @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" value="{{ old('tanggal', $penghargaan->tanggal) }}">
                                 @error('tanggal')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                             <label for="tahun_penghargaan">Tahun</label>
                             <input type="text" class="form-control  @error('tahun_penghargaan') is-invalid @enderror" name="tahun_penghargaan" value="{{ old('tahun_penghargaan', $penghargaan->tahun_penghargaan)}}">
                               @error('tahun_penghargaan')
                            <div class="invalid-feedback d-block">
                              {{ $message }}
                            </div>
                              @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                             <label for="no_sertifikat">No Sertifikat</label>
                             <input type="text" class="form-control  @error('no_sertifikat') is-invalid @enderror" name="no_sertifikat" value="{{ old('no_sertifikat', $penghargaan->no_sertifikat)}}">
                               @error('no_sertifikat')
                            <div class="invalid-feedback d-block">
                              {{ $message }}
                            </div>
                              @enderror
                            </div>
                        </div>
                            <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> Save</button>
                                <button class="btn btn-secondary" type="reset"><i class="fa fa-recycle" aria-hidden="true"></i> Reset</button>
                                 <a href="/petugas/penghargaan" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
