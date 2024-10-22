<!DOCTYPE html>
<html lang="id">
	<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Laporan Cuti</title>
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
<center> <p style="font-size: 20px"><b>LAPORAN CUTI PEGAWAI BULAN   {{ strtoupper(Date::parse()->month($bulan)->format('F')) }}
  TAHUN {{ date('Y') }} <br>
di Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu Kabupaten Situbondo

 </b>  </p></center>
<table class="table table-bordered" style="width: 100%" border="1" cellpadding="10">
        <tr>
            <th width="5px">No</th>
            <th width="220px">Nama <br> NIP</th>
            <th>Jabatan</th>
            <th>Mulai Cuti</th>
            <th>Selesai Cuti</th>
            <th>Lama Cuti</th>
            <th>Jenis Cuti</th>
            <th>Alasan</th>
        </tr>


@php
    use Carbon\Carbon;
    use Illuminate\Support\Facades\App;

    Carbon::setLocale('id');
@endphp

@isset($laporan)
    @foreach ($laporan->sortBy('mulai') as $item)
        @php
            $tglMulai = Carbon::parse($item->mulai);
            $tglSelesai = Carbon::parse($item->selesai);
            $jumlahHari = $tglMulai->diffInDays($tglSelesai);

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
            <td><b style="border-bottom:1px solid #000;">{{ $titik }} {{ $item->pegawai->nama }}{{ $koma }}</b><br>{{ $item->pegawai->nip }}</td>
            <td>
                @foreach ($item->pegawai->jabatan as $jabatan)
                    <center>{{ $jabatan->jabatan }}</center>
                @endforeach
            </td>
            <td>
                {{ Date::parse($item->mulai)->format('d F Y') }}
            </td>
            <td>{{ Date::parse($item->selesai)->format('d F Y') }}</td>
            <td>
                {{ $jumlahHari }} Hari
            </td>
            <td> {{ $item->jenis_cuti }}</td>
            <td>{{ $item->alasan }}</td>
        </tr>
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
