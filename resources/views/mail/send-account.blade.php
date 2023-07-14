@component('mail::message')
Hai {{ $details['nama'] }}!

Anda telah terdaftar di Votos dengan detail sebagai berikut:

Email: {{ $details['email'] }}
Password: {{ $details['password'] }}

@component('mail::button', ['url' => $details['url']])
Login
@endcomponent

Jangan memberitahukan pesan ini ke pihak siapa pun dan segera login untuk mengganti password demi keamanan akun Anda.

Terimakasih,<br>
{{ config('app.name') }}
@endcomponent
