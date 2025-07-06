@extends('admin.layout.auth')
@section('content')
<style>
    .glassmorphism {
        background: rgba(255, 255, 255, 0.8); /* Increased opacity for better readability */
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .glassmorphism-fallback {
        background: rgb(43 204 255 / 18%); /* Fallback for unsupported browsers */
    }
    .floating-shape {
        position: absolute;
        border-radius: 50%;
        opacity: 0.15;
        animation: float 10s infinite ease-in-out;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
    /* Responsive floating shapes */
    @media (max-width: 640px) {
        .floating-shape {
            display: none; /* Hide on small screens to avoid clutter */
        }
    }
    @media (min-width: 641px) {
        .floating-shape-sm { width: 10vw; height: 10vw; }
        .floating-shape-md { width: 15vw; height: 15vw; }
        .floating-shape-lg { width: 20vw; height: 20vw; }
    }
</style>
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 via-blue-700 to-blue-500 overflow-hidden">
    <!-- Floating Shapes -->
    <div class="floating-shape floating-shape-sm bg-blue-300 rounded-full -top-10 -left-10"></div>
    <div class="floating-shape floating-shape-lg bg-blue-200 rounded-full top-20 right-10"></div>
    <div class="floating-shape floating-shape-md bg-blue-400 rounded-full bottom-20 left-20"></div>

    <!-- Login Card -->
    <div class="relative w-full max-w-md p-4 sm:p-8 bg-white/80 glassmorphism glassmorphism-fallback rounded-2xl shadow-2xl sm:hover:scale-102 transition-transform duration-300">
        <div class="text-center mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Admin Login</h1>
            <p class="text-gray-700 mt-2">Access your admin dashboard</p>
        </div>
        <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-900">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                       aria-describedby="email-error"
                       class="mt-1 block w-full px-4 py-3 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-white/80 placeholder-gray-700 @error('email') border-red-500 bg-red-50/50 @enderror"
                       placeholder="admin@example.com">
                @error('email')
                    <p id="email-error" class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                <input type="password" id="password" name="password" required
                       aria-describedby="password-error"
                       class="mt-1 block w-full px-4 py-3 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-white/80 placeholder-gray-700 @error('password') border-red-500 bg-red-50/50 @enderror"
                       placeholder="••••••••">
                @error('password')
                    <p id="password-error" class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between flex-wrap gap-2">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label>
                </div>
                <div>
                    <a href="{{ route('password.request') }}" class="text-sm text-white-600 hover:text-white-600 hover:text-blue-800 transition duration-200">Forgot Password?</a>
                </div>
            </div>
            <button type="submit"
                    class="w-full py-3 px-4 bg-gray-800 text-white font-semibold rounded-lg shadow-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                Sign In
            </button>
        </form>
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-700">Or sign in with</p>
            <div class="mt-4 flex justify-center space-x-4 sm:space-x-6">
                <button class="p-2 bg-white/80 glassmorphism glassmorphism-fallback rounded-lg hover:bg-white/90 transition duration-200">
                    <svg class="w-5 sm:w-6 h-5 sm:h-6 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                        <!-- Google icon SVG -->
                        <path d="M12.24 10.32v3.36h5.76c-.24 1.44-1.68 4.32-5.76 4.32-3.48 0-6.36-2.88-6.36-6.48s2.88-6.48 6.36-6.48c1.56 0 2.88.72 3.84 1.92l2.64-2.64C16.8 2.16 14.64 1 12.24 1 6.6 1 2 5.64 2 11.28s4.56 10.32 10.24 10.32c5.76 0 9.6-4.08 9.6-9.84 0-.72-.12-1.44-.24-2.16h-9.36z"/>
                    </svg>
                </button>
                <button class="p-2 bg-white/80 glassmorphism glassmorphism-fallback rounded-lg hover:bg-white/90 transition duration-200">
                    <svg class="w-5 sm:w-6 h-5 sm:h-6 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                        <!-- GitHub icon SVG -->
                        <path d="M12 2C6.48 2 2 6.48 2 12c0 4.42 2.88 8.14 6.84 9.49.5.09.68-.22.68-.48v-1.7c-2.78.61-3.36-1.34-3.36-1.34-.46-1.16-1.12-1.47-1.12-1.47-.91-.62.07-.61.07-.61 1.01.07 1.54 1.04 1.54 1.04.89 1.52 2.34 1.08 2.91.83.09-.65.35-1.08.64-1.33-2.22-.25-4.56-1.11-4.56-4.94 0-1.09.39-1.98 1.03-2.68-.1-.25-.45-1.27.1-2.65 0 0 .84-.27 2.75 1.03A9.564 9.564 0 0112 6.8c.85.004 1.71.11 2.52.33 1.91-1.3 2.75-1.03 2.75-1.03.55 1.38.2 2.4.1 2.65.64.7 1.03 1.59 1.03 2.68 0 3.84-2.34 4.69-4.57 4.94.36.31.68.94.68 1.9v2.82c0 .26.18.57.69.48A10.01 10.01 0 0022 12c0-5.52-4.48-10-10-10z"/>
                    </svg>
                </button>
                <button class="p-2 bg-white/80 glassmorphism glassmorphism-fallback rounded-lg hover:bg-white/90 transition duration-200">
                    <svg class="w-5 sm:w-6 h-5 sm:h-6 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                        <!-- Facebook icon SVG -->
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 22.954 24 17.99 24 12.073z"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-700">Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 transition duration-200">Sign up</a></p>
        </div>
    </div>
</div>
@endsection