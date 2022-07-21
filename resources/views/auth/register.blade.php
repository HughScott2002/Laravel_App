@extends('layouts.app')

@section('title', 'Register')

@section('header', 'Register')


@section('content')
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label class='form-label'for="name">Name</label>
            <input class='form-control' type="text" name="name" id="name" value="{{ old('name') }}" required />
            @if ($errors->has('name'))
                <div class="alert alert-danger my-2 p-2">{{ $errors->first('name') }}</div>
            @endif
        </div>
        <div class="form-group mb-3">
            <label class='form-label'for="email">Email</label>
            <input class='form-control ' type="text" name="email" id="email" value="{{ old('email') }}"
                required />
            @if ($errors->has('email'))
                <div class="alert alert-danger my-2 p-2">{{ $errors->first('email') }}</div>
            @endif
        </div>
        <div class="form-group mb-3">
            <label class='form-label'for="password">Password</label>
            <input class='form-control ' type="password" name="password" id="password" required />
            @if ($errors->has('password'))
                <div class="alert alert-danger my-2 p-2">{{ $errors->first('password') }}</div>
            @endif
        </div>
        <div class="form-group mb-3">
            <label class='form-label'for="password_confirmation">Re-Typed Password</label>
            <input class='form-control' type="password" name="password_confirmation" id="password_confirmation" required />
            {{-- @if ($errors->has('password'))
                <div class="alert alert-danger my-2 p-2">{{ $errors->first('password') }}</div>
            @endif --}}
        </div>
        <button type="submit" class="btn btn-primary btn-block ">Register

        </button>

    </form>
@endsection()

@section('footer')
    @include('posts.partials.footer')
@endsection()

{{-- @error('title')
            <div class="alert alert-danger my-2 p-2">{{ $message }}</div>
        @enderror --}}
