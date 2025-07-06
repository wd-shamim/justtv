<script>
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileOverlay = document.getElementById('mobileOverlay');
    const closeMobileMenu = document.getElementById('closeMobileMenu');
    
    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.add('open');
        mobileOverlay.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        document.documentElement.style.scrollBehavior = 'smooth';
    });
    
    closeMobileMenu.addEventListener('click', () => {
        mobileMenu.classList.remove('open');
        mobileOverlay.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });
    
    mobileOverlay.addEventListener('click', () => {
        mobileMenu.classList.remove('open');
        mobileOverlay.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });
    
    // Mobile submenu toggle
    document.querySelectorAll('.mobile-menu-item button').forEach(button => {
        button.addEventListener('click', (e) => {
            e.stopPropagation();
            const submenu = button.parentElement.querySelector('.mobile-submenu');
            const icon = button.querySelector('i');
            
            submenu.classList.toggle('open');
            icon.classList.toggle('rotate-180');
            
            // Close other open submenus at the same level
            const parentLi = button.closest('li');
            if (parentLi) {
                parentLi.parentElement.querySelectorAll('.mobile-menu-item').forEach(item => {
                    if (item !== button.parentElement) {
                        item.querySelector('.mobile-submenu')?.classList.remove('open');
                        item.querySelector('i')?.classList.remove('rotate-180');
                    }
                });
            }
        });
    });
    
    // Mobile submenu child toggle
    document.querySelectorAll('.mobile-submenu-item button').forEach(button => {
        button.addEventListener('click', (e) => {
            e.stopPropagation();
            const submenu = button.parentElement.querySelector('.mobile-submenu-child');
            const icon = button.querySelector('i');
            
            submenu.classList.toggle('open');
            icon.classList.toggle('rotate-180');
            
            // Close other open submenus at the same level
            const parentLi = button.closest('li');
            if (parentLi) {
                parentLi.parentElement.querySelectorAll('.mobile-submenu-item').forEach(item => {
                    if (item !== button.parentElement) {
                        item.querySelector('.mobile-submenu-child')?.classList.remove('open');
                        item.querySelector('i')?.classList.remove('rotate-180');
                    }
                });
            }
        });
    });
    
    // Dark mode toggle
    const themeToggle = document.getElementById('themeToggle');
    
    themeToggle.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark');
        
        // Save preference to localStorage
        if (document.documentElement.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
        
        // Update charts for dark/light mode
        updateChartsTheme();
    });
    
    // Check for saved theme preference
    if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
    
    // Add Channel Modal
    const addChannelBtn = document.getElementById('addChannelBtn');
    const addChannelModal = document.getElementById('addChannelModal');
    const closeModal = document.getElementById('closeModal');
    
    addChannelBtn.addEventListener('click', () => {
        addChannelModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });
    
    closeModal.addEventListener('click', () => {
        addChannelModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });
    
    // Close modal when clicking outside
    addChannelModal.addEventListener('click', (e) => {
        if (e.target === addChannelModal) {
            addChannelModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    });
    
    // Native-like touch interactions for mobile
    if ('ontouchstart' in window) {
        // Add active state for buttons
        document.querySelectorAll('button, a').forEach(element => {
            element.addEventListener('touchstart', () => {
                element.classList.add('active');
            });
            
            element.addEventListener('touchend', () => {
                element.classList.remove('active');
            });
        });
        
        // Prevent zooming on inputs
        document.querySelectorAll('input, select, textarea').forEach(element => {
            element.addEventListener('touchstart', (e) => {
                e.preventDefault();
            }, { passive: false });
        });
    }
    
    // Initialize charts
    let userGrowthChart, streamPerformanceChart;
    
    function initCharts() {
        const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
        const streamPerformanceCtx = document.getElementById('streamPerformanceChart').getContext('2d');
        
        const isDark = document.documentElement.classList.contains('dark');
        const gridColor = isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
        const textColor = isDark ? 'rgba(255, 255, 255, 0.7)' : 'rgba(0, 0, 0, 0.7)';
        
        // User Growth Chart (Week data by default)
        userGrowthChart = new Chart(userGrowthCtx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Active Users',
                    data: [850, 920, 1020, 1100, 1150, 1248, 1300],
                    borderColor: '#8b5cf6',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#8b5cf6',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: isDark ? '#1f2937' : '#ffffff',
                        titleColor: textColor,
                        bodyColor: textColor,
                        borderColor: gridColor,
                        borderWidth: 1
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: gridColor,
                            borderColor: gridColor
                        },
                        ticks: {
                            color: textColor
                        }
                    },
                    y: {
                        grid: {
                            color: gridColor,
                            borderColor: gridColor
                        },
                        ticks: {
                            color: textColor
                        }
                    }
                }
            }
        });
        
        // Stream Performance Chart (Live data by default)
        streamPerformanceChart = new Chart(streamPerformanceCtx, {
            type: 'bar',
            data: {
                labels: ['Sports', 'Movies', 'News', 'Kids', 'Documentary'],
                datasets: [{
                    label: 'Live Streams',
                    data: [1245, 982, 756, 632, 521],
                    backgroundColor: [
                        'rgba(139, 92, 246, 0.7)',
                        'rgba(99, 102, 241, 0.7)',
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(245, 158, 11, 0.7)'
                    ],
                    borderColor: [
                        'rgba(139, 92, 246, 1)',
                        'rgba(99, 102, 241, 1)',
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(245, 158, 11, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: isDark ? '#1f2937' : '#ffffff',
                        titleColor: textColor,
                        bodyColor: textColor,
                        borderColor: gridColor,
                        borderWidth: 1
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: gridColor,
                            borderColor: gridColor
                        },
                        ticks: {
                            color: textColor
                        }
                    },
                    y: {
                        grid: {
                            color: gridColor,
                            borderColor: gridColor
                        },
                        ticks: {
                            color: textColor
                        }
                    }
                }
            }
        });
    }
    
    // Update charts theme when switching between dark/light mode
    function updateChartsTheme() {
        const isDark = document.documentElement.classList.contains('dark');
        const gridColor = isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
        const textColor = isDark ? 'rgba(255, 255, 255, 0.7)' : 'rgba(0, 0, 0, 0.7)';
        
        if (userGrowthChart) {
            userGrowthChart.options.scales.x.grid.color = gridColor;
            userGrowthChart.options.scales.x.grid.borderColor = gridColor;
            userGrowthChart.options.scales.x.ticks.color = textColor;
            userGrowthChart.options.scales.y.grid.color = gridColor;
            userGrowthChart.options.scales.y.grid.borderColor = gridColor;
            userGrowthChart.options.scales.y.ticks.color = textColor;
            userGrowthChart.options.plugins.tooltip.backgroundColor = isDark ? '#1f2937' : '#ffffff';
            userGrowthChart.options.plugins.tooltip.titleColor = textColor;
            userGrowthChart.options.plugins.tooltip.bodyColor = textColor;
            userGrowthChart.options.plugins.tooltip.borderColor = gridColor;
            userGrowthChart.update();
        }
        
        if (streamPerformanceChart) {
            streamPerformanceChart.options.scales.x.grid.color = gridColor;
            streamPerformanceChart.options.scales.x.grid.borderColor = gridColor;
            streamPerformanceChart.options.scales.x.ticks.color = textColor;
            streamPerformanceChart.options.scales.y.grid.color = gridColor;
            streamPerformanceChart.options.scales.y.grid.borderColor = gridColor;
            streamPerformanceChart.options.scales.y.ticks.color = textColor;
            streamPerformanceChart.options.plugins.tooltip.backgroundColor = isDark ? '#1f2937' : '#ffffff';
            streamPerformanceChart.options.plugins.tooltip.titleColor = textColor;
            streamPerformanceChart.options.plugins.tooltip.bodyColor = textColor;
            streamPerformanceChart.options.plugins.tooltip.borderColor = gridColor;
            streamPerformanceChart.update();
        }
    }
    
    // User Growth Chart Time Period Toggle
    const weekBtn = document.getElementById('weekBtn');
    const monthBtn = document.getElementById('monthBtn');
    const yearBtn = document.getElementById('yearBtn');
    
    weekBtn.addEventListener('click', () => {
        weekBtn.classList.add('bg-purple-600', 'bg-opacity-10', 'text-purple-600', 'dark:text-purple-400');
        weekBtn.classList.remove('bg-gray-200', 'dark:bg-gray-700');
        monthBtn.classList.remove('bg-purple-600', 'bg-opacity-10', 'text-purple-600', 'dark:text-purple-400');
        monthBtn.classList.add('bg-gray-200', 'dark:bg-gray-700');
        yearBtn.classList.remove('bg-purple-600', 'bg-opacity-10', 'text-purple-600', 'dark:text-purple-400');
        yearBtn.classList.add('bg-gray-200', 'dark:bg-gray-700');
        
        // Update chart data for week
        userGrowthChart.data.labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        userGrowthChart.data.datasets[0].data = [850, 920, 1020, 1100, 1150, 1248, 1300];
        userGrowthChart.update();
    });
    
    monthBtn.addEventListener('click', () => {
        monthBtn.classList.add('bg-purple-600', 'bg-opacity-10', 'text-purple-600', 'dark:text-purple-400');
        monthBtn.classList.remove('bg-gray-200', 'dark:bg-gray-700');
        weekBtn.classList.remove('bg-purple-600', 'bg-opacity-10', 'text-purple-600', 'dark:text-purple-400');
        weekBtn.classList.add('bg-gray-200', 'dark:bg-gray-700');
        yearBtn.classList.remove('bg-purple-600', 'bg-opacity-10', 'text-purple-600', 'dark:text-purple-400');
        yearBtn.classList.add('bg-gray-200', 'dark:bg-gray-700');
        
        // Update chart data for month
        userGrowthChart.data.labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
        userGrowthChart.data.datasets[0].data = [3200, 3500, 3800, 4200];
        userGrowthChart.update();
    });
    
    yearBtn.addEventListener('click', () => {
        yearBtn.classList.add('bg-purple-600', 'bg-opacity-10', 'text-purple-600', 'dark:text-purple-400');
        yearBtn.classList.remove('bg-gray-200', 'dark:bg-gray-700');
        weekBtn.classList.remove('bg-purple-600', 'bg-opacity-10', 'text-purple-600', 'dark:text-purple-400');
        weekBtn.classList.add('bg-gray-200', 'dark:bg-gray-700');
        monthBtn.classList.remove('bg-purple-600', 'bg-opacity-10', 'text-purple-600', 'dark:text-purple-400');
        monthBtn.classList.add('bg-gray-200', 'dark:bg-gray-700');
        
        // Update chart data for year
        userGrowthChart.data.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        userGrowthChart.data.datasets[0].data = [12000, 12500, 13200, 14000, 14800, 15500, 16200, 17000, 17800, 18500, 19200, 20000];
        userGrowthChart.update();
    });
    
    // Stream Performance Chart Type Toggle
    const liveBtn = document.getElementById('liveBtn');
    const vodBtn = document.getElementById('vodBtn');
    
    liveBtn.addEventListener('click', () => {
        liveBtn.classList.add('bg-purple-600', 'bg-opacity-10', 'text-purple-600', 'dark:text-purple-400');
        liveBtn.classList.remove('bg-gray-200', 'dark:bg-gray-700');
        vodBtn.classList.remove('bg-purple-600', 'bg-opacity-10', 'text-purple-600', 'dark:text-purple-400');
        vodBtn.classList.add('bg-gray-200', 'dark:bg-gray-700');
        
        // Update chart data for live streams
        streamPerformanceChart.data.datasets[0].label = 'Live Streams';
        streamPerformanceChart.data.datasets[0].data = [1245, 982, 756, 632, 521];
        streamPerformanceChart.update();
    });
    
    vodBtn.addEventListener('click', () => {
        vodBtn.classList.add('bg-purple-600', 'bg-opacity-10', 'text-purple-600', 'dark:text-purple-400');
        vodBtn.classList.remove('bg-gray-200', 'dark:bg-gray-700');
        liveBtn.classList.remove('bg-purple-600', 'bg-opacity-10', 'text-purple-600', 'dark:text-purple-400');
        liveBtn.classList.add('bg-gray-200', 'dark:bg-gray-700');
        
        // Update chart data for VOD
        streamPerformanceChart.data.datasets[0].label = 'VOD Views';
        streamPerformanceChart.data.datasets[0].data = [850, 720, 680, 590, 510];
        streamPerformanceChart.update();
    });
    
    // Channel options dropdown
    document.querySelectorAll('.channel-options-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const dropdown = btn.nextElementSibling;
            
            // Close all other dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu !== dropdown) {
                    menu.classList.remove('opacity-100', 'visible', 'translate-y-0');
                    menu.classList.add('opacity-0', 'invisible');
                }
            });
            
            // Toggle current dropdown
            dropdown.classList.toggle('opacity-0');
            dropdown.classList.toggle('invisible');
            dropdown.classList.toggle('opacity-100');
            dropdown.classList.toggle('visible');
        });
    });
    
    // Manage user dropdown
    document.querySelectorAll('.manage-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const dropdown = btn.nextElementSibling;
            
            // Close all other dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu !== dropdown) {
                    menu.classList.remove('opacity-100', 'visible', 'translate-y-0');
                    menu.classList.add('opacity-0', 'invisible');
                }
            });
            
            // Toggle current dropdown
            dropdown.classList.toggle('opacity-0');
            dropdown.classList.toggle('invisible');
            dropdown.classList.toggle('opacity-100');
            dropdown.classList.toggle('visible');
        });
    });
    
    // Ticket options dropdown
    document.querySelectorAll('.ticket-options-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const dropdown = btn.nextElementSibling;
            
            // Close all other dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu !== dropdown) {
                    menu.classList.remove('opacity-100', 'visible', 'translate-y-0');
                    menu.classList.add('opacity-0', 'invisible');
                }
            });
            
            // Toggle current dropdown
            dropdown.classList.toggle('opacity-0');
            dropdown.classList.toggle('invisible');
            dropdown.classList.toggle('opacity-100');
            dropdown.classList.toggle('visible');
        });
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', () => {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.remove('opacity-100', 'visible', 'translate-y-0');
            menu.classList.add('opacity-0', 'invisible');
        });
    });
    
    // Prevent dropdown from closing when clicking inside
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
        menu.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    });
    
    // Initialize charts when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
        initCharts();
    });
</script>