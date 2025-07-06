<header class="glass-card sticky top-0 z-30 shadow-sm">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Mobile menu button -->
            <button id="mobileMenuButton" class="md:hidden text-gray-500 hover:text-gray-600 dark:hover:text-gray-300">
                <i class="fas fa-bars text-xl"></i>
            </button>
            
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-tv text-white"></i>
                </div>
                <span class="ml-2 text-xl font-bold hidden sm:inline-block">NeoVision</span>
            </div>
            
            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-8">
                <div class="dropdown relative">
                    <button class="flex items-center space-x-1 text-gray-700 dark:text-gray-300 hover:text-purple-500 dark:hover:text-purple-400 transition-colors">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                        <i class="fas fa-chevron-down text-xs mt-1"></i>
                    </button>
                    <div class="dropdown-menu absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Overview</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Analytics</a>
                        <div class="dropdown-sub relative">
                            <a href="#" class="flex justify-between items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span>Monitoring</span>
                                <i class="fas fa-chevron-right text-xs"></i>
                            </a>
                            <div class="sub-dropdown absolute left-full top-0 ml-1 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 glass-card border border-gray-200 dark:border-gray-700">
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Live Streams</a>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Server Status</a>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Bandwidth</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="dropdown relative">
                    <button class="flex items-center space-x-1 text-gray-700 dark:text-gray-300 hover:text-purple-500 dark:hover:text-purple-400 transition-colors">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                        <i class="fas fa-chevron-down text-xs mt-1"></i>
                    </button>
                    <div class="dropdown-menu absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">All Users</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Add New</a>
                        <div class="dropdown-sub relative">
                            <a href="#" class="flex justify-between items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span>Reports</span>
                                <i class="fas fa-chevron-right text-xs"></i>
                            </a>
                            <div class="sub-dropdown absolute left-full top-0 ml-1 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 glass-card border border-gray-200 dark:border-gray-700">
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Activity Log</a>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Device Usage</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="dropdown relative">
                    <button class="flex items-center space-x-1 text-gray-700 dark:text-gray-300 hover:text-purple-500 dark:hover:text-purple-400 transition-colors">
                        <i class="fas fa-tv"></i>
                        <span>Channels</span>
                        <i class="fas fa-chevron-down text-xs mt-1"></i>
                    </button>
                    <div class="dropdown-menu absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Live TV</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">EPG</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Categories</a>
                    </div>
                </div>
                
                <div class="dropdown relative">
                    <button class="flex items-center space-x-1 text-gray-700 dark:text-gray-300 hover:text-purple-500 dark:hover:text-purple-400 transition-colors">
                        <i class="fas fa-film"></i>
                        <span>VOD</span>
                        <i class="fas fa-chevron-down text-xs mt-1"></i>
                    </button>
                    <div class="dropdown-menu absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Movies</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Series</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Categories</a>
                    </div>
                </div>
            </nav>
            
            <!-- Right side elements -->
            <div class="flex items-center space-x-4">
                <!-- Search -->
                <div class="relative hidden md:block">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" class="block w-full pl-10 pr-3 py-2 bg-gray-100 dark:bg-gray-700 border border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Search...">
                </div>
                
                <!-- Language switcher -->
                <div class="dropdown relative">
                    <button class="flex items-center space-x-1 text-gray-700 dark:text-gray-300 hover:text-purple-500 dark:hover:text-purple-400 transition-colors">
                        <i class="fas fa-globe"></i>
                        <span class="hidden lg:inline">EN</span>
                    </button>
                    <div class="dropdown-menu absolute right-0 mt-2 w-32 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">English</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">French</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Spanish</a>
                    </div>
                </div>
                
                <!-- Notifications -->
                <div class="dropdown relative">
                    <button class="relative text-gray-700 dark:text-gray-300 hover:text-purple-500 dark:hover:text-purple-400 transition-colors">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full flex items-center justify-center text-white text-xs">3</span>
                    </button>
                    <div class="dropdown-menu absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                        <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700 font-medium">Notifications (3)</div>
                        <a href="#" class="block px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-1">
                                    <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user-plus text-purple-600 dark:text-purple-300"></i>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">New subscriber</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">John Doe subscribed to Premium plan</p>
                                    <p class="text-xs text-gray-400 mt-1">2 mins ago</p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="block px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-1">
                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                        <i class="fas fa-ticket-alt text-blue-600 dark:text-blue-300"></i>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">New support ticket</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">"Stream buffering issues"</p>
                                    <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="block px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-1">
                                    <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center">
                                        <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-300"></i>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">Server alert</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">High CPU usage on server-2</p>
                                    <p class="text-xs text-gray-400 mt-1">3 hours ago</p>
                                </div>
                            </div>
                        </a>
                        <div class="px-4 py-2 text-center">
                            <a href="#" class="text-sm text-purple-600 dark:text-purple-400 font-medium">View all notifications</a>
                        </div>
                    </div>
                </div>
                
                <!-- User profile -->
                <div class="dropdown relative">
                    <button class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white">
                            <span>AD</span>
                        </div>
                        <span class="hidden lg:inline text-gray-700 dark:text-gray-300">Admin</span>
                        <i class="fas fa-chevron-down text-xs mt-1 hidden lg:inline"></i>
                    </button>
                    <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 glass-card border border-gray-200 dark:border-gray-700">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Profile</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Settings</a>
                        <div class="border-t border-gray-200 dark:border-gray-700"></div>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Log out</a>
                    </div>
                </div>
                
                <!-- Dark mode toggle -->
                <button id="themeToggle" class="text-gray-700 dark:text-gray-300 hover:text-purple-500 dark:hover:text-purple-400 transition-colors">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:inline"></i>
                </button>
            </div>
        </div>
    </div>
</header>