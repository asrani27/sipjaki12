@extends('layouts.app')

@section('title', 'Verify Two-Factor Authentication')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="mx-auto h-12 w-12 flex items-center justify-center rounded-full bg-blue-100">
                <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Two-Factor Authentication
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Enter the 6-digit code from your authenticator app
            </p>
        </div>

        <div class="mt-8 bg-white shadow-lg rounded-lg p-6">
            <form method="POST" action="{{ route('2fa.verify') }}">
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
                        Authentication Code <span class="text-red-500">*</span>
                    </label>
                    <input id="code" name="code" type="text" required
                        class="appearance-none border border-gray-300 rounded-md w-full py-3 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-center text-2xl tracking-widest"
                        placeholder="000000"
                        maxlength="6"
                        pattern="[0-9]{6}"
                        inputmode="numeric"
                        autofocus>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Verify
                    </button>
                </div>
            </form>
        </div>

        <!-- Instructions -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h3 class="font-medium text-blue-900 mb-2">Instructions:</h3>
            <ul class="text-sm text-blue-800 space-y-1 list-disc list-inside">
                <li>Open your authenticator app (Google Authenticator, Authy, etc.)</li>
                <li>Find the code for your account</li>
                <li>Enter the 6-digit code above</li>
                <li>The code changes every 30 seconds</li>
            </ul>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const codeInput = document.getElementById('code');
    
    // Focus on the code input
    codeInput.focus();
    
    // Auto-format the code as user types
    codeInput.addEventListener('input', function(e) {
        // Remove any non-numeric characters
        this.value = this.value.replace(/[^0-9]/g, '');
        
        // Limit to 6 digits
        if (this.value.length > 6) {
            this.value = this.value.slice(0, 6);
        }
    });
});
</script>
@endsection
