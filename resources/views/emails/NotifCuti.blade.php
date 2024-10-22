@component('mail::message')
# Notifikasi Cuti

Assalamulaikum,

Pengajuan cuti Anda telah {{ $cuti->status }}.

Berikut adalah rincian pengajuan cuti:
- Jenis Cuti: {{ $cuti->jenis_cuti }}
- Alasan: {{ $cuti->alasan }}
- Nomor Surat: {{ $cuti->no_surat }}
- Tanggal Surat: {{ \Carbon\Carbon::parse($cuti->tanggal_surat)->format('d F Y') }}
- Tanggal Mulai: {{ \Carbon\Carbon::parse($cuti->mulai)->format('d F Y') }}
- Tanggal Selesai: {{ \Carbon\Carbon::parse($cuti->selesai)->format('d F Y') }}

Terima kasih.

Waalaikumsalam,
@endcomponent
