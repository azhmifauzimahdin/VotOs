@component('mail::message')
Hai {{ $details['name'] }}!

Perhatian! Jangan memberitahukan OTP ini ke pihak siapa pun.

Gunakan OTP <b>{{ $details['kode'] }}</b> untuk melakukan vote di website Votos. OTP akan kadaluarsa dalam waktu 2 menit.

{{-- Anda bisa memasukan kode di atas atau klik tombol dibawah: --}}
{{-- @component('mail::button', ['url' => $details['url']])
Vote
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
