@extends('layouts.app')

@section('title', 'Contact')

@section('header', 'ArrayTest')


@section('content')
    @if (count($test))
        @foreach ($test as $key => $t)
            <div>{{ $key }}. {{ $t['loggin'] }}</div>
        @endforeach

    @endif
    <h2>Contact</h2>
    <h3>Contact Us</h3>
@endsection
