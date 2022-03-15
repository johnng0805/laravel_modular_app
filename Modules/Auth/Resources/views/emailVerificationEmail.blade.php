<h1>Laravel Verification Email</h1>

Please verify your email with below link:
<a href="{{ \Illuminate\Support\Facades\URL::signedRoute('http://laravel_modular.app', ['id' => $user_id, 'token' => $token]) }}">Verify Email</a>