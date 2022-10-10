@extends('layouts.app')
@section('title', 'Profile')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush
@section('content')
    <div class="row justify-content-center">
        {{-- {{dd($msg)}} --}}
        @if (!empty(request()->msg))
        <div class="alert alert-success" role="alert">
            {{request()->msg}}
          </div>
        @endif
        <div class="col-6">
            <h3>Profile</h3>
            <hr>
            <p><label class="label_text"> Name: </label> {{Auth::user()->name}}</p><hr>
            <p><label class="label_text"> Email: </label> {{Auth::user()->email}}</p><hr>
            <a class="btn btn-info" href="{{route('edit_profile')}}">Edit Profile</a>&nbsp;
            <a class="btn btn-warning" href="{{route('change_password')}}">Change Password</a>
            <hr>
        </div>
    </div>
@endsection
