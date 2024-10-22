@extends('template.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/petugas/pendidikan" class="btn" title="Back"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h6 class="text-center  mt-2">Create Pendidikan &nbsp;</h6>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item {{Request::is('petugas/dashboard')  ? 'active' : ''}}">
                        <a href="/petugas/dashboard">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item {{Request::is('petugas/pendidikan')  ? 'active' : ''}}">
                        <a href="/petugas/pendidikan">Pendidikan</a>
                    </div>
                    <div class="breadcrumb-item">
                        Create
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Data Pendidikan</h4>
                    </div>
                    <div class="card-body col-md-12">
                        <form action="/petugas/pendidikan" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="pegawai_id">Pegawai</label>
                                    <select name="pegawai_id" id="pegawai_id" class="form-control select2 select2-hidden-accessible @error('pegawai_id') is-invalid @enderror">
                                        <option value="" >-Pilih Pegawai-</option>
                                        @foreach($pegawai as $p)
                                        @if ( old('pegawai_id') ==  $p->id)
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
                                        <label for="pendidikan">Nama Pendidikan</label>
                                        <input type="text" class="form-control @error('pendidikan') is-invalid @enderror" name="pendidikan" id="pendidikan" value="{{ old('pendidikan')}}">
                                        @error('pendidikan')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label for="jenjang">Jenjang Pendidikan</label>
                                        <select name="jenjang" id="jenjang"  class="form-control select2 select2-hidden-accessible @error('jenjang') is-invalid @enderror">
                                            <option value="">-Pilih  Jenjang Pendidikan-</option>
                                            <option {{ old('jenjang') =='SD/MI' ? 'selected' : '' }} value="SD/MI">SD/MI</option>
                                            <option {{ old('jenjang') =='SLTP' ? 'selected' : '' }} value="SLTP">SLTP</option>
                                            <option {{ old('jenjang') =='SLTA' ? 'selected' : '' }} value="SLTA">SLTA</option>
                                            <option {{ old('jenjang') =='D1' ? 'selected' : '' }} value="D1">D1</option>
                                            <option {{ old('jenjang') =='D2' ? 'selected' : '' }} value="D2">D2</option>
                                            <option {{ old('jenjang') =='D3' ? 'selected' : '' }} value="D3"> D3</option>
                                            <option {{ old('jenjang') =='D4/S1' ? 'selected' : '' }} value="D4/S1">D4/S1</option>
                                            <option {{ old('jenjang') =='S2' ? 'selected' : '' }} value="S2">S2</option>
                                            <option {{ old('jenjang') =='S3' ? 'selected' : '' }} value="S3">S3</option>
                                            <option {{ old('jenjang') =='Profesi' ? 'selected' : '' }} value="Profesi">Profesi</option>
                                        </select>
                                        @error('jenjang')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label for="lokasi">Lokasi</label>
                                        <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi" value="{{ old('lokasi')}}">
                                        @error('lokasi')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                             <label for="jurusan">Jurusan</label>
                             <input type="text" class="form-control  @error('jurusan') is-invalid @enderror" name="jurusan" value="{{ old('jurusan')}}">
                               @error('jurusan')
                            <div class="invalid-feedback d-block">
                              {{ $message }}
                            </div>
                              @enderror
                            </div>
                        </div>
                        <div class="form-group col-12 row">
                                    <div class="col-md-5 ml-1">
                                        <label for="no_ijazah">Nomor Ijazah</label>
                                        <input type="text" class="form-control  @error('no_ijazah') is-invalid @enderror" name="no_ijazah" value="{{ old('no_ijazah') }}">
                                        @error('no_ijazah')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="tanggal_ijazah">Tanggal Ijazah</label>
                                <input type="date" class="form-control  @error('tanggal_ijazah') is-invalid @enderror" name="tanggal_ijazah" id="tanggal_ijazah" value="{{ old('tanggal_ijazah') }}">
                                 @error('tanggal_ijazah')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="nama_pimpinan">Nama Kepsek / Rektor</label>
                                    <input type="text" class="form-control @error('nama_pimpinan') is-invalid @enderror" id="nama_pimpinan" name="nama_pimpinan"  required value="{{ old( 'nama_pimpinan') }}">
                                     @error('nama_pimpinan')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                                 <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> Simpan</button>
                      <button class="btn btn-secondary" type="reset"><i class="fa fa-recycle" aria-hidden="true"></i> Reset</button>
                      <a href="/petugas/pendidikan" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
