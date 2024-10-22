@extends('template.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/petugas/diklat" class="btn" title="Back"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h6 class="text-center  mt-2">Edit Data Diklat &nbsp;</h6>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="/petugas/dashboard">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="/petugas/diklat">Diklat</a>
                    </div>
                    <div class="breadcrumb-item">
                        Edit
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Data Diklat</h4>
                    </div>
                    <div class="card-body col-md-12">
                        <form action="/petugas/diklat/{{ $diklat->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="pegawai_id">Pegawai</label>
                                    <select name="pegawai_id" id="pegawai_id" class="form-control select2 select2-hidden-accessible @error('pegawai_id') is-invalid @enderror">
                                        <option value="">-Pilih Pegawai-</option>
                                        @foreach($pegawai as $p)
                                        @if ( old('pegawai_id', $diklat->pegawai_id) ==  $p->id)
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
                                        <label for="diklat">Nama Diklat</label>
                                        <input type="text" class="form-control  @error('diklat') is-invalid @enderror" name="diklat" value="{{ old('diklat', $diklat->diklat) }}">
                                        @error('diklat')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label for="jumlah_jam">Jumlah Jam</label>
                                        <input type="number" class="form-control  @error('jumlah_jam') is-invalid @enderror" name="jumlah_jam" value="{{ old('jumlah_jam',$diklat->jumlah_jam) }}">
                                        @error('jumlah_jam')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label for="penyelenggara">Penyelenggara</label>
                                        <input type="text" class="form-control  @error('penyelenggara') is-invalid @enderror" name="penyelenggara" value="{{ old('penyelenggara',$diklat->penyelenggara) }}">
                                        @error('penyelenggara')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                                        <label for="tempat">Tempat</label>
                                        <input type="text" class="form-control  @error('tempat') is-invalid @enderror" name="tempat" value="{{ old('tempat',$diklat->tempat) }}">
                                        @error('tempat')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                                        <label for="angkatan">Angkatan</label>
                                        <input type="text" class="form-control  @error('angkatan') is-invalid @enderror" name="angkatan" value="{{ old('angkatan',$diklat->angkatan) }}">
                                        @error('angkatan')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                                        <label for="tahun">Tahun</label>
                                        <input type="text" class="form-control  @error('tahun') is-invalid @enderror" name="tahun" value="{{ old('tahun',$diklat->tahun) }}">
                                        @error('tahun')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group col-12 row">
                                    <div class="col-md-5 ml-1">
                                        <label for="no_sttpp">No STTPP</label>
                                        <input type="text" class="form-control  @error('no_sttpp') is-invalid @enderror" name="no_sttpp" value="{{ old('no_sttpp', $diklat->no_sttpp) }}">
                                        @error('no_sttpp')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="tanggal_sttpp">Tanggal STTPP</label>
                                <input type="date" class="form-control  @error('tanggal_sttpp') is-invalid @enderror" name="tanggal_sttpp" id="tanggal_sttpp" value="{{ old('tanggal_sttpp', $diklat->tanggal_sttpp) }}">
                                 @error('tanggal_sttpp')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                            <div>
                                 <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> Save</button>
                                <button class="btn btn-secondary" type="reset"><i class="fa fa-recycle" aria-hidden="true"></i> Reset</button>
                                 <a href="/petugas/diklat" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
