@extends('template.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/petugas/pensiun" class="btn" title="Back"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h6 class="text-center  mt-2">Create {{ $title }} &nbsp;</h6>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item {{Request::is('petugas/dashboard')  ? 'active' : ''}}">
                        <a href="/petugas/dashboard">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item {{Request::is('petugas/pensiun')  ? 'active' : ''}}">
                        <a href="/petugas/pensiun">{{ $title }}</a>
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
                        <form action="/petugas/pensiun" method="POST" enctype="multipart/form-data">
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
                                        <label for="jenis_pensiun">Jenis Pensiun </label>
                                        <select name="jenis_pensiun" id="jenis_pensiun"  class="form-control select2 select2-hidden-accessible @error('jenis_pensiun') is-invalid @enderror">
                                            <option value="">-Pilih  Jenis Pensiun -</option>
                                            <option {{ old('jenis_pensiun') =='Pensiun BUP (Mencapai Batas Usia Pensiun)' ? 'selected' : '' }} value="Pensiun BUP (Mencapai Batas Usia Pensiun)">Pensiun BUP (Mencapai Batas Usia Pensiun)</option>
                                            <option {{ old('jenis_pensiun') =='Pensiun Janda/Duda/Anak' ? 'selected' : '' }} value="Pensiun Janda/Duda/Anak">Pensiun Janda/Duda/Anak</option>
                                            <option {{ old('jenis_pensiun') =='Pensiun Atas Permintaan Sendiri' ? 'selected' : '' }} value="Pensiun Atas Permintaan Sendiri">Pensiun Atas Permintaan Sendiri</option>
                                            <option {{ old('jenis_pensiun') =='Pensiun Uzur' ? 'selected' : '' }} value="Pensiun Uzur">Pensiun Uzur</option>
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
                                    <label for="alasan">Alasan Pensiun</label>
                                    <input type="text" class="form-control @error('alasan') is-invalid @enderror" id="alasan" name="alasan"  required value="{{ old( 'alasan') }}">
                                     @error('alasan')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label for="tmt_pensiun">TMT Pensiun</label>
                                        <input type="date" class="form-control @error('tmt_pensiun') is-invalid @enderror" name="tmt_pensiun" id="tmt_pensiun" value="{{ old('tmt_pensiun')}}">
                                        @error('tmt_pensiun')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                             <label for="masa_kerja">Masa Kerja</label>
                             <input type="text" class="form-control  @error('masa_kerja') is-invalid @enderror" name="masa_kerja" value="{{ old('masa_kerja')}}">
                               @error('masa_kerja')
                            <div class="invalid-feedback d-block">
                              {{ $message }}
                            </div>
                              @enderror
                            </div>
                        </div>
                        <div class="form-group">
                                    <div class="col-md-9">
                                        <label for="no_surat">No Surat</label>
                                        <input disabled type="text" class="form-control  @error('no_surat') is-invalid @enderror" name="no_surat" value="{{ $surat }}">
                                        @error('no_surat')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="alamat_pensiun">Alamat Pensiun</label>
                                    <input type="text" class="form-control @error('alamat_pensiun') is-invalid @enderror" id="alamat_pensiun" name="alamat_pensiun"  required value="{{ old( 'alamat_pensiun') }}">
                                     @error('alamat_pensiun')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                                 <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> Simpan</button>
                                 <button class="btn btn-secondary" type="reset"><i class="fa fa-recycle" aria-hidden="true"></i> Reset</button>
                                  <a href="/petugas/pensiun" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
