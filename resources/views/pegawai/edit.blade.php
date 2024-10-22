@extends('template.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/petugas/datapegawai" class="btn" title="Back"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h6 class="text-center  mt-2">Edit Data Pegawai &nbsp;</h6>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item {{ Request::is('petugas/dashboard') ? 'active' : '' }}">
                        <a href="/petugas/dashboard">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item {{ Request::is('petugas/data-pegawai') ? 'active' : '' }}">
                       <a href="/petugas/data-pegawai">Pegawai</a>
                    </div>
                    <div class="breadcrumb-item">
                        Edit
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Data Pegawai</h4>
                    </div>
                    <div class="card-body col-md-12">
                        <form action="/petugas/data-pegawai/{{ $data_pegawai->nip }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="nama">Nama</label>
                                    <input type="text" id="nama" name="nama" class="form-control  @error('nama') is-invalid @enderror" required value="{{ old('nama', $data_pegawai->nama ) }}">
                                  @error('nama')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col md-6">
                                    <label for="nip" id="nip">Nip</label>
                                    <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" id="nip" value="{{ old('nip',$data_pegawai->nip) }}">
                                    @error('nip')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="gelar_depan">Gelar Depan</label>
                                    <input type="text" id="gelar_depan" name="gelar_depan" class="form-control @error('gelar_depan') is-invalid @enderror" value="{{ old('gelar_depan',$data_pegawai->gelar_depan) }}">
                                    @error('gelar_depan')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col md-6">
                                    <label for="gelar_belakang" id="nip">Gelar Belakang</label>
                                    <input type="text" class="form-control @error('gelar_belakang') is-invalid @enderror" name="gelar_belakang" id="gelar_belakang" value="{{ old('gelar_belakang',$data_pegawai->gelar_belakang) }}">
                                    @error('gelar_belakang')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="tempat_lahir">Tempat</label>
                                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control  @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir', $data_pegawai->tempat_lahir) }}">
                                    @error('tempat_lahir')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col md-6">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control  @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir', $data_pegawai->tanggal_lahir) }}">
                                    @error('tanggal_lahir')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="gender" class="d-block">Jenis Kelamin</label>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="l" name="gender" {{ $data_pegawai->gender == 'l' ? 'checked' : '' }} value="l" class="form-check-input">
                                        <label for="l" class="form-check-label">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <input type="radio" id="gender" name="gender" {{ $data_pegawai->gender == 'p' ? 'checked' : '' }} value="p" class="form-check-input">
                                    <label for="p" class="form-check-label">Perempuan</label>
                                    </div>
                                     @error('gender')
                                  <div class="invalid-feedback d-block">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col md-6">
                                    <label for="agama">Agama</label>
                                      @php
                                        $agama = [
                                             'Islam',
                                            'Kristen',
                                            'Katolik',
                                            'Hindu',
                                            'Budha',
                                            'Konghucu'
                                ];
                                    @endphp
                                    <select name="agama" id="agama" class="form-control select2 select2-hidden-accessible @error('agama') is-invalid @enderror">
                                           @foreach ($agama as $option)
                                    @if ($data_pegawai->agama == $option)
                                        <option selected value="{{ $option }}">{{ $option }}</option>
                                    @else
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endif
                                @endforeach
                                    </select>
                                     @error('agama')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="gol_darah">Golongan Darah</label>
                                    @php
                                        $darah = [
                                            'A',
                                            'B',
                                            'AB',
                                            'O',
                                            'Tidak Tahu'
                                ];
                                    @endphp
                                    <select name="gol_darah" id="gol_darah" class="form-control select2 select2-hidden-accessible">
                                          @foreach ($darah as $option)
                                    @if ($data_pegawai->gol_darah == $option)
                                        <option selected value="{{ $option }}">{{ $option }}</option>
                                    @else
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endif
                                @endforeach
                                    </select>
                                </div>
                                <div class="col md-6">
                                    <label for="status_pernikahan">Status Pernikahan</label>
                                    @php
                                        $status =[
                                            'Nikah',
                                            'Belum Nikah',
                                            'Cerai Hidup',
                                            'Cerai Mati'
                                ];
                                    @endphp
                                    <select name="status_pernikahan" id="status_pernikahan" class="form-control select2 select2-hidden-accessible">
                                         @foreach ($status as $option)
                                    @if ($data_pegawai->status_pernikahan == $option)
                                        <option selected value="{{ $option }}">{{ $option }}</option>
                                    @else
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endif
                                @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="nik">NIK</label>
                                    <input type="text" id="nik" name="nik"  value="{{ old('nik',$data_pegawai->nik) }}" class="form-control @error('nik') is-invalid @enderror">
                                     @error('nik')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col md-6">
                                    <label for="telp">No. Telp</label>
                                    <input type="text" class="form-control @error('telp') is-invalid @enderror" value="{{ old('telp',$data_pegawai->telp) }}"  name="telp" id="telp">
                                     @error('telp')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input value="{{ old('email',$data_pegawai->email) }}" type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email">
                                     @error('email')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col md-6">
                                    <label for="alamat">Alamat</label>
                                    <input value="{{ old('alamat',$data_pegawai->alamat) }}" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat">
                                     @error('alamat')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="npwp">No. NPWP</label>
                                    <input value="{{ old('npwp', $data_pegawai->npwp) }}" type="text" id="npwp" name="npwp" class="form-control" >
                                </div>
                                <div class="col md-6">
                                    <label for="bpjs">No. BPJS</label>
                                    <input value="{{ old('bpjs', $data_pegawai->bpjs) }}" type="text" class="form-control" name="bpjs" id="bpjs">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="karpeg">KARPEG</label>
                                    <input value="{{ old('karpeg', $data_pegawai->karpeg) }}" type="text" id="karpeg" name="karpeg" class="form-control @error('gelar_depan') is-invalid @enderror" >
                                     @error('karpeg')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col md-6">
                                    <label for="status_kepegawaian">Status Kepegawaian</label>
                                    @php
                                        $kepeg = [
                                            'PNS',
                                            'PPPK',
                                            'TKK',
                                            'Honorer',
                                            'CPNS',
                                            'Magang'
                                        ]
                                    @endphp
                                    <select name="status_kepegawaian" id="status_kepegawaian" class="form-control select2 select2-hidden-accessible @error('status_kepegawaian') is-invalid @enderror">
                                         @foreach ($kepeg as $option)
                                    @if ($data_pegawai->status_kepegawaian == $option)
                                        <option selected value="{{ $option }}">{{ $option }}</option>
                                    @else
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endif
                                @endforeach
                                    </select>
                                     @error('status_kepegawaian')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="no_sk_cpns">No. SK CPNS</label>
                                    <input value="{{ old('no_sk_cpns',$data_pegawai->no_sk_cpns)}}" type="text" id="no_sk_cpns" name="no_sk_cpns" class="form-control" >
                                </div>
                                <div class="col md-6">
                                    <label for="tmt_sk_cpns">TMT SK CPNS</label>
                                    <input value="{{ old('tmt_sk_cpns',$data_pegawai->tmt_sk_cpns) }}" type="date" class="form-control" name="tmt_sk_cpns" id="tmt_sk_cpns">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="no_sk_pns">No. SK PNS</label>
                                    <input value="{{ old('no_sk_pns',$data_pegawai->no_sk_pns) }}" type="text" id="no_sk_pns" name="no_sk_pns" class="form-control" >
                                </div>
                                <div class="col md-6">
                                    <label for="tmt_sk_pns">TMT SK PNS</label>
                                    <input value="{{ old('tmt_sk_pns',$data_pegawai->tmt_sk_pns) }}" type="date" class="form-control" name="tmt_sk_pns" id="tmt_sk_pns">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="masuk_kerja">Masuk Kerja</label>
                                    <input value="{{ old('masuk_kerja',$data_pegawai->masuk_kerja) }}" type="date" id="masuk_kerja" name="masuk_kerja" class="form-control @error('masuk_kerja') is-invalid @enderror" id="masuk_kerja">
                                    @error('masuk_kerja')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col md-6">
                                    <label for="image">Foto</label>
                                    <input type="hidden" name="oldImage" value="{{ $data_pegawai->image }}">
                                      @if ($data_pegawai->image)
                                      <img src="{{ asset('storage/'. $data_pegawai->image) }}" class="img-preview img-fluid mb-3 col-sm-8 d-block">
                                      @else
                                      <img class="img-preview img-fluid mb-3 col-sm-4">
                                      @endif
                                    <input type="file" id="image" class="form-control-file @error('image') is-invalid @enderror" name="image"
                                     onchange="previewImage()">
                                                @error('image')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                </div>
                            </div>
                            <div>
                                 <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> Simpan</button>
                                 <button class="btn btn-secondary" type="reset"><i class="fa fa-recycle" aria-hidden="true"></i> Reset</button>
                                 <a href="/petugas/data-pegawai" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
