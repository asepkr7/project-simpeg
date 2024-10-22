<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/sheets-of-paper-usletter.css" />
    <title>Cetak Profil Pegawai</title>
</head>
<style>
    * {
  box-sizing: border-box;
}
table {
     border-collapse: collapse;

}
/* Create two equal columns that floats next to each other */
.column {
  float: left;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

.left {
  width: 60%;
}

.right {
  width: 40%;
}
/* Clear floats after the columns */
.row:after {
  content: "";
  display: inherit;
  clear: both;
}

     body {
      font-family: Arial, Helvetica, sans-serif;
      margin-left: 5px;
      margin-top: -18px;
      padding: 0;
    }


    li{
        margin-bottom: 7px
    }
</style>
<body>
    <div class="page">
    <div style="border: 1px solid;">
        <p><b>&nbsp;&nbsp; I. IDENTITAS DIRI</b></p>
    </div>

@php
                                if ($profil->gelar_depan) {
                                    $titik = $profil->gelar_depan.'.';
                                }else {
                                    $titik = $profil->gelar_depan;
                                }

                                if ($profil->gelar_belakang) {
                                    $koma = ', '.$profil->gelar_belakang;
                                }else{
                                     $koma ='';
                                }

                                if ($profil->image) {
                                    $imagePath = public_path('storage/' . $profil->image);
    $imageData = base64_encode(file_get_contents($imagePath));
    $imageBase64 = 'data:image/png;base64,' . $imageData;

                                }else{
                                    $imageBase64 = '';
                                }

                            @endphp
                            <div class="row">

        <div class="column left">
            <ol>
                <li>Nama Lengkap : {{ $titik }} {{ $profil->nama }}{{ $koma }} </li>
                <li>NIK : {{ $profil->nik }}</li>
                <li>Tempat/Tanggal Lahir : {{ $profil->tempat_lahir }}, {{ $profil->tanggal_lahir }}</li>
                <li>Umur : {{ Carbon\Carbon::parse($profil->tanggal_lahir)->age }}</li>
                <li>Jenis Kelamin : {{ $profil->gender  == 'l' ? 'Laki-Laki':'Perempuan'}}</li>
                <li>Alamat : {{ $profil->alamat }}</li>
                <li>Telepon/Hp : {{ $profil->telp }}</li>
                <li>Email {{ $profil->email }}</li>
                <li>Agama : {{$profil->agama}}</li>
                <li>Gol. Darah : {{ $profil->gol_darah }}</li>
                <li>Status Pernikahan : {{ $profil->status_pernikahan }}</li>
                <li>No BPJS : {{ $profil->bpjs }}</li>
                <li>No NPWP : {{ $profil->npwp }}</li>
                <li>NIP : {{ $profil->nip }}</li>
                <li>Status Kepegawaian : {{ $profil->status_kepegawaian }}</li>
                <li>Karepg : {{  $profil->karpeg}}</li>
                 @foreach ($profil->pangkat as $item)
                <li>Pangkat Saat ini : {{ $item->pangkat }}</li>
                @endforeach
                @foreach ($profil->jabatan as $item)
                <li>Jabatan Saat ini : {{ $item->jabatan }} </li>
                @foreach ($profil->pangkat as $p)
                <li>Eselon & Gol. Ruang : {{ $item->eselon }} & {{ $p->golongan }}</li>
                @endforeach
                @endforeach
                <li>No/Tanggal SK CPNS : {{  $profil->no_sk_cpns}}/{{  $profil->tmt_sk_cpns }}</li>
                <li>No/Tanggal SK PNS : {{  $profil->no_sk_pns}}/{{  $profil->tmt_sk_pns }}</li>
                <li>Masuk Kerja : {{ $profil->masuk_kerja }}</li>
                <li>Unit Kerja : Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu Kabupaten Situbondo</li>
            </ol>
        </div>
        <div class="column right">
            <p style="margin-right: 5px"><img src="{{ $imageBase64 }}" height="125px" alt="Foto Pegawai" class="rounded-circle mr-1"></p>
        </div>
    </div>
    <div style="border: 1px solid; border-collapse: collapse; margin-top: 420px">
                        <p><b>&nbsp;&nbsp; II. RIWAYAT KELUARGA</b></p>
                    </div>
                    <p>Susuna Keluarga (Pasangan dan Anak)</p>
                    <table style="width: 100%" border="1px solid">
                        <thead>
                        <tr>
                            <th>Status</th>
                            <th>Nama</th>
                            <th>L/P</th>
                            <th>Tempat/Tanggal Lahir</th>
                            <th>Pekerjaan</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($profil->pasangan as $item)
                            <tr>
                            <td>{{ $item->status_pasangan }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->gender }}</td>
                            <td>{{ $item->tempat_lahir }},{{ $item->tanggal_lahir }}</td>
                            <td>{{ $item->pekerjaan }}</td>
                            </tr>
                            @endforeach
                            @foreach ($profil->anak as $p)
                            <tr>
                            <td>{{ $p->status_anak }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->gender }}</td>
                            <td>{{ $p->tempat_lahir }},{{ $p->tanggal_lahir }}</td>
                            <td>{{ $p->pekerjaan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
</table>
                     <div style="border: 1px solid; clear: both; border-collapse: collapse; margin-top: 25px; margin-bottom: 15px">
                        <p><b>&nbsp;&nbsp; III. RIWAYAT PENDIDIKAN</b></p>
                    </div>
                    <table style="width: 100%" border="1px solid">
                        <tr>
                            <th>No</th>
                            <th>Pendidikan</th>
                            <th>Jenjang</th>
                            <th>Jurusan</th>
                            <th>Lulus</th>
                        </tr>
                        @foreach ($profil->pendidikan as $pend)
                        <td>{{ $loop->iteration}}</td>
                        <td>{{$pend->pendidikan  }}</td>
                        <td>{{ $pend->jenjang }}</td>
                        <td>{{ $pend->jurusan }}</td>
                        <td>{{ $pend->tanggal_ijazah }}</td>
                        @endforeach
                    </table>
    </div>

        </div>
</body>
</html>
