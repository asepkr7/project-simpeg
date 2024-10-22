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
                        Edit
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Edit {{ $title }}</h4>
                    </div>
                    <div class="card-body col-md-12">
                        <form action="/petugas/pensiun/{{ $pensiun->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="pegawai_id">Pegawai</label>
                                    <select name="pegawai_id" id="pegawai_id" class="form-control select2 select2-hidden-accessible @error('pegawai_id') is-invalid @enderror">
                                        <option value="">-Pilih Pegawai-</option>
                                        @foreach($pegawai as $p)
                                        @if ( old('pegawai_id', $pensiun->pegawai_id) ==  $p->id)
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
                                        @php
                                            $jenis_pensiun = [
                                                'Pensiun BUP (Mencapai Batas Usia Pensiun',
                                                'Pensiun Janda/Duda/Anak',
                                                'Pensiun Atas Permintaan Sendiri',
                                                'Pensiun Uzur',
                                    ];
                                        @endphp
                                        <select name="jenis_pensiun" id="jenis_pensiun"  class="form-control select2 select2-hidden-accessible @error('jenis_pensiun') is-invalid @enderror">
                                             @foreach ($jenis_pensiun as $option)
                                    @if ($pensiun->jenis_pensiun == $option)
                                        <option selected value="{{ $option }}">{{ $option }}</option>
                                    @else
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endif
                                @endforeach
                                        </select>
                                        @error('jenis_pensiun')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-9">
                                    <label for="alasan">Alasan Pensiun</label>
                                    <input type="text" class="form-control @error('alasan') is-invalid @enderror" id="alasan" name="alasan"  required value="{{ old( 'alasan',  $pensiun->alasan) }}">
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
                                        <input type="date" class="form-control @error('tmt_pensiun') is-invalid @enderror" name="tmt_pensiun" id="tmt_pensiun" value="{{ old('tmt_pensiun', $pensiun->tmt_pensiun)}}">
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
                             <input type="text" class="form-control  @error('masa_kerja') is-invalid @enderror" name="masa_kerja" value="{{ old('masa_kerja', $pensiun->masa_kerja)}}">
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
                                        <input disabled type="text" class="form-control  @error('no_surat') is-invalid @enderror" name="no_surat" value="{{ old('no_surat',  $pensiun->no_surat) }}">
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
                                    <input type="text" class="form-control @error('alamat_pensiun') is-invalid @enderror" id="alamat_pensiun" name="alamat_pensiun"  required value="{{ old( 'alamat_pensiun',$pensiun->alamat_pensiun) }}">
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
