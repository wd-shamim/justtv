@extends('admin.layout.master')
@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Page title and actions -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold">Dashboard Overview</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Welcome back, Admin. Here's what's happening with your IPTV service.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button id="addChannelBtn" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                <i class="fas fa-plus"></i>
                <span>Add Channel</span>
            </button>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Active Users -->
        <div class="glass-card rounded-xl p-6 shadow-glow-sm hover:shadow-glow transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Users</p>
                    <h3 class="text-2xl font-bold mt-1">1,248</h3>
                    <p class="text-sm text-green-500 flex items-center mt-2">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>12.5% from yesterday</span>
                    </p>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-purple-500 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Total Revenue -->
        <div class="glass-card rounded-xl p-6 shadow-glow-sm hover:shadow-glow transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Revenue</p>
                    <h3 class="text-2xl font-bold mt-1">$24,890</h3>
                    <p class="text-sm text-green-500 flex items-center mt-2">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>8.2% from last month</span>
                    </p>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-green-500 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Subscriptions -->
        <div class="glass-card rounded-xl p-6 shadow-glow-sm hover:shadow-glow transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Subscriptions</p>
                    <h3 class="text-2xl font-bold mt-1">3,456</h3>
                    <p class="text-sm text-red-500 flex items-center mt-2">
                        <i class="fas fa-arrow-down mr-1"></i>
                        <span>2.3% from last week</span>
                    </p>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-file-invoice text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Stream Quality -->
        <div class="glass-card rounded-xl p-6 shadow-glow-sm hover:shadow-glow transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Stream Quality</p>
                    <h3 class="text-2xl font-bold mt-1">98.7%</h3>
                    <p class="text-sm text-green-500 flex items-center mt-2">
                        <i class="fas fa-check-circle mr-1"></i>
                        <span>Excellent</span>
                    </p>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-signal text-yellow-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- User Growth Chart -->
        <div class="glass-card rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold">User Growth</h3>
                <div class="flex space-x-2">
                    <button id="weekBtn" class="px-3 py-1 text-xs bg-purple-600 bg-opacity-10 text-purple-600 dark:text-purple-400 rounded-lg">Week</button>
                    <button id="monthBtn" class="px-3 py-1 text-xs bg-gray-200 dark:bg-gray-700 rounded-lg">Month</button>
                    <button id="yearBtn" class="px-3 py-1 text-xs bg-gray-200 dark:bg-gray-700 rounded-lg">Year</button>
                </div>
            </div>
            <div class="h-64">
                <canvas id="userGrowthChart"></canvas>
            </div>
        </div>
        
        <!-- Stream Performance -->
        <div class="glass-card rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold">Stream Performance</h3>
                <div class="flex space-x-2">
                    <button id="liveBtn" class="px-3 py-1 text-xs bg-purple-600 bg-opacity-10 text-purple-600 dark:text-purple-400 rounded-lg">Live</button>
                    <button id="vodBtn" class="px-3 py-1 text-xs bg-gray-200 dark:bg-gray-700 rounded-lg">VOD</button>
                </div>
            </div>
            <div class="h-64">
                <canvas id="streamPerformanceChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity & Top Channels -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Recent Activity -->
        <div class="glass-card rounded-xl p-6 lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold">Recent Activity</h3>
                <button class="text-purple-600 dark:text-purple-400 text-sm font-medium">View All</button>
            </div>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-plus text-purple-600 dark:text-purple-300"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="font-medium">New subscriber</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Sarah Johnson subscribed to Basic plan</p>
                        <p class="text-xs text-gray-400 mt-1">10 minutes ago</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                            <i class="fas fa-ticket-alt text-blue-600 dark:text-blue-300"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="font-medium">Support ticket</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">"Audio sync issues on channel 45"</p>
                        <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                            <i class="fas fa-credit-card text-green-600 dark:text-green-300"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="font-medium">Payment received</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">$9.99 from Michael Brown (Premium plan)</p>
                        <p class="text-xs text-gray-400 mt-1">3 hours ago</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-300"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="font-medium">Stream issue</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Buffering reported on Sports HD channel</p>
                        <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Top Channels -->
        <div class="glass-card rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold">Top Channels</h3>
                <button class="text-purple-600 dark:text-purple-400 text-sm font-medium">View All</button>
            </div>
            <div class="space-y-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 relative">
                        <img src="https://via.placeholder.com/40" alt="Channel logo" class="w-10 h-10 rounded-lg">
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full border-2 border-white dark:border-gray-800"></span>
                    </div>
                    <div class="ml-4 flex-grow">
                        <p class="font-medium">Sports HD</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">1,245 viewers</p>
                    </div>
                    <div class="dropdown relative">
                        <button class="text-purple-600 dark:text-purple-400 channel-options-btn">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">View Details</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Edit Channel</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-red-500">Remove</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex-shrink-0 relative">
                        <img src="https://via.placeholder.com/40" alt="Channel logo" class="w-10 h-10 rounded-lg">
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></span>
                    </div>
                    <div class="ml-4 flex-grow">
                        <p class="font-medium">Movie Premiere</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">982 viewers</p>
                    </div>
                    <div class="dropdown relative">
                        <button class="text-purple-600 dark:text-purple-400 channel-options-btn">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">View Details</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Edit Channel</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-red-500">Remove</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex-shrink-0 relative">
                        <img src="https://via.placeholder.com/40" alt="Channel logo" class="w-10 h-10 rounded-lg">
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></span>
                    </div>
                    <div class="ml-4 flex-grow">
                        <p class="font-medium">News 24</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">756 viewers</p>
                    </div>
                    <div class="dropdown relative">
                        <button class="text-purple-600 dark:text-purple-400 channel-options-btn">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">View Details</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Edit Channel</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-red-500">Remove</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex-shrink-0 relative">
                        <img src="https://via.placeholder.com/40" alt="Channel logo" class="w-10 h-10 rounded-lg">
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></span>
                    </div>
                    <div class="ml-4 flex-grow">
                        <p class="font-medium">Kids Zone</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">632 viewers</p>
                    </div>
                    <div class="dropdown relative">
                        <button class="text-purple-600 dark:text-purple-400 channel-options-btn">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">View Details</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Edit Channel</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-red-500">Remove</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex-shrink-0 relative">
                        <img src="https://via.placeholder.com/40" alt="Channel logo" class="w-10 h-10 rounded-lg">
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></span>
                    </div>
                    <div class="ml-4 flex-grow">
                        <p class="font-medium">Documentary</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">521 viewers</p>
                    </div>
                    <div class="dropdown relative">
                        <button class="text-purple-600 dark:text-purple-400 channel-options-btn">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">View Details</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Edit Channel</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-red-500">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Subscribers -->
    <div class="glass-card rounded-xl p-6 mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h3 class="font-bold">Recent Subscribers</h3>
            <div class="search-filter-container flex space-x-3 mt-4 md:mt-0">
                <div class="relative">
                    <input type="text" placeholder="Search..." class="pl-8 pr-4 py-2 bg-gray-100 dark:bg-gray-700 border border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <button class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center space-x-2">
                    <i class="fas fa-filter"></i>
                    <span>Filter</span>
                </button>
            </div>
        </div>
        <div class="overflow-x-auto table-hover-scroll">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Plan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Subscription Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Devices</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="font-medium">John Smith</div>
                                    <div class="text-gray-500 dark:text-gray-400">john@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 rounded-full">Premium</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400">
                            May 15, 2023
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full">Active</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex -space-x-2">
                                <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://via.placeholder.com/24" alt="">
                                <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://via.placeholder.com/24" alt="">
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="dropdown relative inline-block">
                                <button class="text-purple-600 dark:text-purple-400 hover:text-purple-900 dark:hover:text-purple-300 manage-btn">Manage</button>
                                <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">View Profile</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Edit Subscription</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-red-500">Suspend</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="font-medium">Sarah Johnson</div>
                                    <div class="text-gray-500 dark:text-gray-400">sarah@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full">Basic</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400">
                            May 14, 2023
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full">Active</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex -space-x-2">
                                <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://via.placeholder.com/24" alt="">
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="dropdown relative inline-block">
                                <button class="text-purple-600 dark:text-purple-400 hover:text-purple-900 dark:hover:text-purple-300 manage-btn">Manage</button>
                                <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">View Profile</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Edit Subscription</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-red-500">Suspend</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="font-medium">Michael Brown</div>
                                    <div class="text-gray-500 dark:text-gray-400">michael@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 rounded-full">Premium</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400">
                            May 12, 2023
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full">Pending</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex -space-x-2">
                                <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://via.placeholder.com/24" alt="">
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="dropdown relative inline-block">
                                <button class="text-purple-600 dark:text-purple-400 hover:text-purple-900 dark:hover:text-purple-300 manage-btn">Manage</button>
                                <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">View Profile</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Edit Subscription</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-red-500">Suspend</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="font-medium">Emily Davis</div>
                                    <div class="text-gray-500 dark:text-gray-400">emily@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full">Family</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400">
                            May 10, 2023
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-full">Expired</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex -space-x-2">
                                <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://via.placeholder.com/24" alt="">
                                <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://via.placeholder.com/24" alt="">
                                <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://via.placeholder.com/24" alt="">
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="dropdown relative inline-block">
                                <button class="text-purple-600 dark:text-purple-400 hover:text-purple-900 dark:hover:text-purple-300 manage-btn">Manage</button>
                                <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">View Profile</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Edit Subscription</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-red-500">Suspend</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="font-medium">David Wilson</div>
                                    <div class="text-gray-500 dark:text-gray-400">david@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full">Basic</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400">
                            May 8, 2023
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full">Active</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex -space-x-2">
                                <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://via.placeholder.com/24" alt="">
                                <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://via.placeholder.com/24" alt="">
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="dropdown relative inline-block">
                                <button class="text-purple-600 dark:text-purple-400 hover:text-purple-900 dark:hover:text-purple-300 manage-btn">Manage</button>
                                <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">View Profile</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Edit Subscription</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-red-500">Suspend</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4">
            <div class="text-sm text-gray-500 dark:text-gray-400 mb-2 sm:mb-0">
                Showing 1 to 5 of 24 entries
            </div>
            <div class="flex space-x-2">
                <button class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded-lg">Previous</button>
                <button class="px-3 py-1 bg-purple-600 text-white rounded-lg">1</button>
                <button class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded-lg">2</button>
                <button class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded-lg">3</button>
                <button class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded-lg">Next</button>
            </div>
        </div>
    </div>
    
    <!-- Support Tickets -->
    <div class="glass-card rounded-xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-bold">Recent Support Tickets</h3>
            <button class="text-purple-600 dark:text-purple-400 text-sm font-medium">View All</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="glass-card rounded-lg p-4 border border-gray-200 dark:border-gray-700 hover:border-purple-500 transition-colors">
                <div class="flex items-start justify-between">
                    <div>
                        <span class="px-2 py-1 text-xs font-semibold bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full mb-2 inline-block">Pending</span>
                        <h4 class="font-medium">Buffering issues</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">User reports constant buffering on sports channels</p>
                    </div>
                    <div class="dropdown relative">
                        <button class="text-gray-400 hover:text-purple-500 ticket-options-btn">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">View Details</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Assign to Me</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-red-500">Close Ticket</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <img src="https://via.placeholder.com/32" alt="User" class="w-6 h-6 rounded-full mr-2">
                        <span class="text-sm">John Smith</span>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400">2 hours ago</span>
                </div>
            </div>
            <div class="glass-card rounded-lg p-4 border border-gray-200 dark:border-gray-700 hover:border-purple-500 transition-colors">
                <div class="flex items-start justify-between">
                    <div>
                        <span class="px-2 py-1 text-xs font-semibold bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full mb-2 inline-block">In Progress</span>
                        <h4 class="font-medium">Audio sync problem</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Audio is out of sync on movie channels</p>
                    </div>
                    <div class="dropdown relative">
                        <button class="text-gray-400 hover:text-purple-500 ticket-options-btn">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">View Details</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Assign to Me</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-red-500">Close Ticket</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <img src="https://via.placeholder.com/32" alt="User" class="w-6 h-6 rounded-full mr-2">
                        <span class="text-sm">Sarah Johnson</span>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400">5 hours ago</span>
                </div>
            </div>
            <div class="glass-card rounded-lg p-4 border border-gray-200 dark:border-gray-700 hover:border-purple-500 transition-colors">
                <div class="flex items-start justify-between">
                    <div>
                        <span class="px-2 py-1 text-xs font-semibold bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full mb-2 inline-block">Resolved</span>
                        <h4 class="font-medium">Login issues</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Cannot login to account after update</p>
                    </div>
                    <div class="dropdown relative">
                        <button class="text-gray-400 hover:text-purple-500 ticket-options-btn">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">View Details</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Reopen Ticket</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">View Solution</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <img src="https://via.placeholder.com/32" alt="User" class="w-6 h-6 rounded-full mr-2">
                        <span class="text-sm">Michael Brown</span>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400">1 day ago</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection