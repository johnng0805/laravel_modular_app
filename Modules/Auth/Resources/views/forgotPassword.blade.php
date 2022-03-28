@extends('auth::layouts.master')

@section('content')
    <div class="container p-6 m-auto flex flex-col justify-content-center bg-white items-center text-center rounded shadow">
        <h1 class="text-xl text-black mb-6">Forgot Password</h1>
        <form action="forgot-password" method="POST" class="w-full max-w-xl">
            @csrf
            <div class="flex items-center">
                <div class="w-1/6 pr-4">
                    <label for="email" class="block text-gray-800 font-bold text-right">Email</label>
                </div>
                <div class="w-4/6">
                    <input type="email" id="email" name="email" placeholder="abc@mail.com" class="bg-gray-200 appearance-none rounded p-2 leading-tight w-full @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-red-500 text-xs font-italic">{{ $message }}</p>
                    @enderror
                </div> 
                <div class="w-1/6 pl-4">
                    <button type="submit" class="bg-black rounded text-white px-4 py-2 leading-tight">Send</button>
                </div>
            </div>
        </form>
        @if (Session::has('status'))
            <p class="text-blue-500 text-xs font-italic mt-6">{{ Session::get('status') }}</p>
        @endif
    </div>
@endsection
