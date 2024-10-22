<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>cetak surat KGB</title>
    <link rel="stylesheet" href="/css/sheets-of-paper-usletter.css" />
  </head>
  <style type="text/css">
    body {
      font-family: "Times New Roman", Times, serif;
      margin-left: 5px;
      margin-top: -18px;
      padding: 0;
    }

    table.kop {
      border-style: 7px solid #000;
      border-width: 15px;
      border-bottom: double;
      border-color: #000;
      border-left: none;
      border-right: none;
      border-top: none;
    }
    table.top {
      margin-top: 1px;
      border-style: double;
      border-width: 5px;
      border-bottom: none;
      border-color: #000;
      border-left: none;
      border-right: none;
      border-top: 4px solid #000;
    }
    .none {
      border: none;
      font-family: "Times New Roman", Times, serif, Tahoma, sans-serif, Verdana;
    }
    table tr .text2 {
      text-align: right;
      font-size: 13px;
    }
    table tr .text3 {
        margin-left: 10px;
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

    table tr.image-row {
      border-bottom: 2px solid black;
    }

    tr.image-row td {
      text-align: center;
    }

    tr.image-row img {
      display: block;
      margin: 0 auto;
    }
    ol > li{
        margin-bottom: 4px
    }
  </style>
  <body>
    <center>
      <div class="page">
        <table class="kop" width="540">
          <tr class="image-row">
            <!-- @php $imagePath = 'img/logo.png'; $imageData = base64_encode(file_get_contents(public_path($imagePath))); $imageSrc = 'data:image/png;base64,' . $imageData; @endphp -->
            <img src="{{ $imagePath }}" alt="logo" height="105" />
            <td>
              <center>
                <font size="5"><b>PEMERINTAH KABUPATEN SITUBONDO</b></font
                ><br />
                <font size="4"><b>DINAS PENANAMAN MODAL PELAYANAN TERPADU SATU PINTU</b></font
                ><br />
                <font size="2"><b>Jalan PB. Sudirman NO. 20 Telp. ( 0338 ) 672155 Fax (0338) 679155</b></font
                ><br />
                <font size="5"><b>S I T U B O N D O</b></font
                ><br />
              </center>
            </td>
          </tr>
        </table>
        <table width="540" class="top">
          <tr>
            <td style="padding-right: 11px" class="text2">Situbondo, {{ Date::parse($kgb->tanggal)->format('d F Y') }}<br /></td>
          </tr>
        </table>
        <table class="none">
          <tr class="text2">
            <td>Nomor</td>
            <td width="280">: {{ $kgb->no_surat }}</td>
          </tr>
          <tr class="text2">
            <td>Lampiran</td>
            <td width="280">: -</td>
            <td style="padding-right: 230px" width="145">Kepada :</td>
          </tr>
          <tr>
            <td>Perihal</td>
            <td width="280">: Kenaikan Gaji Berkala</td>
            <td style="padding-right: 230px" width="145">Yth. Kepala Badan Kepegawaian & Pengembangan Sumber Daya Manusia Kabupaten</td>

          </tr>
          <tr>
            <td></td>
            <td width="280"></td>
            <td  style="padding-right: 230px" width="145">Situbondo</td>
          </tr>
          <tr>
            <td></td>
            <td width="365"></td>
            <td  style="padding-right: 230px" width="145">di-</td>
          </tr>
          <tr>
            <td></td>
            <td width="280"></td>
            <td  style="padding-right: 230px" width="145"><b>&nbsp;&nbsp;&nbsp;&nbsp;Situbondo</b></td>
          </tr>
        </table>
        <br />
<table class="none" width="540" style="padding-top: ">

          <tr>
            <td>
            {{-- <p style="margin-top: ;font-size: 14px;">Sebagai pertimbangan, kami lampirkan kelengkapan sebagai berikut :</p> --}}
            <font style="font-size: 14px;"><p style="margin-right: 123px; margin-top: ">Dengan ini diberitahukan bahwa dengan telah dipenuhinya masa kerja dan syarat-syarat lainnya Kepada :</p> <ol>
            </td>
          </tr>
        </table>
        <table class="none" style="margin-top: -20">
          <tr class="text3">
            <td>1. &nbsp;&nbsp;&nbsp;Nama</td>
            <td width="541">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$kgb->pegawai->nama}}</td>
          </tr>
          <tr>
            <td>2. &nbsp;&nbsp;&nbsp;NIP</td>
            <td width="525">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$kgb->pegawai->nip}}</td>
          </tr>
          <tr>
            <td width="125">3. &nbsp;&nbsp;&nbsp;Pangkat / Golongan</td>
            <td width="525">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: @foreach ($kgb->pegawai->pangkat as $item)
                {{ $item->pangkat }} / {{ $item->golongan }}
            @endforeach</td>
          </tr>
          <tr>
            <td>4. &nbsp;&nbsp;&nbsp;Kantor / Tempat Bekerja</td>
            <td width="525">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Dinas Penanaman Modal Dan Pelayanan Terpadu  Satu Pintu Kabupaten Situbondo</td>
          </tr>
        </table>
        <table class="none" width="540" style="padding-top: ">

          <tr>
            <td>
            <font style="font-size: 13px;"><p style="margin-right: 29px;margin-top: 1">5.  &nbsp;&nbsp;&nbsp;Gaji Pokok Lama (Atas Dasar Surat Keputusan Terakhir Tentang Gaji / Pangkat) yang ditetapkan Oleh :</p> </font>
            </td>
          </tr>
        </table>

        <table class="none" width="540" style="margin-top: -22">
          <tr>
            <td>
             <ol type="a">
                <li>Pejabat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$kgb->pejabat_sk_lama}} </li>
                <li>Nomor dan Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$kgb->no_sk_lama }} / {{$kgb->tanggal_sk_lama }} </li>
                <li>Gaji Pokok Lama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: a.n Bupati Situbondo </li>
                <li>Tanggal Berlakunya Gaji&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$kgb->tmt_lama }} </li>
                <li>Masa Kerja Golongan Gaji&nbsp;&nbsp;&nbsp;&nbsp;: {{$kgb->masa_kerja_lama }} </li>
                <p style="margin-top: -2">pada tanggal tersebut</p>
             </ol>
            </td>
          </tr>
          <tr>
            <td>
            <p style="margin-top: -8">Diberikan Kenaikan Gaji Gerkala Hingga Memperoleh :</p>
            </td>
          </tr>
        </table>
        <table class="none" style="margin-top: -14px">
          <tr class="text3">
            <td>6. &nbsp;&nbsp;&nbsp;Gaji Pokok Baru</td>
            <td width="541">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$kgb->gapok_baru }}</td>
          </tr>
          <tr>
            <td>7. &nbsp;&nbsp;&nbsp;Berdasarkan Masa Kerja</td>
            <td width="525">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$kgb->masa_kerja_baru }}</td>
          </tr>
          <tr>
            <td width="125">8. &nbsp;&nbsp;&nbsp;Dalam Golongan Ruang</td>
            <td width="525">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: @foreach ($kgb->pegawai->pangkat as $item)
                 {{ $item->golongan }} @endforeach</td>
          </tr>
          <tr>
            <td>9. &nbsp;&nbsp;&nbsp;Terhitung Mulai Tanggal</td>
            <td width="525">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $kgb->tmt_baru }}</td>
          </tr>
          <tr>
            <td>10.&nbsp;&nbsp;&nbsp;Berkala Berikutnya</td>
            <td width="525">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $kgb->naik_lanjut }}</td>
          </tr>
        </table>
        <br />
        <table class="none" width="540" style="margin-top: -15px">
          <tr>
            <td>
              <font size="2">Diharapkan sesuai dengan Peratuan Pemerintah Republik Indonesia Nomor 30 Tahun 2015, maka kepada  Pegawai Negeri Sipil tersebut dapat dibayarkan penghasilannya berdasarkan gaji pokok yang baru</font>
            </td>
          </tr>
        </table>
        <table class="none" width="585" >
          <tr style="margin-block-end: 15px; margin-top: 10px">
            <td width="200"><br /><br /></td>
            <td class="text" align="center"> <br />
                 <b>
               KEPALA DINAS PENANAMAN MODAL<br>
                PELAYANAN  TERPADU SATU PINTU<br>
                 KABUPATEN  SITUBONDO <br /> </b>
                <br />
                <br>
              <br /><br /><br /><font style=""><b style="border-bottom: 2px solid #000">Drs. AKMAD YULIANTO, M.Si</b></font><br />
              <div style="margin-top: 4px">Pembina Utama Muda
              </div>
              NIP. 19680705 198809 1 002
            </td>
          </tr>
        </table>
        <table class="none" style="margin-top: -28px">
            <tr><td><p style="border-bottom:1px solid ">Tembusan disampaikan Kepada Yth :</p></td>
                <hr>
            </tr>
            <tr>
                <td >
                    <p style="margin-top: -9px;">1. Bupati Situbondo</p>
                    <p style="margin-top: -9px;">2. Inspektorat Kab. Situbondo</p>
                    <p style="margin-top: -9px;">3. Kepala Badan Kepegawaian dan  <br> &nbsp;&nbsp;&nbsp;&nbsp;Sumber Daya Manusia Kab. Situbondo</p>
                    <p style="margin-top: -9px;">4. Kepala DPMPTSP Kab. Situbondo</p>
                    <p style="margin-top: -9px;">5. Bendahara/Juru Bayar pada DPMTPSP Situbondo</p>
                    <p style="margin-top: -9px;">6. Yang  bersangkutan untuk diketahui</p>
                    <p style="margin-top: -9px;">7. Arsip</p>
            </ol>
        </td>
            </tr>
        </table>
      </div>
    </center>
  </body>
</html>
