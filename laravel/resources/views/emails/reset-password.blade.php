@component('mail::message')
# Restablecer contraseña

Hola {{ $user->name }},

Has solicitado restablecer tu contraseña. Haz clic en el siguiente enlace para continuar:

@component('mail::button', ['url' => route('password.reset', ['token' => $token, 'email' => $user->email])])
Restablecer contraseña
@endcomponent

Si no solicitaste este restablecimiento, no es necesario que hagas nada.

Gracias,<br>
{{ config('app.name') }}
@endcomponent