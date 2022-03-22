@extends('auth::layouts.master')

@section('content')
<div class="container m-auto flex flex-col justify-content-center mt-4">
    <div class="m-auto text-center bg-white px-10 py-6 shadow-md rounded-lg">
        <h1 class="text-3xl font-bold mb-2">A verification email has been sent to you.</h1>
        <form action="/email/verification-notification" method="POST">
            @csrf
            <button type="submit" class="px-4 py-2 bg-black rounded text-white text-sm">Resend email</button>
        </form>
    </div>
</div>
@endsection