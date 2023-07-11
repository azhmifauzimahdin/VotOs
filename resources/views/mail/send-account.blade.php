@component('mail::message')
Hai {{ $details['nama'] }}!

Anda telah terdaftar di Votos dengan detail sebagai berikut:

Username: {{ $details['username'] }}
Password: {{ $details['password'] }}

@component('mail::button', ['url' => $details['url']])
Login
@endcomponent

Jangan memberitahukan pesan ini ke pihak siapa pun dan segera login untuk mengganti password untuk keamanan akun Anda.

Terimakasih,<br>
{{ config('app.name') }}
@endcomponent
