@extends('authkit::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('authkit.name') !!}</p>
@endsection
