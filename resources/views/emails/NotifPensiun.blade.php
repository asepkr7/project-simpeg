@component('mail::message')


# Pemberhentian Kerja karena Masa Pensiun

Assalamulaikum,

Yth. Bapak/Ibu  {{ $pegawai->nama }}

Dengan hormat,

Kami ingin menyampaikan informasi bahwa Bapak/Ibu  {{ $pegawai->nama }} akan memasuki masa pensiun pada tanggal
 @php
                               $tanggalLahir = Carbon\Carbon::parse($pegawai->tanggal_lahir);
                               $umurSekarang = $tanggalLahir->age;
                               $tanggalMencapaiUmur58 = $tanggalLahir->addYears(58);

                               // Jika tanggal yang diperoleh melebihi tanggal saat ini, kita kurangi satu tahun
                               if ($tanggalMencapaiUmur58->isFuture()) {
                                   $tanggalMencapaiUmur58->subYear();
                               }
                           @endphp
                          {{ $tanggalMencapaiUmur58->format('d/m/Y') }} .

                           @php
        use Carbon\Carbon;
        use Illuminate\Support\Facades\App;


        Carbon::setLocale('id');
        $masukKerja = Carbon::parse($pegawai->masuk_kerja);
        $now = Carbon::now();

        $lamaKerja = $masukKerja->diffInYears($now)
    @endphp

Bapak/Ibu  {{ $pegawai->nama }} telah bekerja di perusahaan ini selama {{ $lamaKerja }} tahun dan telah memberikan kontribusi yang besar bagi perusahaan. Kami mengucapkan terima kasih atas dedikasi dan loyalitas Bapak/Ibu selama ini.

Kami berharap Bapak/Ibu  {{ $pegawai->nama }} dapat menikmati masa pensiun yang bahagia dan sejahtera.

Demikian informasi ini kami sampaikan. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.
Waalaikumsalam,
<x-mail::button :url="'gmail.com'">
Klik disini
</x-mail::button>
@endcomponent
