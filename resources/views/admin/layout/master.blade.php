<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeoVision - IPTV Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{asset('assets/admin/js/app.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/admin/css/admin.css')}}">
    @yield('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="dark:bg-gray-900 dark:text-gray-200 text-gray-800">
    <!-- Add Channel Modal -->
    <div id="addChannelModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="modal-overlay fixed inset-0 bg-black bg-opacity-50"></div>
        <div class="modal-content glass-card rounded-xl w-full max-w-md relative z-10 shadow-2xl border border-white border-opacity-20">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold">Add New Channel</h3>
                    <button id="closeModal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Channel Name</label>
                        <input type="text" class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium mb-1">Stream URL</label>
                        <input type="text" class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="https://">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium mb-1">Category</label>
                        <select class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option>Entertainment</option>
                            <option>Sports</option>
                            <option>News</option>
                            <option>Movies</option>
                            <option>Kids</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium mb-1">Channel Logo</label>
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                            <button class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg text-sm">Upload Image</button>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" id="isHD" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
                        <label for="isHD" class="ml-2 text-sm">HD Channel</label>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" id="isPremium" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
                        <label for="isPremium" class="ml-2 text-sm">Premium Channel</label>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end space-x-3">
                    <button class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg" id="closeModal">Cancel</button>
                    <button class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg">Add Channel</button>
                </div>
            </div>
        </div>
    </div>
     @include('admin.layout.inc.mobile')
    <div class="min-h-screen flex flex-col">
        <!-- Top Navigation -->
         @include('admin.layout.inc.header')
        <!-- Main Content -->
         <main class="flex-grow p-4 sm:p-6 lg:p-8">
           @yield('content')
        </main>
    </div>
    @include('admin.partials.scripts')
    @yield('scripts')
</body>
</html>