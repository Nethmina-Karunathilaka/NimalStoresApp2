@if (session('status') == 'verification-link-sent')
    <div class="mb-4 font-medium text-sm text-green-600">
        A new verification link has been sent to the email address you provided during registration.
    </div>
@endif

<div class="font-medium text-sm text-gray-600">
    Before proceeding, please check your email for a verification link.
</div>

<div class="mt-4">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <button type="submit" class="btn btn-link text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Resend Verification Email
        </button>
    </form>
</div>
