@extends('template.main')
@section('container')
<div class="section">
    <div class="section-header">
                   @php
                       if ( Auth::user()->level == 'Petugas') {
                        $link = '/petugas/';
                       }elseif (Auth::user()->level == 'Pegawai') {
                        $link = '/pegawai/';
                       }else
                       $link = '/pimpinan/';
                   @endphp
                <h1>Profil &nbsp;</h1>
                <div class="section-header-back">
                    @if (Auth::user()->level == 'Petugas')
                    <a href="/petugas/data-pegawai/cetak/{{$pegawai->id}}" class="btn btn-icon btn-primary" title="Cetak Data Pegawai" target="_blank"><i class="fa fa-print"></i></a>
                    @elseif(Auth::user()->level == 'Pegawai')
                    <a href="/pegawai/profile/cetak/{{auth()->user()->pegawai->id}}" class="btn btn-icon btn-primary" title="Cetak Data Pegawai" target="_blank"><i class="fa fa-print"></i></a>
                    @else
                    @endif
                  </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item {{Request::is($link.'dashboard')  ? 'active' : ''}} ">
                        <a href="{{ $link.'dashboard' }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item  {{Request::is($link.'profile')  ? 'active' : ''}}">
                        Profile
                    </div>
            </div>
    </div>
    @if (Auth::user()->level == 'Petugas' || Auth::user()->level == 'Pimpinan')
    <div class="section-body">
        <div class="col-12 col-md-12 col-lg-12">
                <div class="card profile-widget">
                  <div class="profile-widget-header">

                      @if ($pegawai->image)
                      <img src="{{asset('storage/'.$pegawai->image) }}"  alt="Foto Pegawai" class="rounded-circle profile-widget-picture mt-2">
                      @else
                      <img alt="image" src="/template/assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture mt-2">
                      @endif
                    <div class="profile-widget-items">
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Nama</div>
                        <div class="profile-widget-item-value">{{ $pegawai->nama }}</div>
                    </div>
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">NIP</div>
                        <div class="profile-widget-item-value">{{ $pegawai->nip }}</div>
                    </div>
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Pangkat</div>
                        @foreach ($pegawai->pangkat as $pangkat)
                        <div class="profile-widget-item-value"> {{ $pangkat->pangkat }}</div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="profile-widget-description">
                <div class="profile-widget-name">
                    <span class="badge badge-success badge-sm">#Biodata</span>
                    <div class="table-responsive row">
                   <table class="table" >
                        <tr>
                       <th>TTL </th>
                            <td>: {{ $pegawai->tempat_lahir }}/{{ $pegawai->tanggal_lahir }}</td>
                       <th width="15%">Alamat   </th>
                            <td>: {{ $pegawai->alamat }}</td>
                        </tr>
                        <tr>
                       <th width="15%">Jenis Kelamin  </th>
                            <td>: {{ $pegawai->gender == 'l'? 'Laki-laki' : 'Perempuan' }} </td>
                       <th width="15%">NPWP   </th>
                            <td>: {{ $pegawai->npwp }}</td>
                        </tr>
                        <tr>
                       <th>Agama  </th>
                            <td>: {{ $pegawai->agama }}</td>
                       <th width="15%">BPJS   </th>
                             <td>: {{ $pegawai->bpjs }}</td>
                        </tr>
                        <tr>
                       <th>Gol Darah  </th>
                            <td>: {{ $pegawai->gol_darah }}</td>
                       <th>Karpeg  </th>
                            <td>: {{ $pegawai->karpeg }}</td>
                        </tr>
                        <tr>
                       <th>Status Nikah  </th>
                            <td>: {{ $pegawai->status_pernikahan }}</td>
                       <th>Masuk Kerja  </th>
                            <td>: {{ $pegawai->masuk_kerja }}</td>
                        </tr>
                        <tr>
                       <th>NIK  </th>
                            <td>: {{ $pegawai->nik }}</td>
                       <th>NO SK PNS  </th>
                            <td>: {{ $pegawai->no_sk_pns }}</td>
                        </tr>
                        <tr>
                       <th>Telp  </th>
                            <td>: {{ $pegawai->telp }}</td>
                       <th>TMT SK PN  </th>
                            <td>: {{ $pegawai->tmt_sk_pns }}</td>
                        </tr>
                        <tr>
                       <th>Email  </th>
                            <td>: {{ $pegawai->email }}</td>
                        </tr>
                   </table>

                     </div>

                    </div>
                  <div class="card-footer text-center">
                </div>
</div>
    </div>
        @endif
        @if (Auth::user()->level == 'Pegawai')
        <div class="section-body">
        <div class="col-12 col-md-12 col-lg-12">
                <div class="card profile-widget">
                  <div class="profile-widget-header">
                    @if ( auth()->user()->pegawai->image)
                    <img src="{{asset('storage/'.auth()->user()->pegawai->image->image) }}"  alt="Foto Pegawai" class="rounded-circle profile-widget-picture mt-2">
                    @else
                    <img alt="image" src="/template/assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture mt-2">
                    @endif
                    <div class="profile-widget-items">
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Nama</div>
                        <div class="profile-widget-item-value"> {{ auth()->user()->pegawai->gelar_depan }} {{ auth()->user()->pegawai->nama }} {{ auth()->user()->pegawai->gelar_belakang }}</div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Nip</div>
                        <div class="profile-widget-item-value"> {{ auth()->user()->pegawai->nip }}</div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Status Kepegawaian</div>
                        <div class="profile-widget-item-value"> {{ auth()->user()->pegawai->status_kepegawaian }} </div>
                      </div>
                    </div>
                  </div>
                  <div class="profile-widget-description">
                    <div class="profile-widget-name">
                        <span class="badge badge-success badge-sm">#Biodata</span>
                </div>
                <div class="table-responsive row">
                   <table class="table" >
                        <tr>
                            <th>TTL :</th>
                            <td>{{ auth()->user()->pegawai->tempat_lahir }}/{{ auth()->user()->pegawai->tanggal_lahir }}</td>
                            <th width="15%">Alamat : </th>
                            <td>{{ auth()->user()->pegawai->alamat }}</td>
                        </tr>
                        <tr>
                            <th width="15%">Jenis Kelamin :</th>
                            <td>{{ auth()->user()->pegawai->gender == 'l'? 'Laki-laki' : 'Perempuan' }} </td>
                            <th width="15%">NPWP : </th>
                            <td>{{ auth()->user()->pegawai->npwp }}</td>
                        </tr>
                        <tr>
                            <th>Agama :</th>
                            <td>{{ auth()->user()->pegawai->agama }}</td>
                            <th width="15%">BPJS : </th>
                             <td>{{ auth()->user()->pegawai->bpjs }}</td>
                        </tr>
                        <tr>
                            <th>Gol Darah :</th>
                            <td>{{ auth()->user()->pegawai->gol_darah }}</td>
                            <th>Karpeg :</th>
                            <td>{{ auth()->user()->pegawai->karpeg }}</td>
                        </tr>
                        <tr>
                            <th>Status Nikah:</th>
                            <td>{{ auth()->user()->pegawai->status_pernikahan }}</td>
                            <th>Masuk Kerja :</th>
                            <td>{{ auth()->user()->pegawai->masuk_kerja }}</td>
                        </tr>
                        <tr>
                            <th>NIK :</th>
                            <td>{{ auth()->user()->pegawai->nik }}</td>
                            <th>NO SK PNS :</th>
                            <td>{{ auth()->user()->pegawai->no_sk_pns }}</td>
                        </tr>
                        <tr>
                            <th>Telp :</th>
                            <td>{{ auth()->user()->pegawai->telp }}</td>
                            <th>TMT SK PNS:</th>
                            <td>{{ auth()->user()->pegawai->tmt_sk_pns }}</td>
                        </tr>
                        <tr>
                            <th>Email :</th>
                            <td>{{ auth()->user()->pegawai->email }}</td>

                        </tr>
                   </table>
                     </div>
                  </div>
                  <div class="card-footer text-center">
                  </div>
                </div>
</div>
    </div>
        @endif
</div>


@endsection
