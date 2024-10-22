@extends('template.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/petugas/data-pasangan" class="btn" title="Back"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h6 class="text-center  mt-2">Edit Data Jabatan &nbsp;</h6>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="/">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="/petugas/jabatan">{{ $title }}</a>
                    </div>
                    <div class="breadcrumb-item">
                        Edit
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Data Jabatan</h4>
                    </div>
                    <div class="card-body col-md-12">
                        <form action="/petugas/jabatan/{{ $jabatan->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="pegawai_id">Pegawai</label>
                                    <select name="pegawai_id" id="pegawai_id" class="form-control select2 select2-hidden-accessible @error('pegawai_id') is-invalid @enderror">
                                        <option value="">-Pilih Pegawai-</option>
                                        @foreach($pegawai as $p)
                                        @if ( old('pegawai_id', $jabatan->pegawai_id) ==  $p->id)
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
        @php
             $listJabatan = [
    'Kepala Dinas',
    'Seketaris Dinas',
    'Penyusun Rencana Kebutuhan Sarana Dan Prasarana',
    'Analis Kebijakan Ahli Madya',
    'Perencana Ahli Muda',
    'Juru Bayar Gaji',
    'Analis Kebijakan Ahli Muda',
    'Penyusun Rencana Kebutuhan Sarana Dan Prasarana',
    'Penyusun Program Anggaran dan Pelaporan',
    'Pengelola Database',
    'Pengelola Kepegawaian',
    'Verifikator Keuangan',
    'Pengelola Permodalan dan Investasi',
    'Pengelola Data Administrasi dan Verifikasi',
    'Kepala Sub Bagian Umum Dan Kepegawaian',
    'Kepala Sub Bagian Penyusunan Program Dan Keuangan',
    'Kepala Bidang Penanaman Modal',
    'Kepala Bidang Pelayanan Terpadu',
    'Kepala Bidang Data, Informasi Dan Pengaduan',
    'Kepala Seksi Pengembangan Iklim Penanaman Modal',
    'Kepala Seksi Verifikasi',
    'Kepala Seksi Data Dan Sistem Informasi',
    'Kepala Seksi Promosi  Dan Pengendalian Pelaksanaan Penanaman Modal',
    'Kepala Seksi Penetapan Dan Penerbitan',
    'Kepala Seksi Penanganan Pengaduan',
    'Seksi Perijinan Jasa Usaha',
    'Seksi Informasi, Dokumentasi, dan Pengaduan',
    'Staf Subbag Tata Usaha'
    // ... daftar jabatan lainnya
];

        @endphp
    <select name="jabatan" id="jabatan" class="form-control select2 select2-hidden-accessible @error('jabatan') is-invalid @enderror">
        <option value="">-Pilih Jabatan-</option>
        @foreach ($listJabatan as $option)
            @if ($jabatan->jabatan == $option)
                <option selected value="{{ $option }}">{{ $option }}</option>
            @else
                <option value="{{ $option }}">{{ $option }}</option>
            @endif
        @endforeach
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
                                @php
                                    $eselon =[
                                        'V',
                                        'IV B',
                                        'IV A',
                                        'III B',
                                        'III A',
                                        'II B',
                                        'II A'
                            ];
                                @endphp
                                <select name="eselon" id="eselon" class="form-control select2 select2-hidden-accessible @error('eselon') is-invalid @enderror">
                                    <option value="">- Pilih Eselon - </option>
                                    @foreach ($eselon as $option)
                                    @if ($jabatan->eselon == $option)
                                        <option selected value="{{ $option }}">{{ $option }}</option>
                                    @else
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endif
                                @endforeach
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
                                        @php
                                            $jbtn = [
                                                'Jabatan Struktural',
                                                'Jabatan Fungsional Tertentu',
                                                'Jabatan Fungsional Umum'
                                            ]
                                        @endphp
                                        <select name="jenis_jabatan" id="jenis_jabatan" class="custom-select @error('jenis_jabatan') is-invalid @enderror">
                                        <option value="">-Pilih Jenis Jabatan-</option>
                                        @foreach ($jbtn as $option)
                                    @if ($jabatan->jenis_jabatan == $option)
                                        <option selected value="{{ $option }}">{{ $option }}</option>
                                    @else
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endif
                                @endforeach
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
                                        <input type="date" class="form-control  @error('tmt_jabatan') is-invalid @enderror" name="tmt_jabatan" value="{{ old('tmt_jabatan', $jabatan->tmt_jabatan) }}">
                                        @error('tmt_jabatan')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div
                        </div>

                            <div class="form-group col-12 row">
                                    <div class="col-md-5 ml-1">
                                        <label for="no_sk">Nomor SK</label>
                                        <input type="text" class="form-control  @error('no_sk') is-invalid @enderror" name="no_sk" value="{{ old('no_sk', $jabatan->no_sk) }}">
                                        @error('no_sk')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="tanggal_sk">Tanggal SK</label>
                                <input type="date" class="form-control  @error('tanggal_sk') is-invalid @enderror" name="tanggal_sk" id="tanggal_sk" value="{{ old('tanggal_sk', $jabatan->tanggal_sk) }}">
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
                                    <input type="text" class="form-control @error('pejabat_sk') is-invalid @enderror" id="pejabat_sk" name="pejabat_sk"  required value="{{ old( 'pejabat_sk', $jabatan->pejabat_sk) }}">
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
