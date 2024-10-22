<!DOCTYPE html>
<html lang="id">
	<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>cetak DUK</title>
    <link rel="stylesheet" href="/css/sheets-of-paper-usletter.css">
    <link rel="stylesheet" href="/template/node_modules/bootstrap/dist/css/bootstrap.css">
<style>
    table{
        border-collapse: collapse;
    }
    th{
        background-color:grey;
    }
</style>
</head>
<center> <p style="font-size: 20px"><b>DAFTAR URUT KEPANGKATAN (DUK) TAHUN {{ date('Y') }} <br>
di Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu Kabupaten Situbondo

 </b>  </p></center>
<table class="table table-bordered" style="width: 100%" border="1" cellpadding="10">
        <tr>
            <th width="5px">No</th>
            <th width="250px">NAMA <br> NIP</th>
            <th>GOLRU/TMT</th>
            <th>ESELON/TMT</th>
            <th>JABATAN/UNIT KERJA TMT</th>
            <th>MAKER THN/BLN</th>
            <th>DIKLAT TMT</th>
            <th>PENDIDIKAN TMT</th>
            <th width="75px">TGL LAHIR UMUR</th>
        </tr>
    @php
use Carbon\Carbon;
@endphp

@isset($duk)
@foreach ($duk as $item)
    @php
        $umur = null; // Inisialisasi variabel umur
        $lahir = Carbon::parse($item->tanggal_lahir);
        $umur = Carbon::now()->diffInYears($lahir); // Menghitung umur dalam tahun
    @endphp
    <tr>
        <td>{{ $loop->iteration }}</td>
        @php
                                if ($item->gelar_depan) {
                                    $titik = $item->gelar_depan.'.';
                                }else {
                                    $titik = $item->gelar_depan;
                                }

                                if ($item->gelar_belakang) {
                                    $koma = ', '.$item->gelar_belakang;
                                }else{
                                     $koma ='';
                                }
                            @endphp
        <td> <b style="border-bottom:1px solid #000; ">{{ $titik }} {{ $item->nama }}{{ $koma }} </b> <br>{{ $item->nip }}</td>
        <td>
            @foreach ($item->pangkat as $pangkat)
              <center> {{ $pangkat->golongan }} <br>{{ $pangkat->tmt_pangkat }}</center>
            @endforeach
        </td>
        <td>
            @foreach ($item->jabatan as $jabatan)
             <center>{{ $jabatan->eselon }} <br> {{ $jabatan->tmt_jabatan }}</center>
            @endforeach
        </td>
        <td>
            @foreach ($item->jabatan as $jabatan)
                {{ $jabatan->jabatan }} <br> {{ $jabatan->tmt_jabatan }}
            @endforeach
        </td>
        <td>{{ $item->masuk_kerja }}</td>
        <td>
            @foreach ($item->diklat as $diklat)
                {{ $diklat->diklat }} <br> {{ $diklat->tanggal_sttpp }}
            @endforeach
        </td>
        <td>
            @foreach ($item->pendidikan as $pendidikan)
                {{ $pendidikan->jenjang }} {{ $pendidikan->jurusan }} <br> {{ $pendidikan->tanggal_ijazah }}
            @endforeach
        </td>
        <td><center> {{ $item->tanggal_lahir }} <br> <b>{{ $umur }}</b> </center></td>
    </tr>
@endforeach
@endisset
</table>
		<br>
        <br>
		<table class="none" width="595" style="margin-top: 25px; padding-left: 236px">
			<tr>
				<td width="230"><br><br><br><br></td>
				<td class="text" align="center">Mengetahui, <br> <b>KEPALA DINAS PENANAMAN MODAL PELAYANAN TERPADU SATU PINTU
KABUPATEN SITUBONDO </b> <br> <br> <br> <br>
</b><br><br><br><font style=""><b style="border-bottom:2px solid #000; ">Drs H. AKHMAD YULIANTO, M.Si.</b></font><br> <div style="margin-top: 4px">Pembina Utama Muda</div>
NIP. 19680705 198809 1 002</td>
			</tr>
	     </table>
			 </div>
	</center>
	  <script src="/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
