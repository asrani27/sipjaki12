@extends('layouts.app')

@section('title', 'Disable Two-Factor Authentication')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Disable Two-Factor Authentication
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Enter your authentication code to disable 2FA
            </p>
        </div>

        <div class="mt-8 bg-white shadow-lg rounded-lg p-6">
            <form method="POST" action="{{ route('2fa.disable') }}">
                @csrf

                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                        Enter Authentication Code <span class="text-red-500">*</span>
                    </label>
                    <input id="code" name="code" type="text" required
                        class="appearance-none border border-gray-300 rounded-md w-full py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter 6-digit code"
                        maxlength="6"
                        pattern="[0-9]{6}"
                        inputmode="numeric">
                    <p class="mt-2 text-xs text-gray-500">
                        Open your authenticator app and enter the 6-digit code
                    </p>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <a href="{{ route('dashboard') }}" 
                        class="text-gray-600 hover:text-gray-900 text-sm">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-red-600 text-white px-6 py-2 rounded-md hover:bg-red-700 transition-colors">
                        Disable 2FA
                    </button>
                </div>
            </form>
        </div>

        <!-- Warning -->
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <h3 class="font-medium text-red-900 mb-2">Warning:</h3>
            <p class="text-sm text-red-800">
                Disabling two-factor authentication will make your account less secure. We recommend keeping 2FA enabled for maximum security.
            </p>
        </div>
    </div>
</div>
@endsection
