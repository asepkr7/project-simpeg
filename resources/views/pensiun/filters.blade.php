@extends('template.main')
@section('container')
<div class="section">
            <div class="section-header">
                <h1>Filter Pensiun &nbsp;</h1>
                <div class="section-header-back">
                    @if (Auth::user()->level == 'Pegawai')
                        <a href="/pegawai/pengajuan-cuti/create" class="btn btn-icon btn-primary" title="Ajukan Pensiun">
                        <i class="fa fa-plus"></i></a>
                    @endif
                  </div>
                <div class="section-header-breadcrumb">
                   @php
                       if ( Auth::user()->level == 'Petugas') {
                        $link = '/petugas/';
                       }else{
                        $link = '/pegawai/';
                       }
                   @endphp
                    <div class="breadcrumb-item {{Request::is($link.'dashboard')  ? 'active' : ''}} ">
                        <a href="{{ $link.'dashboard' }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item  {{Request::is($link.'pensiun')  ? 'active' : ''}}">
                        Pensiun
                    </div>

                </div>
            </div>
            @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('success') }}
                      </div>
                    </div>
                @endif
            @if (session()->has('reject'))
                    <div class="alert alert-danger alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('reject') }}
                      </div>
                    </div>
                @endif
            @if (session()->has('edit'))
                    <div class="alert alert-warning alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('edit') }}
                      </div>
                    </div>
                @endif
            <div class="section-body">
                <div class="card ">
                  <div class="card-body col-md-12">
                        <div class="card-header">
                            <label for="">Pilih Bulan :</label>
                        </div>
                        <form action="{{route('pimpinan.cetak.pensiun')}}" method="get">
                            <div class="form-group col-12 row">
                            <div class="col-md-11">
                                 <select name="bulan" id="bulan" class="form-control select2 select2-hidden-accessible">
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                     </select>
                            </div>
                                <button class="btn btn-primary" type="submit"> <i class="fas fa-print"></i></button>
                            </div>
                            </div>
                        </div>
                        </form>

                        </div>
                  </div>
                </div>
@endsection
