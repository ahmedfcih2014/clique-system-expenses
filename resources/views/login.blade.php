@extends('includes.bootstrap-layout')

@push('styles')
    <link href="{{ asset('custom-css/login.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <div class="fadeIn first">
                <img src="{{ asset('user-male.png') }}" id="icon" alt="User Icon" />
            </div>
            <form method="POST">
                @csrf
                @if (session()->has('error'))
                    <div class="alert alert-danger"> {{ session('error') }} </div>
                @endif
                <input type="text" id="login" class="fadeIn second" name="username" placeholder="Username" value="{{ old('username') }}">
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
                <input type="submit" class="fadeIn fourth" value="Log In">
            </form>
        </div>
    </div>
@endsection