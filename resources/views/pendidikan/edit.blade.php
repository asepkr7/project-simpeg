@extends('template.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/petugas/data-pasangan" class="btn" title="Back"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h6 class="text-center mt-2">Edit Data {{ $title }} &nbsp;</h6>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="petugas/dashboard">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="/petugas/pendidikan">Pendidikan</a>
                    </div>
                    <div class="breadcrumb-item">
                        Edit
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Data Orang Tua</h4>
                    </div>
                    <div class="card-body col-md-12">
                        <form action="/petugas/pendidikan/{{ $pendidikan->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="pegawai_id">Pegawai</label>
                                    <select name="pegawai_id" id="pegawai_id" class="form-control select2 select2-hidden-accessible @error('pegawai_id') is-invalid @enderror">
                                        <option value="">-Pilih Pegawai-</option>
                                        @foreach($pegawai as $p)
                                        @if ( old('pegawai_id', $pendidikan->pegawai_id) ==  $p->id)
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
                                        <input type="text" class="form-control  @error('pendidikan') is-invalid @enderror" name="pendidikan" value="{{ old('pendidikan', $pendidikan->pendidikan) }}">
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
                                             @php
                                            $jenjang = [
                                                'SD/MI',
                                                'SLTP',
                                                'SLTA',
                                                'D1',
                                                'D2',
                                                'D3',
                                                'D4/S1',
                                                'S2',
                                                'S3',
                                                'Profesi'
                                    ];
                                        @endphp
                                        <select name="jenjang" id="jenjang"  class="form-control select2 select2-hidden-accessible @error('jenjang') is-invalid @enderror">
                                            @foreach ($jenjang as $option)
                                    @if ($pendidikan->pendidikan == $option)
                                        <option selected value="{{ $option }}">{{ $option }}</option>
                                    @else
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endif
                                @endforeach
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
                                        <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi" value="{{ old('lokasi', $pendidikan->lokasi)}}">
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
                                    <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan"  required value="{{ old( 'jurusan',$pendidikan->jurusan) }}">
                                     @error('jurusan')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                             <div class="form-group col-12 row">
                                    <div class="col-md-5 ml-1">
                                        <label for="no_ijazah">Nomor Ijazah</label>
                                        <input type="text" class="form-control  @error('no_ijazah') is-invalid @enderror" name="no_ijazah" value="{{ old('no_ijazah', $pendidikan->no_ijazah) }}">
                                        @error('no_ijazah')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="tanggal_ijazah">Tanggal Ijazah</label>
                                <input type="date" class="form-control  @error('tanggal_ijazah') is-invalid @enderror" name="tanggal_ijazah" id="tanggal_ijazah" value="{{ old('tanggal_ijazah', $pendidikan->tanggal_ijazah) }}">
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
                                    <input type="text" class="form-control @error('nama_pimpinan') is-invalid @enderror" id="nama_pimpinan" name="nama_pimpinan"  required value="{{ old( 'nama_pimpinan',$pendidikan->nama_pimpinan) }}">
                                     @error('nama_pimpinan')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                            <div>
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
