@extends('layouts.app')

@section('title', $test['name'])

@section('header', 'ArrayTest')


@section('content')
    @if ($test['loggin'])
        <div>Logginged IN</div>
    @elseif (!$test['loggin'])
        <div>Not logged in</div>
    @endif

    @unless($test['loggin'])
        <div>This is not logged in using unless</div>
    @endunless


    <h2>{{ $test['name'] }}</h2>
    <h3>{{ $test['age'] }}</h3>
    <h4>{{ $test['gender'] }}</h4>
@endsection
