@extends('template.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/petugas/kgb" class="btn" title="Back"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h6 class="text-center  mt-2">Edit Data {{ $title }} &nbsp;</h6>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="/petugas/dashboard">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="/petugas/kgb">{{ $title }}</a>
                    </div>
                    <div class="breadcrumb-item">
                        Edit
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Data {{ $title }}</h4>
                    </div>
                    <div class="card-body col-md-12">
                        <form action="/petugas/kgb/{{ $kgb->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="pegawai_id">Pegawai</label>
                                    <select name="pegawai_id" id="pegawai_id" class="form-control select2 select2-hidden-accessible @error('pegawai_id') is-invalid @enderror">
                                        <option value="">-Pilih Pegawai-</option>
                                        @foreach($pegawai as $p)
                                        @if ( old('pegawai_id', $kgb->pegawai_id) ==  $p->id)
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
                                        <label for="pejabat_sk_lama">Pejabat SK Lama</label>
                                        <input type="text" class="form-control  @error('pejabat_sk_lama') is-invalid @enderror" name="pejabat_sk_lama" value="{{ old('pejabat_sk_lama', $kgb->pejabat_sk_lama) }}">
                                        @error('pejabat_sk_lama')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="gapok_lama">Gapok Lama</label>
                                <input type="text" class="form-control  @error('gapok_lama') is-invalid @enderror" name="gapok_lama" id="gapok_lama" value="{{ old('gapok_lama', $kgb->gapok_lama) }}">
                                 @error('gapok_lama')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-9">
                                    <label for="tmt_lama">TMT Lama</label>
                                    <input type="date" class="form-control @error('tmt_lama') is-invalid @enderror" name="tmt_lama" id="tmt_lama" value="{{ old('tmt_lama', $kgb->tmt_lama)}}">
                                    @error('tmt_lama')
                                    <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                        <div class="form-group">
                            <div class="col-md-9">
                             <label for="masa_kerja_lama">Masa Kerja Lama</label>
                             <input type="text" class="form-control  @error('masa_kerja_lama') is-invalid @enderror" name="masa_kerja_lama" value="{{ old('masa_kerja_lama', $kgb->masa_kerja_lama)}}">
                               @error('masa_kerja_lama')
                            <div class="invalid-feedback d-block">
                              {{ $message }}
                            </div>
                              @enderror
                            </div>
                        </div>
                        <div class="form-group col-12 row">
                                    <div class="col-md-5 ml-2">
                                        <label for="no_sk_lama">No SK</label>
                                        <input type="text" class="form-control  @error('no_sk_lama') is-invalid @enderror" name="no_sk_lama" value="{{ old('no_sk_lama', $kgb->no_sk_lama) }}">
                                        @error('no_sk_lama')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="tanggal_sk_lama">Tanggal SK Lama</label>
                                <input type="date" class="form-control  @error('tanggal_sk_lama') is-invalid @enderror" name="tanggal_sk_lama" id="tanggal_sk_lama" value="{{ old('tanggal_sk_lama', $kgb->tanggal_sk_lama) }}">
                                 @error('tanggal_sk_lama')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                             <label for="gapok_baru">Gapok Baru</label>
                             <input type="text" class="form-control  @error('gapok_baru') is-invalid @enderror" name="gapok_baru" value="{{ old('gapok_baru', $kgb->gapok_baru)}}">
                               @error('gapok_baru')
                            <div class="invalid-feedback d-block">
                              {{ $message }}
                            </div>
                              @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                             <label for="tmt_baru">TMT Baru</label>
                             <input type="date" class="form-control  @error('tmt_baru') is-invalid @enderror" name="tmt_baru" value="{{ old('tmt_baru', $kgb->tmt_baru)}}">
                               @error('tmt_baru')
                            <div class="invalid-feedback d-block">
                              {{ $message }}
                            </div>
                              @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                             <label for="masa_kerja_baru">Masa Kerja Baru</label>
                             <input type="text" class="form-control  @error('masa_kerja_baru') is-invalid @enderror" name="masa_kerja_baru" value="{{ old('masa_kerja_baru', $kgb->masa_kerja_baru)}}">
                               @error('masa_kerja_baru')
                            <div class="invalid-feedback d-block">
                              {{ $message }}
                            </div>
                              @enderror
                            </div>
                        </div>
                        <div class="form-group">
                                    <div class="col-md-9">
                                        <label for="no_surat">Nomor</label>
                                        <input disabled type="text" class="form-control  @error('no_surat') is-invalid @enderror" name="no_surat" value="{{ old('no_surat', $kgb->no_surat) }}">
                                        @error('no_surat')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                             <label for="naik_lanjut">Naik Selanjutnya</label>
                             <input type="date" class="form-control  @error('naik_lanjut') is-invalid @enderror" name="naik_lanjut" value="{{ old('naik_lanjut', $kgb->naik_lanjut)}}">
                               @error('naik_lanjut')
                            <div class="invalid-feedback d-block">
                              {{ $message }}
                            </div>
                              @enderror
                            </div>
                        </div>
                                   <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> Save</button>
                                <button class="btn btn-secondary" type="reset"><i class="fa fa-recycle" aria-hidden="true"></i> Reset</button>
                                 <a href="/petugas/kgb" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
