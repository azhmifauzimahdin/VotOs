@component('mail::message')
Hai {{ $details['nama'] }}!

Anda telah terdaftar di Votos dengan detail sebagai berikut:

Username: {{ $details['username'] }}
Password: {{ $details['password'] }}

Demi keamanan akun Anda, jangan memberitahukan pesan ini ke pihak siapa pun.

Terimakasih,<br>
{{ config('app.name') }}
@endcomponent
