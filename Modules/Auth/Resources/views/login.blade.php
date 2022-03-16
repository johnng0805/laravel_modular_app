@extends('auth::layouts.master')

@section('content')
    <div class="container p-6 m-auto flex justify-content-center">
        <div class="w-full max-w-sm m-auto">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="#" method="POST">
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                  Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="abc@mail.com" required>
              </div>
              <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                  Password
                </label>
                <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************" required>
                <p class="text-red-500 text-xs italic">Please choose a password.</p>
              </div>
              <div class="flex items-center justify-between mb-6">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                  Sign In
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                  Forgot Password?
                </a>
              </div>
              <div class="flex justify-content-center w-full">
                <a href="#" class="no_underline text-blue-500 font-bold text-sm m-auto">Register here</a>
              </div>
            </form>
            <p class="text-center text-gray-500 text-xs">
              &copy;2020 Acme Corp. All rights reserved.
            </p>
          </div> 
    </div>
@endsection
