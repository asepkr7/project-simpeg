@extends('template.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/petugas/data-ortu" class="btn" title="Back"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h6 class="text-center  mt-2">Edit Data Orang Tua &nbsp;</h6>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="/petugas/dashboard">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="/petugas/data-ortu">Ortu</a>
                    </div>
                    <div class="breadcrumb-item">
                        Create
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Data Pasangan</h4>
                    </div>
                    <div class="card-body col-md-12">
                        <form action="/petugas/data-ortu" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="pegawai_id">Pegawai</label>
                                    <select name="pegawai_id" id="pegawai_id" class="form-control select2 select2-hidden-accessible @error('pegawai_id') is-invalid @enderror">
                                        <option value="">-Pilih Pegawai-</option>
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
                                        <label for="nama">Nama Ortu</label>
                                        <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama')  }}">
                                        @error('nama')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label for="nik">NIK</label>
                                        <input type="number" class="form-control  @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik')}}">
                                        @error('nik')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                             <label for="gender" class="d-block">Jenis Kelamin</label>
                             <div class="form-check form-check-inline">
                             <input type="radio" id="l" name="gender" {{ old('gender') == 'l' ? 'checked' : '' }} value="l" class="form-check-input">
                             <label for="l" class="form-check-label">Laki-Laki</label>
                              </div>
                              <div class="form-check form-check-inline">
                              <input type="radio" id="gender" name="gender" {{ old('gender') == 'p' ? 'checked' : '' }} value="p" class="form-check-input">
                              <label for="p" class="form-check-label">Perempuan</label>
                              </div>
                               @error('gender')
                            <div class="invalid-feedback d-block">
                              {{ $message }}
                            </div>
                              @enderror
                            </div>
                        </div>
                        <div class="form-group col-12 row">
                                    <div class="col-md-5 ml-1">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" class="form-control  @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                                        @error('tempat_lahir')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="tanggaL_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control  @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                 @error('tanggal_lahir')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="agama">Agama</label>
                                    <select name="agama" id="agama" class="form-control select2 select2-hidden-accessible @error('agama') is-invalid @enderror">
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                                        <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                     @error('agama')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="pendidikan">Pendidikan</label>
                                    <input type="text" class="form-control @error('pendidikan') is-invalid @enderror" id="pendidikan" name="pendidikan"  required value="{{ old( 'pendidikan') }}">
                                     @error('pendidikan')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan"  required value="{{ old( 'pekerjaan') }}">
                                     @error('pekerjaan')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="status_ortu">Status Ortu</label>
                                    <select name="status_ortu" id="status_ortu" class="form-control @error('status_ortu') is-invalid @enderror">
                                        <option value="">Pilih Status Ortu</option>
                                        <option value="Ayah Kandung" {{ old('status_ortu') == 'Ayah Kandung' ? 'selected' : '' }}>Ayah Kandung</option>
                                        <option value="Ibu Kandung" {{ old('status_ortu') == 'Ibu Kandung' ? 'selected' : '' }}>Ibu Kandung</option>
                                        <option value="Ayah Mertua" {{ old('status_ortu') == 'Ayah Mertua' ? 'selected' : '' }}>Ayah Mertua</option>
                                        <option value="Ibu Mertua" {{ old('status_ortu') == 'Ibu Mertua' ? 'selected' : '' }}>Ibu Mertua</option>
                                    </select>
                                     @error('status_ortu')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                            <div>
                                 <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> Simpan</button>
                      <button class="btn btn-secondary" type="reset"><i class="fa fa-recycle" aria-hidden="true"></i> Reset</button>
                       <a href="/petugas/data-ortu" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
