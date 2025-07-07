<!-- Mobile Sidebar Overlay -->
<div id="mobileOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

<!-- Mobile Sidebar -->
<div id="mobileMenu" class="mobile-menu fixed inset-y-0 left-0 w-80 bg-gray-800 bg-opacity-90 backdrop-filter backdrop-blur-lg z-50 p-4 shadow-2xl overflow-y-auto">
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                <i class="fas fa-tv text-white"></i>
            </div>
            <span class="text-xl font-bold">NeoVision</span>
        </div>
        <button id="closeMobileMenu" class="text-gray-400 hover:text-white">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <nav>
        <ul class="space-y-1">
            <li>
                <a href="#" class="flex items-center justify-between px-4 py-3 rounded-lg bg-purple-600 bg-opacity-20 text-white">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>
            <li>
                <div class="mobile-menu-item">
                    <button class="flex items-center justify-between w-full px-4 py-3 rounded-lg hover:bg-gray-700 hover:bg-opacity-50">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-users w-5"></i>
                            <span>Users</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                    </button>
                    <div class="mobile-submenu pl-8">
                        <ul class="space-y-1 py-1">
                            <li><a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-700 hover:bg-opacity-30">All Users</a></li>
                            <li><a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-700 hover:bg-opacity-30">Add New</a></li>
                            <li>
                                <div class="mobile-submenu-item">
                                    <button class="flex items-center justify-between w-full px-4 py-2 rounded-lg hover:bg-gray-700 hover:bg-opacity-30">
                                        <span>Reports</span>
                                        <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                                    </button>
                                    <div class="mobile-submenu-child pl-4">
                                        <ul class="space-y-1 py-1">
                                            <li><a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-700 hover:bg-opacity-30">Activity Log</a></li>
                                            <li><a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-700 hover:bg-opacity-30">Device Usage</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <div class="mobile-menu-item">
                    <button class="flex items-center justify-between w-full px-4 py-3 rounded-lg hover:bg-gray-700 hover:bg-opacity-50">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-tv w-5"></i>
                            <span>Channels</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                    </button>
                    <div class="mobile-submenu pl-8">
                        <ul class="space-y-1 py-1">
                            <li><a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-700 hover:bg-opacity-30">Live TV</a></li>
                            <li><a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-700 hover:bg-opacity-30">EPG</a></li>
                            <li><a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-700 hover:bg-opacity-30">Categories</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <div class="mobile-menu-item">
                    <button class="flex items-center justify-between w-full px-4 py-3 rounded-lg hover:bg-gray-700 hover:bg-opacity-50">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-film w-5"></i>
                            <span>VOD</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                    </button>
                    <div class="mobile-submenu pl-8">
                        <ul class="space-y-1 py-1">
                            <li><a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-700 hover:bg-opacity-30">Movies</a></li>
                            <li><a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-700 hover:bg-opacity-30">Series</a></li>
                            <li><a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-700 hover:bg-opacity-30">Categories</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 hover:bg-opacity-50">
                    <i class="fas fa-file-invoice-dollar w-5"></i>
                    <span>Billing</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 hover:bg-opacity-50">
                    <i class="fas fa-cog w-5"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    </nav>
</div>