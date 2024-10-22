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
                        Create
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Data Pangkat</h4>
                    </div>
                    <div class="card-body col-md-12">
                        <form action="/petugas/pangkat" method="POST" enctype="multipart/form-data">
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
                                        <label for="pangkat">Pangkat</label>
                                        <select name="pangkat" id="pangkat"  class="form-control select2 select2-hidden-accessible @error('pangkat') is-invalid @enderror">
                                            <option value="">-Pilih Pangkat-</option>
                                            <option {{ old('pangkat') =='Pembina Utama' ? 'selected' : '' }} value="Pembina Utama">Pembina Utama</option>
                                            <option {{ old('pangkat') =='Pembina Utama Madya' ? 'selected' : '' }} value="Pembina Utama Madya">Pembina Utama Madya</option>
                                            <option {{ old('pangkat') =='Pembina Utama Muda' ? 'selected' : '' }} value="Pembina Utama Muda">Pembina Utama Muda</option>
                                            <option {{ old('pangkat') =='Pembina Tingkat I' ? 'selected' : '' }} value="Pembina Tingkat I">Pembina Tingkat I</option>
                                            <option {{ old('pangkat') =='Pembina' ? 'selected' : '' }} value="Pembina">Pembina</option>
                                            <option {{ old('pangkat') =='Penata Tingkat I' ? 'selected' : '' }} value="Penata Tingkat I"> Penata Tingkat I</option>
                                            <option {{ old('pangkat') =='Penata' ? 'selected' : '' }} value="Penata">Penata</option>
                                            <option {{ old('pangkat') =='Penata Muda' ? 'selected' : '' }} value="Penata Muda">Penata Muda</option>
                                            <option {{ old('pangkat') =='Penata Muda Tingkat I' ? 'selected' : '' }} value="Penata Muda">Penata Muda Tingkat I</option>
                                            <option {{ old('pangkat') =='Pengatur Tingkat I' ? 'selected' : '' }} value="Pengatur Tingkat I">Pengatur Tingkat I</option>
                                            <option {{ old('pangkat') =='Pengatur' ? 'selected' : '' }} value="Pengatur">Pengatur</option>
                                            <option {{ old('pangkat') =='Pengatur Muda Tingkat I' ? 'selected' : '' }} value="Pengatur Muda Tingkat I">Pengatur Muda Tingkat I</option>
                                            <option {{ old('pangkat') =='Pengatur Muda' ? 'selected' : '' }} value="Pengatur Muda">Pengatur Muda</option>
                                            <option {{ old('pangkat') =='Juru Tingkat I' ? 'selected' : '' }} value="Juru Tingkat I">Juru Tingkat I</option>
                                            <option {{ old('pangkat') =='Juru' ? 'selected' : '' }} value="Juru">Juru</option>
                                            <option {{ old('pangkat') =='Juru Muda Tingkat I' ? 'selected' : '' }} value="Juru Muda Tingkat I">Juru Muda Tingkat I</option>
                                            <option {{ old('pangkat') =='Juru Muda' ? 'selected' : '' }} value="Juru Muda">Juru Muda</option>
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
                                        <select name="golongan" id="golongan" class="form-control select2 select2-hidden-accessible @error('golongan') is-invalid @enderror">
                                            <option value="">-Pilih Golongan-</option>
                                        <option value="IV/E" {{ old('golongan') =='IV/E' ? 'selected' : ''  }}>IV/E</option>
                                        <option value="IV/D" {{ old('golongan') =='IV/D' ? 'selected' : ''  }}>IV/D</option>
                                        <option value="IV/C" {{ old('golongan') =='IV/C' ? 'selected' : ''  }}>IV/C</option>
                                        <option value="IV/B" {{ old('golongan') =='IV/B' ? 'selected' : ''  }}>IV/B</option>
                                        <option value="IV/A" {{ old('golongan') =='IV/A' ? 'selected' : ''  }}>IV/A</option>
                                        <option value="III/D" {{ old('golongan') =='III/D' ? 'selected' : ''  }}>III/D</option>
                                        <option value="III/C" {{ old('golongan') =='III/C' ? 'selected' : ''  }}>III/C</option>
                                        <option value="III/B" {{ old('golongan') =='III/B' ? 'selected' : ''  }}>III/B</option>
                                        <option value="III/A" {{ old('golongan') =='III/A' ? 'selected' : ''  }}>III/A</option>
                                        <option value="II/D" {{ old('golongan') =='II/D' ? 'selected' : ''  }}>II/D</option>
                                        <option value="II/C" {{ old('golongan') =='II/C' ? 'selected' : ''  }}>II/C</option>
                                        <option value="II/B" {{ old('golongan') =='II/B' ? 'selected' : ''  }}>II/B</option>
                                        <option value="II/A" {{ old('golongan') =='II/A' ? 'selected' : ''  }}>II/A</option>
                                        <option value="I/D" {{ old('golongan') =='I/D' ? 'selected' : ''  }}>I/D</option>
                                        <option value="I/C" {{ old('golongan') =='I/C' ? 'selected' : ''  }}>I/C</option>
                                        <option value="I/B" {{ old('golongan') =='I/B' ? 'selected' : ''  }}>I/B</option>
                                        <option value="I/A" {{ old('golongan') =='I/A' ? 'selected' : ''  }}>I/A</option>
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
                             <input type="text" class="form-control  @error('jenis_pangkat') is-invalid @enderror" name="jenis_pangkat" value="{{ old('jenis_pangkat')}}">
                               @error('jenis_pangkat')
                            <div class="invalid-feedback d-block">
                              {{ $message }}
                            </div>
                              @enderror
                            </div>
                        </div>
                        <div class="form-group">
                                    <div class="col-md-9">
                                        <label for="tmt_pangkat">TMT  Pangkat</label>
                                        <input type="date" class="form-control  @error('tmt_pangkat') is-invalid @enderror" name="tmt_pangkat" value="{{ old('tmt_pangkat') }}">
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
                                    <label for="pejabat_sk">Pejabat SK</label>
                                    <input type="text" class="form-control @error('pejabat_sk') is-invalid @enderror" id="pejabat_sk" name="pejabat_sk"  required value="{{ old( 'pejabat_sk') }}">
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
