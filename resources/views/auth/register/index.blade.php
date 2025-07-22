@php
    use App\Models\User;
@endphp

@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">

                <div class="card-header text-center bg-white">
                    <h4 class="mb-0">Register</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register-user') }}">
                        @csrf

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>

                            <input
                                id="name"
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="{{ User::NAME_INPUT_NAME }}"
                                value="{{ old('name') }}"
                                required
                                autofocus
                            />
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>

                            <input
                                id="email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="{{ User::EMAIL_INPUT_NAME }}"
                                value="{{ old('email') }}"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>

                            <input
                                id="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="{{ User::PASSWORD_INPUT_NAME }}"
                                required
                            />
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>

                            <input
                                id="password_confirmation"
                                type="password"
                                class="form-control"
                                name="{{ User::PASSWORD_REPEAT_INPUT_NAME }}"
                                required
                            />
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
