@extends('template.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/petugas/jabatan" class="btn" title="Back"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h6 class="text-center  mt-2">Create Jabatan &nbsp;</h6>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item {{Request::is('petugas/dashboard')  ? 'active' : ''}}">
                        <a href="/petugas/dashboard">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item {{Request::is('petugas/jabatan')  ? 'active' : ''}}">
                        <a href="/petugas/jabatan">Jabatan</a>
                    </div>
                    <div class="breadcrumb-item">
                        Create
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Data Jabatan</h4>
                    </div>
                    <div class="card-body col-md-12">
                        <form action="/petugas/jabatan" method="POST" enctype="multipart/form-data">
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
                                        <label for="jabatan">Jabatan</label>
                                        <select name="jabatan" id="jabatan"  class="form-control select2 select2-hidden-accessible @error('jabatan') is-invalid @enderror">
                                            <option value="">-Pilih Jabatan-</option>
                                            <option {{ old('jabatan') =='Kepala Dinas' ? 'selected' : '' }} value="Kepala Dinas">Kepala Dinas</option>
                                            <option {{ old('jabatan') =='Seketaris Dinas' ? 'selected' : '' }} value="Seketaris Dinas">Seketaris Dinas</option>
                                            <option {{ old('jabatan') =='Analis Kebijakan Ahli Madya' ? 'selected' : '' }} value="Analis Kebijakan Ahli Madya">Analis Kebijakan Ahli Madya</option>
                                            <option {{ old('jabatan') =='Analis Kebijakan Ahli Muda' ? 'selected' : '' }} value="Analis Kebijakan Ahli Muda">Analis Kebijakan Ahli Muda</option>
                                            <option {{ old('jabatan') =='Perencana Ahli Muda' ? 'selected' : '' }} value="Perencana Ahli Muda">Perencana Ahli Muda</option>
                                            <option {{ old('jabatan') =='Juru Bayar Gaji' ? 'selected' : '' }} value="Juru Bayar Gaji">Juru Bayar Gaji</option>
                                            <option {{ old('jabatan') =='Bendahara' ? 'selected' : '' }} value="Bendahara">Bendahara</option>
                                            <option {{ old('jabatan') =='Penyusun Rencana Kebutuhan Sarana Dan Prasarana' ? 'selected' : '' }} value="Penyusun Rencana Kebutuhan Sarana Dan Prasarana">Penyusun Rencana Kebutuhan Sarana Dan Prasarana</option>
                                            <option {{ old('jabatan') =='Penyusun Program Anggaran dan Pelaporan' ? 'selected' : '' }} value="Penyusun Program Anggaran dan Pelaporan">Penyusun Program Anggaran dan Pelaporan</option>
                                            <option {{ old('jabatan') =='Pengelola Database' ? 'selected' : '' }} value="Pengelola Database">Pengelola Database</option>
                                            <option {{ old('jabatan') =='Pengelola Kepegawaian' ? 'selected' : '' }} value="Pengelola Kepegawaian">Pengelola Kepegawaian</option>
                                            <option {{ old('jabatan') =='Verifikator Keuangan' ? 'selected' : '' }} value="Verifikator Keuangan">Verifikator Keuangan</option>
                                            <option {{ old('jabatan') =='Pengelola Permodalan dan Investasi' ? 'selected' : '' }} value="Pengelola Permodalan dan Investasi">Pengelola Permodalan dan Investasi</option>
                                            <option {{ old('jabatan') =='Pengelola Data Administrasi dan Verifikasi' ? 'selected' : '' }} value="Pengelola Data Administrasi dan Verifikasi">Pengelola Data Administrasi dan Verifikasi</option>
                                            <option {{ old('jabatan') =='Kepala Sub Bagian Umum Dan Kepegawaian' ? 'selected' : '' }} value="Kepala Sub Bagian Umum Dan Kepegawaian">Kepala Sub Bagian Umum Dan Kepegawaian</option>
                                            <option {{ old('jabatan') =='Kepala Sub Bagian Penyusunan Program Dan Keuangan' ? 'selected' : '' }} value="Kepala Sub Bagian Penyusunan Program Dan Keuangan">Kepala Sub Bagian Penyusunan Program Dan Keuangan</option>
                                            <option {{ old('jabatan') =='Kepala Bidang Penanaman Modal' ? 'selected' : '' }} value="Kepala Bidang Penanaman Modal">Kepala Bidang Penanaman Modal</option>
                                            <option {{ old('jabatan') =='Kepala Bidang Pelayanan Terpadu' ? 'selected' : '' }} value="Kepala Bidang Pelayanan Terpadu"> Kepala Bidang Pelayanan Terpadu</option>
                                            <option {{ old('jabatan') =='Kepala Bidang Data, Informasi Dan Pengaduan' ? 'selected' : '' }} value="Kepala Bidang Data, Informasi Dan Pengaduan">Kepala Bidang Data, Informasi Dan Pengaduan</option>
                                            <option {{ old('jabatan') =='Kepala Seksi Pengembangan Iklim Penanaman Modal' ? 'selected' : '' }} value="Kepala Seksi Pengembangan Iklim Penanaman Modal">Kepala Seksi Pengembangan Iklim Penanaman Modal</option>
                                            <option {{ old('jabatan') =='Kepala Seksi Verifikasi' ? 'selected' : '' }} value="Kepala Seksi Verifikasi">Kepala Seksi Verifikasi</option>
                                            <option {{ old('jabatan') =='Kepala Seksi Data Dan Sistem Informasi' ? 'selected' : '' }} value="Kepala Seksi Data Dan Sistem Informasi">Kepala Seksi Data Dan Sistem Informasi</option>
                                            <option {{ old('jabatan') =='Kepala Seksi Promosi  Dan Pengendalian Pelaksanaan Penanaman Modal' ? 'selected' : '' }} value="Kepala Seksi Promosi  Dan Pengendalian Pelaksanaan Penanaman Modal">Kepala Seksi Promosi  Dan Pengendalian Pelaksanaan Penanaman Modal</option>
                                            <option {{ old('jabatan') =='Kepala Seksi Penetapan Dan Penerbitan' ? 'selected' : '' }} value="Kepala Seksi Penetapan Dan Penerbitan">Kepala Seksi Penetapan Dan Penerbitan</option>
                                            <option {{ old('jabatan') =='Kepala Seksi Penanganan Pengaduan' ? 'selected' : '' }} value="Kepala Seksi Penanganan Pengaduan">Kepala Seksi Penanganan Pengaduan</option>
                                            <option {{ old('jabatan') =='Seksi Perijinan Jasa Usaha ' ? 'selected' : '' }} value="Seksi Perijinan Jasa Usaha">Seksi Perijinan Jasa Usaha </option>
                                            <option {{ old('jabatan') =='Seksi Informasi, Dokumentasi, dan Pengaduan ' ? 'selected' : '' }} value="Seksi Informasi, Dokumentasi, dan Pengaduan">Seksi Informasi, Dokumentasi, dan Pengaduan </option>
                                            <option {{ old('jabatan') =='Staf Subbag Tata Usaha' ? 'selected' : '' }} value="Staf Subbag Tata Usaha">Staf Subbag Tata Usaha</option>
                                        </select>
                                        @error('jabatan')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                                <label for="eselon">Eselon</label>
                                <select name="eselon" id="eselon" class="form-control select2 select2-hidden-accessible @error('eselon') is-invalid @enderror">
                                    <option value="">- Pilih Eselon - </option>
                                    <option {{ old('eselon') =='V'? 'selected' : '' }} value="V">V</option>
                                    <option {{ old('eselon') =='IV B'? 'selected' : '' }} value="IV B">IV B</option>
                                    <option {{ old('eselon') =='IV A'? 'selected' : '' }} value="IV A">IV A</option>
                                    <option {{ old('eselon') =='III B'? 'selected' : '' }} value="III B">III B</option>
                                    <option {{ old('eselon') =='III A'? 'selected' : '' }} value="III A">III A</option>
                                    <option {{ old('eselon') =='II B'? 'selected' : '' }} value="II B">II B</option>
                                    <option {{ old('eselon') =='I'? 'selected' : '' }} value="I A">I A</option>
                                </select>
                                 @error('eselon')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label for="jenis_jabatan">Jenis Jabatan</label>
                                        <select name="jenis_jabatan" id="jenis_jabatan" class="custom-select @error('jenis_jabatan') is-invalid @enderror">
                                        <option value="">-Pilih Jenis Jabatan-</option>
                                        <option value="Jabatan Struktural" {{ old('jenis_jabatan') =='Jabatan Struktural' ? 'selected' : ''  }}>Jabatan Struktural</option>
                                        <option value="Jabatan Fungsional Tertentu" {{ old('jenis_jabatan') =='Jabatan Fungsional Tertentu' ? 'selected' : ''  }}>Jabatan Fungsional Tertentu</option>
                                        <option value="Jabatan Fungsional Umum" {{ old('jenis_jabatan') =='Jabatan Fungsional Umum' ? 'selected' : ''  }}>Jabatan Fungsional Umum</option>
                                        </select>
                                        @error('jenis_jabatan')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                                    <div class="col-md-9">
                                        <label for="tmt_jabatan">TMT Jabatan</label>
                                        <input type="date" class="form-control  @error('tmt_jabatan') is-invalid @enderror" name="tmt_jabatan" value="{{ old('tmt_jabatan') }}">
                                        @error('tmt_jabatan')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div
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
                                    <label for="pejabat_sk">Diterbitkan Oleh</label>
                                    <input type="text" class="form-control @error('pejabat_sk') is-invalid @enderror" id="pejabat_sk" name="pejabat_sk"  value="{{ old( 'pejabat_sk') }}">
                                     @error('pejabat_sk')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                                 <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> Simpan</button>
                                <button class="btn btn-secondary" type="reset"><i class="fa fa-recycle" aria-hidden="true"></i> Reset</button>
                                <a href="/petugas/jabatan" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
