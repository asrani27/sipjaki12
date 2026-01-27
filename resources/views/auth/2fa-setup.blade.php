@extends('layouts.app')

@section('title', 'Setup Two-Factor Authentication')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Setup Two-Factor Authentication
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Scan the QR code below with your authenticator app
            </p>
        </div>

        <div class="mt-8 bg-white shadow-lg rounded-lg p-6">
            <!-- QR Code -->
            <div class="text-center">
                <img src="{{ $qrCodeUrl }}" alt="QR Code" class="mx-auto rounded-lg shadow-md">
            </div>

            <!-- Secret Key -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Secret Key
                </label>
                <div class="flex items-center">
                    <input type="text" value="{{ $secret }}" readonly
                        class="flex-1 appearance-none border border-gray-300 rounded-l-md py-2 px-3 bg-gray-50 text-gray-600 text-sm focus:outline-none">
                    <button onclick="copySecret()" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-r-md hover:bg-blue-700 transition-colors">
                        Copy
                    </button>
                </div>
            </div>

            <!-- Verification Form -->
            <form method="POST" action="{{ route('2fa.enable') }}" class="mt-6">
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
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <a href="{{ route('dashboard') }}" 
                        class="text-gray-600 hover:text-gray-900 text-sm">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition-colors">
                        Enable 2FA
                    </button>
                </div>
            </form>
        </div>

        <!-- Instructions -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h3 class="font-medium text-blue-900 mb-2">How to setup:</h3>
            <ol class="text-sm text-blue-800 space-y-1 list-decimal list-inside">
                <li>Install an authenticator app (Google Authenticator, Authy, etc.)</li>
                <li>Scan the QR code above with your app</li>
                <li>Enter the 6-digit code from your app</li>
                <li>Click "Enable 2FA" to complete setup</li>
            </ol>
        </div>
    </div>
</div>

<script>
function copySecret() {
    const secret = '{{ $secret }}';
    navigator.clipboard.writeText(secret).then(function() {
        alert('Secret key copied to clipboard!');
    }, function(err) {
        alert('Failed to copy: ' + err);
    });
}
</script>
@endsection
