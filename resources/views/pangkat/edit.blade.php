@extends('template.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/petugas/pangkat" class="btn" title="Back"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h6 class="text-center  mt-2">Create Pangkat &nbsp;</h6>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item {{Request::is('petugas/dashboard')  ? 'active' : ''}}">
                        <a href="/petugas/dashboard">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item {{Request::is('petugas/pangkat')  ? 'active' : ''}}">
                        <a href="/petugas/pangkat">Pangkat</a>
                    </div>
                    <div class="breadcrumb-item">
                        Edit
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Edit Pangkat</h4>
                    </div>
                    <div class="card-body col-md-12">
                        <form action="/petugas/pangkat/{{ $pangkat->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="pegawai_id">Pegawai</label>
                                    <select name="pegawai_id" id="pegawai_id" class="form-control select2 select2-hidden-accessible @error('pegawai_id') is-invalid @enderror">
                                        <option value="">-Pilih Pegawai-</option>
                                        @foreach($pegawai as $p)
                                        @if ( old('pegawai_id', $pangkat->pegawai_id) ==  $p->id)
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
                                        <label for="pangkat">Pangkat</label>
                                        @php
                                            $pn = [
                                                'Pembina Utama',
                                                'Pembina Utama Madya',
                                                'Pembina Tingkat I',
                                                'Pembina',
                                                'Penata Tingkat I',
                                                'Penata',
                                                'Penata Muda',
                                                'Penata Muda Tingkat I',
                                                'Pengatur Tingkat I',
                                                'Pengatur',
                                                'Pengatur Muda Tingkat I',
                                                'Pengatur Muda',
                                                'Juru Tingkat I',
                                                'Juru',
                                                'Juru Muda Tingkat I',
                                                'Juru Muda'
                                    ];
                                        @endphp
                                        <select name="pangkat" id="pangkat"  class="form-control select2 select2-hidden-accessible @error('pangkat') is-invalid @enderror">
                                           <option value="">-Pilih Jenis Pangkat-</option>
                                        @foreach ($pn as $option)
                                    @if ($pangkat->pangkat == $option)
                                        <option selected value="{{ $option }}">{{ $option }}</option>
                                    @else
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endif
                                @endforeach
                                        </select>
                                        @error('pangkat')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label for="golongan">Golongan</label>
                                        @php
                                            $gol = [
                                            'IV E',
                                            'IV D',
                                            'IV C',
                                            'IV B',
                                            'IV A',
                                            'III D',
                                            'III C',
                                            'III B',
                                            'III A',
                                            'II D',
                                            'II C',
                                            'II B',
                                            'II A',
                                            'I D',
                                            'I C',
                                            'I B',
                                            'I A'
                                    ];
                                        @endphp
                                        <select name="golongan" id="golongan" class="form-control select2 select2-hidden-accessible @error('golongan') is-invalid @enderror">
                                        <option value="">-Pilih Jenis Golongan-</option>
                                        @foreach ($gol as $option)
                                    @if ($pangkat->golongan == $option)
                                        <option selected value="{{ $option }}">{{ $option }}</option>
                                    @else
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endif
                                @endforeach
                                        </select>
                                        @error('golongan')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                             <label for="jenis_pangkat">Jenis Pangkat</label>
                             <input type="text" class="form-control  @error('jenis_pangkat') is-invalid @enderror" name="jenis_pangkat" value="{{ old('jenis_pangkat',  $pangkat->jenis_pangkat )}}">
                               @error('jenis_pangkat')
                            <div class="invalid-feedback d-block">
                              {{ $message }}
                            </div>
                              @enderror
                            </div>
                        </div>
                        <div class="form-group">
                                    <div class="col-md-9">
                                        <label for="tmt_pangkat">TMT Pangkat</label>
                                        <input type="date" class="form-control  @error('tmt_pangkat') is-invalid @enderror" name="tmt_pangkat" value="{{ old('tmt_pangkat', $pangkat->tmt_pangkat) }}">
                                        @error('tmt_pangkat')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group col-12 row">
                                    <div class="col-md-5 ml-1">
                                        <label for="no_sk">Nomor SK</label>
                                        <input type="text" class="form-control  @error('no_sk') is-invalid @enderror" name="no_sk" value="{{ old('no_sk',$pangkat->no_sk) }}">
                                        @error('no_sk')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="tanggal_sk">Tanggal SK</label>
                                <input type="date" class="form-control  @error('tanggal_sk') is-invalid @enderror" name="tanggal_sk" id="tanggal_sk" value="{{ old('tanggal_sk', $pangkat->tanggal_sk) }}">
                                 @error('tanggal_sk')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="pejabat_sk">Pejabat Pengesah</label>
                                    <input type="text" class="form-control @error('pejabat_sk') is-invalid @enderror" id="pejabat_sk" name="pejabat_sk"  required value="{{ old( 'pejabat_sk', $pangkat->pejabat_sk) }}">
                                     @error('pejabat_sk')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                                 <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> Simpan</button>
                      <button class="btn btn-secondary" type="reset"><i class="fa fa-recycle" aria-hidden="true"></i> Reset</button>
                      <a href="/petugas/pangkat" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
