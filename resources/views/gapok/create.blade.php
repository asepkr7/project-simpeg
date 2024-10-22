@extends('template.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/petugas/gapok" class="btn" title="Back"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h6 class="text-center  mt-2">Create Data {{ $title }} &nbsp;</h6>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item {{Request::is('petugas/dashboard')  ? 'active' : ''}}">
                        <a href="/petugas/dashboard">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item {{Request::is('petugas/gapok')  ? 'active' : ''}}">
                        <a href="/petugas/gapok">{{ $title }}</a>
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
                        <form action="/petugas/gapok" method="POST" enctype="multipart/form-data">
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
                            <div class="form-group col-12 row mt-3">
                                    <div class="col-md-5 ml-1">
                                        <label for="no_sk">Nomor SK</label>
                                        <input type="text" class="form-control  @error('no_sk') is-invalid @enderror" name="no_sk" value="{{ old('no_sk') }}">
                                        @error('no_sk')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="tanggal_sk">Tanggal SK</label>
                                <input type="date" class="form-control  @error('tanggal_sk') is-invalid @enderror" name="tanggal_sk" id="tanggal_sk" value="{{ old('tanggal_sk') }}">
                                 @error('tanggal_sk')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-9">
                                    <label for="jumlah_gapok">Jumlah Gapok</label>
                                    <input type="text" class="form-control @error('jumlah_gapok') is-invalid @enderror" name="jumlah_gapok" id="jumlah_gapok" value="{{ old('jumlah_gapok')}}">
                                    @error('jumlah_gapok')
                                    <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                        <div class="form-group">
                            <div class="col-md-9">
                             <label for="pejabat_sk">Pejabat SK</label>
                             <input type="text" class="form-control  @error('pejabat_sk') is-invalid @enderror" name="pejabat_sk" value="{{ old('pejabat_sk')}}">
                               @error('pejabat_sk')
                            <div class="invalid-feedback d-block">
                              {{ $message }}
                            </div>
                              @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                             <label for="tmt">TMT</label>
                             <input type="date" class="form-control  @error('tmt') is-invalid @enderror" name="tmt" value="{{ old('tmt')}}">
                               @error('tmt')
                            <div class="invalid-feedback d-block">
                              {{ $message }}
                            </div>
                              @enderror
                            </div>
                        </div>
                                 <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> Simpan</button>
                      <button class="btn btn-secondary" type="reset"><i class="fa fa-recycle" aria-hidden="true"></i> Reset</button>
                       <a href="/petugas/gapok" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
