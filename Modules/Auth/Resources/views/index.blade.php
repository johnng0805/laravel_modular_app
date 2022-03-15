@extends('auth::layouts.master')

@section('content')
    <h1 class="text-3xl">Hello World</h1>

    <p>
        This view is loaded from module: {!! config('auth.name') !!}
    </p>
@endsection
