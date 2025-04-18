// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap components
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Channel selection handling
    document.querySelectorAll('.live-channel-item').forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all items
            document.querySelectorAll('.live-channel-item').forEach(i => {
                i.classList.remove('active');
            });
            
            // Add active class to clicked item
            this.classList.add('active');
            
            // Get channel data
            const channelName = this.querySelector('.live-channel-name').textContent;
            const channelLogo = this.querySelector('.live-channel-logo').src;
            
            // Get the stream URL for the selected channel
            const videoUrl = channelStreams[channelName];
            
            if (videoUrl) {
                // Load and play video
                loadVideo(videoUrl, channelName, channelLogo);
            } else {
                console.error('No stream URL found for channel:', channelName);
            }
            
            // On mobile, close the channel list after selection
            if (window.innerWidth <= 992) {
                toggleMenu();
            }
        });
    });

    // Initialize with first channel
    const firstChannel = document.querySelector('.live-channel-item');
    if (firstChannel) {
        firstChannel.click();
    }

    // Mobile menu toggle
    const toggleBtn = document.querySelector('.live-toggle-btn');
    const channelList = document.querySelector('.live-channel-list');
    const contentArea = document.querySelector('.live-content-area');
    const overlay = document.querySelector('.live-overlay');
    const toggleIcon = toggleBtn.querySelector('i');
    
    // Toggle menu function
    function toggleMenu() {
        channelList.classList.toggle('show');
        contentArea.classList.toggle('shifted');
        overlay.classList.toggle('show');
        
        // Change icon based on menu state
        if (channelList.classList.contains('show')) {
            toggleIcon.classList.remove('fa-bars');
            toggleIcon.classList.add('fa-times');
        } else {
            toggleIcon.classList.remove('fa-times');
            toggleIcon.classList.add('fa-bars');
        }
    }
    
    // Toggle button click
    toggleBtn.addEventListener('click', toggleMenu);
    
    // Close menu when clicking overlay
    overlay.addEventListener('click', toggleMenu);
    
    // Close menu when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth <= 992) {
            if (!channelList.contains(event.target) && 
                !toggleBtn.contains(event.target) && 
                channelList.classList.contains('show')) {
                toggleMenu();
            }
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 992) {
            channelList.classList.remove('show');
            contentArea.classList.remove('shifted');
            overlay.classList.remove('show');
            toggleIcon.classList.remove('fa-times');
            toggleIcon.classList.add('fa-bars');
        }
    });

    // Timezone handling
    const timezoneSelect = document.querySelector('.live-timezone-select');
    const currentTimeDisplay = document.querySelector('.live-current-time');

    function updateCurrentTime() {
        const now = new Date();
        const options = { 
            hour: '2-digit', 
            minute: '2-digit',
            hour12: true 
        };
        currentTimeDisplay.textContent = now.toLocaleTimeString('en-US', options);
    }

    // Update time every second
    setInterval(updateCurrentTime, 1000);
    updateCurrentTime();

    // Handle timezone change
    timezoneSelect.addEventListener('change', function() {
        // Here you would typically update the time based on the selected timezone
        // For now, we'll just update the display
        updateCurrentTime();
    });

    // Handle watch button clicks
    const watchButtons = document.querySelectorAll('.live-watch-btn');
    watchButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent channel item click
            const channelItem = this.closest('.live-channel-item');
            channelItem.click(); // Trigger channel selection
        });
    });

    // Add CSS for overlay
    const style = document.createElement('style');
    style.textContent = `
        .live-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 998;
        }
        
        .live-toggle-btn {
            position: fixed;
            top: 70px;
            left: 10px;
            z-index: 999;
        }
        
        .live-channel-item.active {
            background-color: #ff9900;
        }
        
        .live-channel-item.active .live-channel-name,
        .live-channel-item.active .live-watch-btn {
            color: #000000;
        }
    `;
    document.head.appendChild(style);

    // Add smooth scrolling to all links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Handle mobile menu
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler && navbarCollapse) {
        navbarToggler.addEventListener('click', function() {
            navbarCollapse.classList.toggle('show');
        });
    }

    // Channel Navigation Scroll
    const scrollContainer = document.querySelector('.live-channel-scroll-container');
    const scrollItems = document.querySelector('.live-channel-scroll-items');
    const leftArrow = document.querySelector('.live-channel-nav-arrow-btn.left-arrow');
    const rightArrow = document.querySelector('.live-channel-nav-arrow-btn.right-arrow');
    const channelItems = document.querySelectorAll('.live-channel-nav-item');
    
    // Calculate scroll step based on item width and gap
    function calculateScrollStep() {
        if (channelItems.length === 0) return 0;
        const itemWidth = channelItems[0].offsetWidth;
        const gap = 12; // Same as CSS gap
        return (itemWidth + gap) * 3; // Scroll 3 items at a time
    }

    // Hide left arrow initially
    leftArrow.classList.add('hidden');

    // Function to check if we can scroll left
    function canScrollLeft() {
        return scrollContainer.scrollLeft > 0;
    }

    // Function to check if we can scroll right
    function canScrollRight() {
        return scrollContainer.scrollLeft < (scrollItems.scrollWidth - scrollContainer.clientWidth - 1);
    }

    // Function to update arrow visibility
    function updateArrows() {
        leftArrow.classList.toggle('hidden', !canScrollLeft());
        rightArrow.classList.toggle('hidden', !canScrollRight());
    }

    // Scroll left
    leftArrow.addEventListener('click', function() {
        const scrollStep = calculateScrollStep();
        scrollContainer.scrollBy({
            left: -scrollStep,
            behavior: 'smooth'
        });
    });

    // Scroll right
    rightArrow.addEventListener('click', function() {
        const scrollStep = calculateScrollStep();
        scrollContainer.scrollBy({
            left: scrollStep,
            behavior: 'smooth'
        });
    });

    // Update arrows on scroll
    scrollContainer.addEventListener('scroll', updateArrows);

    // Update arrows on resize
    window.addEventListener('resize', function() {
        updateArrows();
    });

    // Initial check
    updateArrows();
}); 