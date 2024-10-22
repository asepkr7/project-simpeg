<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>cetak surat Pensiun</title>
    {{-- <link rel="stylesheet" href="/css/sheets-of-paper-usletter.css" /> --}}
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
    table.js tr> td{
text-align: justify;
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
             @php $imagePath = 'img/logo.png'; $imageData = base64_encode(file_get_contents(public_path($imagePath))); $imageSrc = 'data:image/png;base64,' . $imageData; @endphp
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
            <td style="padding-right: 11px" class="text2">Situbondo,  {{Date::parse($pensiun->tanggal_surat)->format('d F Y')  }}<br /></td>
          </tr>
        </table>
        <table class="none">
          <tr class="text2">
            <td>Nomor</td>
            <td width="280">: {{ $pensiun->no_surat }}</td>
          </tr>
          <tr class="text2">
            <td>Lampiran</td>
            <td width="280">: -</td>
            <td style="padding-right: 230px" width="145">Kepada :</td>
          </tr>
          <tr>
            <td >Perihal</td>
            <td width="280">: Permohonan Penisun</td>
            <td style="padding-right: 230px" width="145">Yth. Bupati Situbondo <br> Kepala Badan Kepegawaian & Pengembangan Sumber Daya Manusia Kabupaten</td>

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
         <table class="none" width="540" style="margin-top: 5px">
          <tr>
            <td>
            <p style="font-size: 14px; text-align: justify">Yang bertanda tangan di bawah ini, Kepala Dinas Penanaman Modal Pelayanan Terpadu Satu Pintu Kabupaten Situbondo, dengan ini mengajukan permohonan berhenti  dengan hormat sebagai  Pegawai  Negeri Sipil dengan Hak Pensiun Atas {{ $pensiun->jenis_pensiun }} terhitung mulai tanggal 27 April 2002 dengan alasan{{ $pensiun->alasan }}atas nama Pegawai :</p>
            </td>
          </tr>
        </table>

        <table class="none" style="margin-top: -7px; margin-left: 15px">
          <tr class="text3">
            <td>1. &nbsp;&nbsp;&nbsp;Nama</td>
            <td width="541">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $pensiun->pegawai->nama }}</td>
          </tr>
          <tr>
            <td>2. &nbsp;&nbsp;&nbsp;NIP</td>
            <td width="525">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $pensiun->pegawai->nip }}</td>
          </tr>
          <tr>
            <td>3. &nbsp;&nbsp;&nbsp;Tempat, Tanggal Lahir</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $pensiun->pegawai->tempat_lahir }},  {{Date::parse($pensiun->pegawai->tanggal_surat)->format('d F Y')  }}</td>
          </tr>
          <tr>
            <td width="125">4. &nbsp;&nbsp;&nbsp;Pangkat / Golongan</td>
            @foreach ($pensiun->pegawai->pangkat as $item)
            <td width="525">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $item->pangkat }} / {{ $item->golongan }}
                @endforeach
              </td>
          </tr>
          <tr>
            <td>5. &nbsp;&nbsp;&nbsp;Kantor / Tempat Bekerja</td>
            <td width="525">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Dinas Penanaman Modal Dan Pelayanan Terpadu  Satu Pintu Kabupaten Situbondo </td>
          </tr>
          <tr>
             <td width="125">4. &nbsp;&nbsp;&nbsp;Masa Kerja</td>
            <td width="525">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $pensiun->masa_kerja }}
          </tr>
        </table>

        <table class="none" width="540" style="margin-top: -9;">

          <tr>
            <td>
            <p style="margin-top: ;font-size: 14px;">Sebagai pertimbangan, kami lampirkan kelengkapan sebagai berikut :</p>
            </td>
          </tr>
        </table>

        <table class="none js" width="520" style="margin-top: -9;margin-left: 15px;">

          <tr>
            <td>1. &nbsp;&nbsp;&nbsp;Data Perorangan Calon Penerima Pensiun (DPCP); </td>
          </tr>
                <tr>
                    <td>2. &nbsp;&nbsp;&nbsp;Daftar Susunan Keluarga yang sah dan berhak untuk pensiun </td>
                </tr>
                <tr>
                    <td>3. &nbsp;&nbsp;&nbsp;Daftar Riwayat Pekerjaan masing-masing diisi sesuai dengan urutan Kepangkatan Pekerjaan yang telah dijalankan yang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bersangkutan mulai dari SK CPNS sampai dengan SK Pangkat Terakhir; </td>
                </tr>
                <tr>
            <td>4.&nbsp;&nbsp;&nbsp;&nbsp;Fotocopy sah SK CPNS, SK PNS, SK Pangkat Terakhir, Keputusan Berkala Terakhir dan Surat Keputusan  Peninjauan Masa<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kerja (apabila ada);</td>
          </tr>
                <tr>
            <td>5.&nbsp;&nbsp;&nbsp;&nbsp;Fotocopy sah Keputusan Pengangkatan dalam Jabatan Terakhir (serta SPP, SPMJ dan SPMT);</td>
          </tr>
                <tr>
            <td>6.&nbsp;&nbsp;&nbsp;&nbsp;Fotocopy sah KARPEG, Konversi NIP baru 18 digit, Taspen, Karis/Karsu, Fotocopy buku Rekening Bank Mandiri <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Taspen/Mantap;</td>
          </tr>
                <tr>
            <td>7.&nbsp;&nbsp;&nbsp;&nbsp;Fotocopy sah Surat Nikah/Akte Perkawinan dilegalisir oleh (KUA/Kemeneg/Disdukcapil), Akte Kelahiran Anak yang masih <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;menjadi tanggungan dilegalisir oleh Disdukcapil dan surat keterangan aktif kuliah (bagi anak usia diatas 21 tahun s/d <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 25 tahun);</td>
          </tr>
                <tr>
            <td>8.&nbsp;&nbsp;&nbsp;&nbsp;Fotocopy KTP, Kartu Keluarga dilegalisir oleh Disdukcapil jika belum menggunakan Barcode, Fotocopy NPWP;</td>
          </tr>
                <tr>
            <td>9.&nbsp;&nbsp;&nbsp;&nbsp;Pas photo berwarna terbaru dari janda/duda/anak ukuran 3x4 cm sebanyak 12 (dua belas) lembar (dengan menuliskan nama <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dibalik pasfoto tersebut);</td>
          </tr>
                <tr>
            <td>10.&nbsp;&nbsp;&nbsp;Penilaian Prestasi Kerja PNS (setiap unsur penilaian prestasi kerja paling sedikit bernilai baik dalam 1 (satu) tahun terakhir);</td>
          </tr>
                <tr>
            <td>11.&nbsp;&nbsp;&nbsp;Surat pernyataan tidak pernah dihukum disiplin tingkat sedang atau berat dalam 1 (satu) tahun terakhir (ditandatangani oleh <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pejabat Pimpinan Tinggi Pratama/Eselon II);</td>
          </tr>
                <tr>
            <td>12.&nbsp;&nbsp;&nbsp;Surat Pernyataan Tidak Sedang Menjalani Proses Pidana Atau Pernah Dipidana Penjara Berdasarkan Putusan Pengadilan <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang Telah Berkekuatan Hukum Tetap (dibuat oleh PPK atau pejabat lain yang menangani kepegawaian paling rendah <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; menduduki JPT Pratama);</td>
          </tr>

        </table>

        </table>
        <br />
        <table class="none" width="540" style="margin-top: -7px">
          <tr>
            <td>
              <font size="2">Demikian surat permohonan pensiun ini kami buat untuk dapat diproses sebagaimana mestinya</font>
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
              <br /><br /><br /><font style=""><b style="border-bottom: 2px solid #000">Drs H. AKHMAD YULIANTO, M.Si.</b></font><br />
              <div style="margin-top: 4px">Pembina Utama Muda</div>
              NIP. 19680705 198809 1 002
            </td>
          </tr>
        </table>
      </div>
    </center>
  </body>
</html>
