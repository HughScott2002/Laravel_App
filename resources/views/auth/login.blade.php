@extends('layouts.app')

@section('title', 'Login')

@section('header', 'login')


@section('content')
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label class='form-label'for="email">Email</label>
            <input class='form-control ' type="text" name="email" id="email" value="{{ old('email') }}" required />
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

        <div class="form-check">
            <label class="form-check-label" for="rememberMe">
                Remeber me
            </label>
            <input class="form-check-input" type="checkbox" value="{{ old('remember') ? 'checked' : '' }}"
                id="rememberMe">
        </div>
        <button type="submit" class="btn btn-primary btn-block ">Login

        </button>

    </form>
@endsection()

@section('footer')
    @include('posts.partials.footer')
@endsection()

{{-- @error('title')
            <div class="alert alert-danger my-2 p-2">{{ $message }}</div>
        @enderror --}}
