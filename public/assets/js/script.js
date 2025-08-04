// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize all functionality
    initNavbar();
    initSearchFunctionality();
    initJobBookmarks();
    initAnimations();
    initPagination();
    initStatsCounter();
    initSmoothScrolling();
    initMobileMenu();
    
    console.log('Job Portal JavaScript loaded successfully!');
});

// Navbar functionality
function initNavbar() {
    const navbar = document.querySelector('.main-nav');
    const navLinks = document.querySelectorAll('.navbar-nav a');
    
    // Add active class to current nav item
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Remove active class from all links
            navLinks.forEach(l => l.classList.remove('active-first'));
            // Add active class to clicked link
            this.classList.add('active-first');
        });
    });
    
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            navbar.style.backdropFilter = 'blur(10px)';
        } else {
            navbar.style.backdropFilter = 'none';
        }
    });
}

// Search functionality
function initSearchFunctionality() {
    const searchBtn = document.querySelector('.search-job input[type="button"]');
    const searchInputs = document.querySelectorAll('.search-job input[type="text"]');
    
    if (searchBtn) {
        searchBtn.addEventListener('click', function() {
            const skills = searchInputs[0]?.value || '';
            const location = searchInputs[1]?.value || '';
            const experience = searchInputs[2]?.value || '';
            
            if (!skills && !location && !experience) {
                showNotification('Please enter at least one search criteria', 'warning');
                return;
            }
            
            // Show loading state
            const originalText = this.value;
            this.value = 'Searching...';
            this.disabled = true;
            
            // Simulate search (replace with actual API call)
            setTimeout(() => {
                this.value = originalText;
                this.disabled = false;
                showNotification(`Found jobs for: ${skills} in ${location}`, 'success');
                
                // Scroll to jobs section
                const jobsSection = document.getElementById('jobs');
                if (jobsSection) {
                    jobsSection.scrollIntoView({ behavior: 'smooth' });
                }
            }, 2000);
        });
    }
    
    // Enter key functionality
    searchInputs.forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchBtn.click();
            }
        });
    });
}

// Job bookmark functionality
function initJobBookmarks() {
    const bookmarks = document.querySelectorAll('.bookmark');
    
    bookmarks.forEach(bookmark => {
        bookmark.addEventListener('click', function(e) {
            e.preventDefault();
            
            const icon = this.querySelector('i');
            const text = this.querySelector('p');
            
            if (icon.classList.contains('fa-heart-o')) {
                icon.classList.remove('fa-heart-o');
                icon.classList.add('fa-heart');
                text.textContent = 'Saved';
                showNotification('Job saved to favorites!', 'success');
            } else {
                icon.classList.remove('fa-heart');
                icon.classList.add('fa-heart-o');
                text.textContent = 'Save Job';
                showNotification('Job removed from favorites!', 'info');
            }
        });
    });
}

// Apply button functionality
function initApplyButtons() {
    const applyButtons = document.querySelectorAll('.apply-btn .btn');
    
    applyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const jobTitle = this.closest('.company-details').querySelector('h4 strong').textContent;
            
            // Show loading state
            const originalText = this.textContent;
            this.innerHTML = '<span class="loading"></span> Applying...';
            this.disabled = true;
            
            // Simulate application process
            setTimeout(() => {
                this.textContent = 'Applied!';
                this.style.background = '#28a745';
                showNotification(`Successfully applied for ${jobTitle}!`, 'success');
                
                // Reset button after 3 seconds
                setTimeout(() => {
                    this.textContent = originalText;
                    this.style.background = '';
                    this.disabled = false;
                }, 3000);
            }, 2000);
        });
    });
}

// Animations
function initAnimations() {
    // Intersection Observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    const animateElements = document.querySelectorAll('.company-details, .stats-box, .jobcategory');
    animateElements.forEach(el => {
        observer.observe(el);
    });
    
    // Banner text animation
    const bannerText = document.querySelector('.banner h1');
    if (bannerText) {
        bannerText.style.opacity = '0';
        bannerText.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            bannerText.style.transition = 'all 1s ease';
            bannerText.style.opacity = '1';
            bannerText.style.transform = 'translateY(0)';
        }, 500);
    }
}

// Pagination functionality
function initPagination() {
    const paginationLinks = document.querySelectorAll('.pagelink li');
    
    paginationLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (this.classList.contains('right-arrow')) {
                // Handle navigation arrows
                const currentActive = document.querySelector('.pagelink li.active');
                const allPages = Array.from(paginationLinks).filter(l => !l.classList.contains('right-arrow'));
                
                if (this.textContent === '←') {
                    // Previous page
                    const currentIndex = allPages.indexOf(currentActive);
                    if (currentIndex > 0) {
                        currentActive.classList.remove('active');
                        allPages[currentIndex - 1].classList.add('active');
                    }
                } else {
                    // Next page
                    const currentIndex = allPages.indexOf(currentActive);
                    if (currentIndex < allPages.length - 1) {
                        currentActive.classList.remove('active');
                        allPages[currentIndex + 1].classList.add('active');
                    }
                }
            } else {
                // Handle number clicks
                paginationLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
                
                // Simulate page load
                showNotification('Loading page...', 'info');
                setTimeout(() => {
                    showNotification('Page loaded successfully!', 'success');
                }, 1000);
            }
        });
    });
}

// Stats counter animation
function initStatsCounter() {
    const statsBoxes = document.querySelectorAll('.stats-box span');
    
    const statsObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const finalValue = target.textContent;
                const numericValue = parseInt(finalValue.replace(/\D/g, ''));
                const suffix = finalValue.replace(/\d/g, '');
                
                animateCounter(target, 0, numericValue, suffix);
                statsObserver.unobserve(target);
            }
        });
    }, { threshold: 0.5 });
    
    statsBoxes.forEach(box => {
        statsObserver.observe(box);
    });
}

function animateCounter(element, start, end, suffix) {
    const duration = 2000;
    const increment = (end - start) / (duration / 16);
    let current = start;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= end) {
            current = end;
            clearInterval(timer);
        }
        element.textContent = Math.floor(current) + suffix;
    }, 16);
}

// Smooth scrolling
function initSmoothScrolling() {
    const navLinks = document.querySelectorAll('a[href^="#"]');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                const headerHeight = document.querySelector('.main-header').offsetHeight;
                const targetPosition = targetSection.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// Mobile menu functionality
function initMobileMenu() {
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarNav = document.querySelector('.navbar-nav');
    
    if (navbarToggler && navbarNav) {
        navbarToggler.addEventListener('click', function() {
            navbarNav.classList.toggle('active');
            
            // Animate hamburger icon
            const iconBars = this.querySelectorAll('.icon-bar');
            iconBars.forEach((bar, index) => {
                if (navbarNav.classList.contains('active')) {
                    if (index === 0) bar.style.transform = 'rotate(45deg) translate(5px, 5px)';
                    if (index === 1) bar.style.opacity = '0';
                    if (index === 2) bar.style.transform = 'rotate(-45deg) translate(7px, -6px)';
                } else {
                    bar.style.transform = 'none';
                    bar.style.opacity = '1';
                }
            });
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!navbarToggler.contains(e.target) && !navbarNav.contains(e.target)) {
                navbarNav.classList.remove('active');
                const iconBars = navbarToggler.querySelectorAll('.icon-bar');
                iconBars.forEach(bar => {
                    bar.style.transform = 'none';
                    bar.style.opacity = '1';
                });
            }
        });
    }
}

// Notification system
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notification => notification.remove());
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <span class="notification-message">${message}</span>
            <button class="notification-close">&times;</button>
        </div>
    `;
    
    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#28a745' : type === 'warning' ? '#ffc107' : type === 'error' ? '#dc3545' : '#17a2b8'};
        color: white;
        padding: 15px 20px;
        border-radius: 5px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 10000;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        max-width: 300px;
    `;
    
    // Add to page
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Close button functionality
    const closeBtn = notification.querySelector('.notification-close');
    closeBtn.addEventListener('click', () => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => notification.remove(), 300);
    });
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }
    }, 5000);
}

// Form validation
function validateForm(formElement) {
    const inputs = formElement.querySelectorAll('input[required], textarea[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.style.borderColor = '#dc3545';
            isValid = false;
        } else {
            input.style.borderColor = '#28a745';
        }
    });
    
    return isValid;
}

// Lazy loading for images
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
}

// Initialize apply buttons when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    initApplyButtons();
    initLazyLoading();
});

// Utility functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Export functions for global access
window.JobPortal = {
    showNotification,
    validateForm,
    debounce,
    throttle
}; 