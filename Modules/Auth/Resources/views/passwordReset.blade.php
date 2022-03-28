@extends('auth::layouts.master')

@section('content')
<div class="container p-6 m-auto flex flex-col justify-content-center bg-white items-center text-center rounded shadow">
    <h1 class="text-xl text-black mb-6">Reset Password</h1>
    <form action="{{ route('password.update') }}" method="POST" class="w-full max-w-xl">
        @csrf
        <div class="flex items-center mb-6">
            <div class="w-1/3 pr-4">
                <label for="email" class="block text-gray-800 font-bold text-right">Email</label>
            </div>
            <div class="w-2/3">
                <input type="email" id="email" name="email" placeholder="abc@mail.com" class="bg-gray-200 appearance-none rounded p-2 leading-tight w-full @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-red-500 text-xs font-italic">{{ $message }}</p>
                @enderror
            </div> 
        </div>
        <div class="flex items-center mb-6">
            <div class="w-1/3 pr-4">
                <label for="password" class="block text-gray-800 font-bold text-right">Password</label>
            </div>
            <div class="w-2/3">
                <input type="password" id="password" name="password" placeholder="***" class="bg-gray-200 appearance-none rounded p-2 leading-tight w-full @error('email') border-red-500 @enderror" value="{{ old('password') }}" required>
                @error('password')
                    <p class="text-red-500 text-xs font-italic">{{ $message }}</p>
                @enderror
            </div> 
        </div>
        <div class="flex items-center mb-6">
            <div class="w-1/3 pr-4">
                <label for="password_confirmation" class="block text-gray-800 font-bold text-right">Password Confirmation</label>
            </div>
            <div class="w-2/3">
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="***" class="bg-gray-200 appearance-none rounded p-2 leading-tight w-full @error('email') border-red-500 @enderror" value="{{ old('password_confirmation') }}" required>
                @error('password_confirmation')
                    <p class="text-red-500 text-xs font-italic">{{ $message }}</p>
                @enderror
            </div> 
        </div>
        <div class="flex items-center">
            <div class="w-1/3 pr-4">
                <input type="text" name="token" id="token" value="{{ $token }}" hidden>
            </div>
            <div class="w-2/3 flex items-start">
                <button type="submit" class="bg-black rounded text-white px-4 py-2 leading-tight">Send</button>
            </div>
        </div>
    </form>
</div>
@endsection