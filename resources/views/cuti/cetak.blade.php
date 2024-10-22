<!DOCTYPE html>
<html lang="id">
	<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>cetak surat cuti</title>
    <link rel="stylesheet" href="/css/sheets-of-paper-usletter.css">

</head>
<style type="text/css">
	 body {
		font-family: arial;
        margin-left: 5px;
        margin-top: -18px;
        padding: 0;
	}

	table.kop {
	  border-style: 7px solid #000;
		border-width: 15px  ;
		border-bottom: double ;
		border-color: #000;
		border-left: none;
		border-right: none;
		border-top:none ;
	}
table.top{
    margin-top:1px;
    border-style: double;
		border-width: 5px ;
        border-bottom: none ;
		border-color: #000;
		border-left: none;
		border-right: none;
		border-top:4px solid #000 ;
}
.none{
	border: none;
    font-family:  'Times New Roman', Times, serif
}
	table tr .text2 {
		text-align: right;
		font-size: 13px;
	}
	table tr .text {
		text-align: center;
		font-size: 13px;
	}
	table tr td {
		font-size: 13px;
	}

table	tr.image-row {
border-bottom: 2px solid black;
}

tr.image-row td {
text-align: center;
}

tr.image-row img {
display: block;
margin: 0 auto;
}


</style>
<body>
	<center>
		<div class="page">
		<table class="kop" width="540">
			<tr class="image-row">
				@php
                $imagePath = 'img/logo.png';
                $imageData = base64_encode(file_get_contents(public_path($imagePath)));
                $imageSrc = 'data:image/png;base64,' . $imageData;
             @endphp
            <img src="{{ $imageSrc }}" alt="logo" height="105" >
				<td>
				<center>
					<font size="5"><b>PEMERINTAH KABUPATEN SITUBONDO</b></font><br>
					<font size="4"><b>DINAS PENANAMAN MODAL  PELAYANAN  TERPADU SATU PINTU</b></font><br>
					<font size="2"><b>Jalan PB. Sudirman No. 20 Telp. ( 0338 ) 672155 Fax (0338) 679155</b></font><br>
					<font size="5"><b>S I T U B O N D O</b></font><br>
				</center>
				</td>
			</tr>
		</table>
		<table width="540" class="top" >
			<tr>
				<td class="text2"><br></td>
			</tr>
		</table>
		<table class="none" style="margin-top: 20px;">
			<tr class="text2">
				<td width="540">
                    <center>
                        <font size="3" style="font-family: Verdana, Geneva, Tahoma, sans-serif"><b >SURAT IZIN {{strtoupper($cuti->jenis_cuti) }}</b></font><br>
                        <font size="3" style="font-family: Verdana, Geneva, Tahoma, sans-serif"><b style="border-top:2px solid #000;">Nomor : {{ $cuti->no_surat }}</b></font>
                </center>
                </td>
			</tr>
			<tr>
                    <td width="540">
                        <center>
                            <br>
                        </center>
                        </td>
			</tr>
		</table>
		<br>
		<table class="none" width="540"  style="margin-left: 35px">
			<tr>
		       <td width="535">
                    <font size="2">Diberikan izin {{ $cuti->alasan ? $cuti->alasan : $cuti->jenis_cuti}} kepada Pegawai Negeri Sipil (PNS) :</font>
		       </td>
		    </tr>
		</table>

        <table class="none" width="520" style="margin-top: 10px">
			<tr class="text2">
				<td>Nama</td>
				<td width="541">: {{ $cuti->pegawai->nama }}</td>
			</tr>
			<tr>
				<td>NIP</td>
				<td width="525">: {{ $cuti->pegawai->nip }}</td>
			</tr>
			<tr>
				<td  width="125">Pangkat / Golongan</td>
				<td width="525">: @foreach ($cuti->pegawai->pangkat as $item)
                    {{$item->pangkat }} / ({{ $item->golongan }})
                    @endforeach
                </td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td width="525">: @foreach ($cuti->pegawai->jabatan as $jbtn)
                    {{ $jbtn->jabatan }}
                @endforeach
                     </td>
			</tr>
			<tr>
				<td>Unit Kerja</td>
				<td width="525">: Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu Kabupaten Situbondo </td>
			</tr>
		</table>

		<table class="none" width="540">
    			<tr>
        <td>
    @php
        use Carbon\Carbon;
        use Illuminate\Support\Facades\App;


        Carbon::setLocale('id');
        $tglMulai = Carbon::parse($cuti->mulai);
        $tglSelesai = Carbon::parse($cuti->selesai);

        $jumlahHari = $tglMulai->diffInDays($tglSelesai);
    @endphp
    <font size="2">Selama {{ $jumlahHari}} ({{ Terbilang::make($jumlahHari) }}) hari kerja terhitung mulai tanggal <b>{{ Date::parse($cuti->mulai)->format('d F Y') }}</b> sampai dengan
    <b>{{Date::parse($cuti->selesai)->format('d F Y') }}</b>, dengan ketentuan sebagai berikut:</font>
</td>

    </tr>
    <tr>
        <td>
            1. Sebelum menjalankan {{ $cuti->alasan ? $cuti->alasan : $cuti->jenis_cuti}} wajib menyerahkan pekerjaannya kepada atasan langsungnya atau pejabat lain yang ditunjuk <br>
            2. Selama menjalankan {{ $cuti->alasan ? $cuti->alasan : $cuti->jenis_cuti}}, tidak berhak atas tunjangan / honor lainnya. <br>
            3. Setelah selesai menjalankan {{ $cuti->alasan ? $cuti->alasan : $cuti->jenis_cuti}} wajib melaporkan diri kepada atasan langsungnya dan bekerja kembali sebagaimana mestinya. <br>
        </td>
    </tr>
		</table>

		<table class="none" width="540">
			<tr>
		       <td>
			       <font size="2">Demikian surat izin cuti tahunan ini diberikan untuk dapat dipergunakan sebagaimana mestinya. </font>
		       </td>
		    </tr>
		</table>
		<br>
        <br>
		<table class="none" width="585" style="margin-top: 25px">
			<tr>
				<td width="200"><br><br><br><br></td>
				<td class="text" align="center">Situbondo, {{Date::parse($cuti->tanggal_surat)->format('d F Y')  }}<br  <b>
               KEPALA DINAS PENANAMAN MODAL<br>
                PELAYANAN  TERPADU SATU PINTU<br>
                 KABUPATEN  SITUBONDO <br /> </b>
                <br />
                <br>
</b><br><br><br><font style=""><b style="border-bottom:2px solid #000; ">Drs H. AKHMAD YULIANTO, M.Si.</b></font><br> <div style="margin-top: 4px">Pembina Utama Muda</div>
NIP. 19680705 198809 1 002</td>
			</tr>
	     </table>
			 </div>
	</center>

</body>
</html>
