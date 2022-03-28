@extends('auth::layouts.master')

@section('content')
    <div class="container p-6 m-auto flex justify-content-center">
        <div class="w-full max-w-sm m-auto">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="login" method="POST">
              @csrf
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                  Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 mb-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" id="email" type="email" placeholder="abc@mail.com" name="email" value="{{ old('email') }}" required>
                @error('email')
                  <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
              </div>
              <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                  Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" id="password" type="password" name="password" placeholder="***" value="{{ old('password') }}" required>
                @error('password')
                  <p class="text-red-500 text-xs italic">Please choose a password.</p>
                @enderror
              </div>
              <div class="flex items-center justify-between mb-6">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                  Sign In
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="forgot-password">
                  Forgot Password?
                </a>
              </div>
              <div class="flex justify-content-center w-full">
                <a href="/auth/register" class="no_underline text-blue-500 font-bold text-sm m-auto">Register here</a>
              </div>
            </form>
            <p class="text-center text-gray-500 text-xs">
              &copy;2020 Acme Corp. All rights reserved.
            </p>
          </div> 
    </div>
@endsection
