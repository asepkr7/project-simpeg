<!DOCTYPE html>
<html lang="id">
	<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>cetak laporan KGB</title>
    <link rel="stylesheet" href="/css/sheets-of-paper-usletter.css">
    <link rel="stylesheet" href="/template/node_modules/bootstrap/dist/css/bootstrap.css">
<style>
    table{
        border-collapse: collapse;
    }
    td{
        text-align: center;
    }
    th{
        background-color:grey;
    }
</style>
</head>
<center> <p style="font-size: 20px"><b>LAPORAN KENAIKAN GAJI BERKALA (KGB) BULAN  {{ strtoupper(Date::parse()->month($bulan)->format('F')) }} TAHUN {{ date('Y') }} <br>
di Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu Kabupaten Situbondo

 </b>  </p></center>
<table class="table table-bordered" style="width: 100%" border="1" cellpadding="10">
        <tr>
      <th rowspan="2" width="5px">No</th>
      <th rowspan="2">Nama </th>
      <th rowspan="2">Jabatan</th>
      <th colspan="2">KGB</th>
      <th colspan="2">Realisasi</th>
      <th rowspan="2">Masa Kerja</th>
      <th rowspan="2">KGB YAD</th>
    </tr>
<tr>
      <th>Gapok Lama</th>
      <th>Gapok Baru</th>
      <th>Nomor</th>
      <th>Tanggal</th>

    </tr>

@isset($kgb)
   @foreach ($kgb as $item)

        @php

            if ($item->pegawai->gelar_depan) {
                $titik = $item->pegawai->gelar_depan.'.';
            } else {
                $titik = $item->pegawai->gelar_depan;
            }

            if ($item->pegawai->gelar_belakang) {
                $koma = ', '.$item->pegawai->gelar_belakang;
            } else {
                $koma = '';
            }

        @endphp

        <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $titik }} {{ $item->pegawai->nama }} {{ $koma }} <br> {{ $item->pegawai->nip }}</td>
      @foreach ($item->pegawai->jabatan as $jbtn)
      <td>{{ $jbtn->jabatan == $jbtn->jabatan ? $jbtn->jabatan : 'Belum Ada Jabatan' }}</td>
      @endforeach
      <td>Rp.{{ $item->gapok_lama }}</td>
      <td>Rp.{{ $item->gapok_baru }}</td>
      <td>{{ $item->no_surat }}</td>
      <td>{{ $item->tanggal }}</td>
      <td>{{ $item->masa_kerja_baru}}</td>
      <td>{{Date::parse($item->naik_lanjut)->format('d F Y')}}</td>

     @endforeach
@endisset
</table>
<br>
        <br>
		<table class="none" width="565" style="margin-top: 25px; padding-left: 150px">
			<tr>
				<td width="230"><br><br><br><br></td>
				<td class="text" align="center">Mengetahui, <br> <b> KEPALA DINAS PENANAMAN MODAL PELAYANAN TERPADU SATU PINTU
KABUPATEN SITUBONDO </b><br> <br> <br>
</b><br><br><br><font style=""><b style="border-bottom:2px solid #000; ">Drs H. AKHMAD YULIANTO, M.Si.</b></font><br> <div style="margin-top: 4px">Pembina Utama Muda</div>
NIP. 19680705 198809 1 002</td>
			</tr>
	     </table>
			 </div>
	</center>
	  <script src="/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
