<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Auth</title>

       {{-- Laravel Mix - CSS File --}}
       <link rel="stylesheet" href="/css/auth.css">

    </head>
    <body class="bg-gray-300">
        <div class="flex align-items-center justify-content-center bg-inherit p-4 pt-8">
            <h1 class="m-auto text-3xl font-bold">Module Auth</h1>
        </div>
        @yield('content')

        {{-- Laravel Mix - JS File --}}
        <script src="{{ mix('js/auth.js') }}"></script>
    </body>
</html>
