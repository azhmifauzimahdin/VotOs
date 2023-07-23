@component('mail::message')
Hai {{ $details['nama'] }}!

Perhatian! Jangan memberitahukan OTP ini ke pihak siapa pun.

Gunakan OTP <b>{{ $details['kode'] }}</b> untuk melakukan vote di website Votos. OTP akan kadaluarsa dalam waktu 2 menit.

Terimakasih,<br>
{{ config('app.name') }}
@endcomponent
