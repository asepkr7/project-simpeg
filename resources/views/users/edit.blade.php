@extends('template.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/petugas/users" class="btn" title="Back"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h6 class="text-center  mt-2">Create Data Users &nbsp;</h6>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="/petugas/dashboard">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="/petugas/users">Users</a>
                    </div>
                    <div class="breadcrumb-item">
                        Edit
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Data Users</h4>
                    </div>
                    <div class="card-body col-md-12">
                        <form action="/petugas/users/{{ $user->username }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="pegawai_id">Pegawai</label>
                                    <select name="pegawai_id" id="pegawai_id" class="form-control select2 select2-hidden-accessible @error('pegawai_id') is-invalid @enderror">
                                        <option value="">-Pilih Pegawai-</option>
                                        @foreach($pegawai as $p)
                                        @if ( old('pegawai_id', $user->pegawai_id) ==  $p->id)
                                        <option value="{{ $p->id }}" selected>{{ $p->nama }}</option>
                                        @else
                                        <option value="{{ $p->id }}" >{{ $p->nama }}</option>
                                        @endif
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
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control  @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->username) }}">
                                        @error('username')
                                        <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="level">Level</label>
                                    <select name="level" id="level" class="form-control select2 select2-hidden-accessible @error('level') is-invalid @enderror">
                                        <option value="">-Pilih Level-</option>
                                        <option value="Petugas" {{ old('level', $user->level) == 'Petugas' ? 'selected' : '' }}>Petugas</option>
                                        <option value="Pimpinan" {{ old('level',  $user->level) == 'Pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                                        <option value="Pegawai" {{ old('level',  $user->level) == 'Pegawai' ? 'selected' : '' }}>Pegawai</option>
                                    </select>
                                     @error('level')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" oninput="toggleShowPasswordButton('password')">
                                    <button type="button" id="showPassword" class="btn badge badge-light  toggle-password mt-2" style="display: none;" onclick="togglePasswordVisibility('password')"><i class="fas fa-eye"></i></button>
                                     @error('password')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" name="password_confirmation"  oninput="toggleShowPasswordButton('password_confirmation')">
                                     <button type="button" id="showPasswordConfirmation" class="btn badge badge-light  toggle-password mt-2" style="display: none;" onclick="togglePasswordVisibility('password_confirmation')"><i class="fas fa-eye"></i></button>
                                     @error('password')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                            </div>
                            <div>
                                 <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> Save</button>
                      <button class="btn btn-secondary" type="reset"><i class="fa fa-recycle" aria-hidden="true"></i> Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
