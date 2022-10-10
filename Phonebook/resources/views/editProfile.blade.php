@extends('layouts.app')
@section('title', 'Update Profile')
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
            <form method="POST" action="{{ route('edit_profile') }}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text"
                            class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ Auth::user()->email }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <br>

                <div class="card-footer">
                    <button type="submit" class="btn btn-secondary"><i
                            class="fas fa-save"></i>&nbsp;Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
