@extends('layouts.user')

@section('content')
<section style="margin: 20px;">
    <!-- Email Verification Status Section -->
    <div style="margin-bottom: 20px;">
        @if (auth()->user()->hasVerifiedEmail())
            <div class="alert alert-success">
                <strong>✔ Your email is verified!</strong>
            </div>
        @else
            <div class="alert alert-warning">
                <strong>✘ Your email is not verified.</strong>
                <br>
                <p>Please verify your email to enjoy all features of the site.</p>
                <a href="{{ route('verification.notice') }}">Click here to resend the verification email.</a>
            </div>
        @endif
    </div>

    <!-- Form to verify email (if not verified) -->

    <!-- Profile Info Form -->
    <div class="pro-info">
        <form method="POST" action="{{ route('profile.updateEmail') }}">
            @csrf
            @method('PUT')
            <h2>Profile Info</h2>
            <p>Update your account's profile information and email address.</p>
            <div class="input-info">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>

                <label for="email" style="margin-left:10px">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>

                <button class="save2" type="submit">
                    Save Info
                </button>
            </div>
        </form>
    </div>

    <!-- Update Password Form -->
    <div class="pro-info">
        <form method="POST" action="{{ route('profile.updatePassword') }}">
            @csrf
            @method('PUT')
            <h2>Update Password</h2>
            <p>Ensure your account is using a long, random password to stay secure.</p>
            <div class="input-info">
                <label for="password">Current Password</label>
                <input type="password" style="width:15%;" id="current_password" name="current_password" required>
                @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror

                <label for="new-password" style="margin-left:10px">New Password</label>
                <input type="password" style="width:15%;" id="password" name="password" required>

                <label for="new-password" style="margin-left:10px">Confirm Password</label>
                <input type="password" style="width:15%;" id="password_confirmation" name="password_confirmation" required>
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror

                <button class="save1" type="submit">
                    Save Password
                </button>
            </div>
        </form>
    </div>

    <!-- Delete Account Form -->
    <div class="pro-info">
        <form method="POST" action="{{ route('profile.delete') }}">
            @csrf
            @method('DELETE')
            <h2>Delete Account</h2>
            <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
            <div class="input-info">
                <button class="delete-button" onclick="return confirm('Are you sure you want to delete your account?');">
                    Delete Account
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
