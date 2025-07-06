<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('favicon.ico') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
            <!-- Dark Mode Toggle -->
            <button onclick="document.documentElement.classList.toggle('dark')" 
                    class="fixed top-4 right-4 p-2 rounded-full bg-white/80 dark:bg-gray-800/80 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </button>

            <!-- Logo -->
            <div class="mb-8">
                <a href="/" wire:navigate>
                    <x-application-logo class="w-20 h-20 fill-current text-gray-700 dark:text-gray-300" />
                </a>
            </div>

            <!-- Card Container -->
            <div class="w-full sm:max-w-md px-6 py-8">
                <x-mary-card class="shadow-xl overflow-hidden" title="Admin Portal" subtitle="Secure access to your dashboard">
                    {{ $slot }}

                    <!-- Footer Links -->
                    <div class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                        @if(Route::has('admin.password.request'))
                        <a href="{{ route('admin.password.request') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                            Forgot password?
                        </a>
                        @endif
                    </div>
                </x-mary-card>
            </div>

            <!-- Toast Notifications -->
            @if(session('status'))
                <x-mary-toast :title="session('status')" icon="o-information-circle" class="alert-info" />
            @endif

            @if(session('error'))
                <x-mary-toast :title="session('error')" icon="o-exclamation-triangle" class="alert-error" />
            @endif
        </div>
    </body>
</html>
