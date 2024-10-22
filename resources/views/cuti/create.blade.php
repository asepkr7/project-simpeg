@extends('template.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ Auth::user()->level == 'Petugas' ? '/petugas/pengajuan-cuti' : '/pegawai/pengajuan-cuti' }}" class="btn" title="Back"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h6 class="text-center  mt-2">Ajukan Cuti &nbsp;</h6>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href='/pegawai/dashboard'>Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="/pegawai/pengajuan-cuti">Pengajuan Cuti</a>
                    </div>
                    <div class="breadcrumb-item active">
                        Create
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Data Cuti</h4>
                    </div>
                    <div class="card-body col-md-12">
                        <form action="{{ Auth::user()->level == 'Petugas' ? '/petugas/pengajuan-cuti/store' : '/pegawai/pengajuan-cuti/store' }}" method="POST" enctype="multipart/form-data">
                            @csrf
                         @if(Auth::user()->level == 'Petugas')
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
                            @else

                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="pegawai_id">Nama</label>
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
                            @endif
                                 <div class="form-group">
                                <div class="col-md-9">
                                    <label for="jenis_cuti">Jenis Cuti</label>
                                    <select name="jenis_cuti" id="jenis_cuti" class="form-control select2 select2-hidden-accessible @error('jenis_cuti') is-invalid @enderror">
                                        <option value="">Pilih Cuti</option>
                                        <option value="Cuti Tahunan" {{ old('jenis_cuti') == 'Cuti Tahunan' ? 'selected' : '' }}>Cuti Tahunan</option>
                                        <option value="Cuti Sakit" {{ old('jenis_cuti') == 'Cuti Sakit' ? 'selected' : '' }}>Cuti Sakit</option>
                                        <option value="Cuti Besar" {{ old('jenis_cuti') == 'Cuti Besar' ? 'selected' : '' }}>Cuti Besar</option>
                                        <option value="Cuti Melahirkan" {{ old('jenis_cuti') == 'Cuti Melahirkan' ? 'selected' : '' }}>Cuti Melahirkan</option>
                                        <option value="Cuti Karena Alasan Penting" {{ old('jenis_cuti') == 'Cuti Karena Alasan Penting' ? 'selected' : '' }}>Cuti Karena Alasan Penting</option>
                                        <option value="Cuti di Luar Tanggungan Negara" {{ old('jenis_cuti') == 'Cuti di Luar Tanggungan Negara' ? 'selected' : '' }}>Cuti di Luar Tanggungan Negara</option>
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
                                        <label for="alasan">Alasan</label>
                                        <input type="text" class="form-control  @error('alasan') is-invalid @enderror" name="alasan" value="{{ old('alasan') }}">
                                        @error('alasan')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                                    <div class="col-md-9">
                                        <label for="no_surat">Nomor</label>
                                        <input disabled type="text" class="form-control  @error('no_surat') is-invalid @enderror" name="no_surat" value="{{ $surat}}">
                                        @error('no_surat')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-12 row">
                                    <div class="col-md-5 ml-1">
                                        <label for="mulai">Mulai Cuti</label>
                                        <input type="date" class="form-control  @error('mulai') is-invalid @enderror" name="mulai" value="{{ old('mulai') }}">
                                        @error('mulai')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="selesai">Selesai Cuti</label>
                                <input type="date" class="form-control  @error('selesai') is-invalid @enderror" name="selesai" id="selesai" value="{{ old('selesai') }}">
                                 @error('selesai')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                            <div>
                                 <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> Save</button>
                      <button class="btn btn-secondary" type="reset"><i class="fa fa-recycle" aria-hidden="true"></i> Reset</button>
                       <a href="/pegawai/pengajuan-cuti" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
