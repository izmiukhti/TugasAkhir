@extends('layouts.master')

@section('title', 'Profile')

@section('content')
    <div class="section-header">
        <h1>Profile</h1>
    </div>

    <div class="section-body">
        <div class="section-title-lead-wrapper">
            <div class="section-title">
                <span class="toggle-indicator inactive"></span>
                <h2 class="section-title-text">Profile Information</h2>
            </div>
            <p class="section-lead">
                In this section you can manage system cv data such as editing profile.
            </p>
        </div>

        {{-- Alerts --}}
        {{-- Alerts --}}
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        {{-- Profile Forms --}}
        <div class="card mt-4 p-4">

            {{-- Update Profile Information --}}
            <div class="mb-4">
                <h5 class="mb-3">Update Profile Information</h5>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input id="name" class="form-control" type="text" name="name"
                            value="{{ old('name', auth()->user()->name) }}" required autofocus>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input id="email" class="form-control" type="email" name="email"
                            value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>

            <hr>

            {{-- Update Password --}}
            <div class="mb-4">
                <h5 class="mb-3">Update Password</h5>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="current_password">Current Password</label>
                        <input id="current_password" name="current_password" type="password" class="form-control" required>
                        @error('current_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">New Password</label>
                        <input id="password" name="password" type="password" class="form-control" required>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control"
                            required>
                    </div>

                    <button type="submit" class="btn btn-warning">Update Password</button>
                </form>
            </div>

            <hr>

            {{-- Delete Account --}}
            <div class="mb-4">
                <h5 class="mb-3 text-danger">Delete Account</h5>
                <form method="POST" action="{{ route('profile.destroy') }}"
                    onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" class="form-control" required
                            placeholder="Enter your password to confirm">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </form>
            </div>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Back</a>

    </div>
@endsection

@push('styles')
    <style>
        .section-header {
            background-color: white;
            color: rgb(59, 59, 59);
            font-weight: bold;
            padding: 1.1rem;
            height: 80px;
        }

        .section-header h1 {
            font-size: 24px;
            line-height: 50px;
        }

        .section-title-lead-wrapper {
            margin-bottom: 1.5rem;
        }

        .section-title {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
            margin-top: 1rem;
        }

        .toggle-indicator {
            width: 28px;
            height: 8px;
            background-color: rgb(122, 138, 227);
            border-radius: 7.5px;
            margin-right: 0.5rem;
        }

        .section-title-text {
            font-size: 18px;
            font-weight: normal;
            color: #020202;
            margin-bottom: 0;
        }

        .section-lead {
            font-size: 1rem;
            color: #868e96;
            margin-left: calc(28px + 0.5rem);
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 0.25rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            background: white;
        }
    </style>
@endpush
