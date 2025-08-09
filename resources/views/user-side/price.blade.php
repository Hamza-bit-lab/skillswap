<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestige Pricing - Modern Pricing Table</title>
    <meta name="description" content="A modern, interactive pricing table with smooth animations, feature comparison, and responsive design. Perfect for SaaS products and subscription services.">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<style>
    :root {
    /* Colors */
    --primary: #6366f1;
    --primary-dark: #4f46e5;
    --secondary: #8b5cf6;
    --accent: #ec4899;
    --text-dark: #1f2937;
    --text-light: #4b5563;
    --bg-light: #f8f9fa;
    --white: #ffffff;
    --black: #000000;
    
    /* Shadows */
    --shadow-sm: 0 2px 5px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 5px 15px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.1);
    --shadow-glow: 0 0 20px rgba(99, 102, 241, 0.3);
    
    /* Transitions */
    --transition: all 0.3s ease;
    --transition-slow: all 0.5s ease;
    
    /* Border Radius */
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 20px;
    
    /* Spacing */
    --spacing-xs: 0.5rem;
    --spacing-sm: 1rem;
    --spacing-md: 1.5rem;
    --spacing-lg: 2rem;
    --spacing-xl: 3rem;
}

/* Reset & Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    background: var(--bg-light);
    color: var(--text-dark);
    min-height: 100vh;
    line-height: 1.6;
    overflow-x: hidden;
}

/* Custom Cursor */
.cursor {
    width: 20px;
    height: 20px;
    border: 2px solid var(--primary);
    border-radius: 50%;
    position: fixed;
    pointer-events: none;
    z-index: 9999;
    transition: transform 0.2s ease;
}

.cursor-follower {
    width: 8px;
    height: 8px;
    background: var(--primary);
    border-radius: 50%;
    position: fixed;
    pointer-events: none;
    z-index: 9999;
    transition: transform 0.1s ease;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: var(--spacing-xl);
}

/* Header */
.header {
    text-align: center;
    margin-bottom: var(--spacing-xl);
}

.title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: var(--spacing-sm);
    background: linear-gradient(45deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.subtitle {
    font-size: 1.2rem;
    color: var(--text-light);
    margin-bottom: var(--spacing-lg);
}

/* Pricing Toggle */
.pricing-toggle {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--spacing-md);
    margin-bottom: var(--spacing-xl);
}

.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: var(--transition);
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: var(--transition);
    border-radius: 50%;
}

input:checked + .slider {
    background: linear-gradient(45deg, var(--primary), var(--secondary));
}

input:checked + .slider:before {
    transform: translateX(26px);
}

.discount {
    background: var(--accent);
    color: var(--white);
    padding: 2px 8px;
    border-radius: 20px;
    font-size: 0.8rem;
    margin-left: var(--spacing-xs);
}

/* Pricing Cards */
.pricing-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--spacing-lg);
    margin-bottom: var(--spacing-xl);
    padding-bottom: var(--spacing-xl);
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.card {
    position: relative;
    transition: var(--transition);
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-glow);
}

.card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transition: var(--transition);
}

.card-front, .card-back {
    position: relative;
    width: 100%;
    height: 100%;
    border-radius: var(--radius-lg);
    background: var(--white);
    box-shadow: var(--shadow-lg);
    transition: var(--transition);
}

.card-content {
    height: 100%;
    padding: var(--spacing-lg);
    display: flex;
    flex-direction: column;
}

.card-back {
    display: none;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: var(--white);
}

.card-back .card-content {
    justify-content: center;
    align-items: center;
    text-align: center;
}

.card-back h3 {
    font-size: 2rem;
    margin-bottom: var(--spacing-md);
}

.card-back p {
    margin-bottom: var(--spacing-lg);
    opacity: 0.9;
}

.popular-badge {
    position: absolute;
    top: -12px;
    right: 20px;
    background: var(--accent);
    color: var(--white);
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    z-index: 1;
    box-shadow: var(--shadow-sm);
}

.card-header {
    text-align: center;
    margin-bottom: var(--spacing-lg);
}

.card-header h2 {
    font-size: 2rem;
    margin-bottom: var(--spacing-sm);
}

.price {
    font-size: 3rem;
    font-weight: 700;
    color: var(--primary);
}

.currency {
    font-size: 1.5rem;
    vertical-align: super;
}

.period {
    font-size: 1rem;
    color: var(--text-light);
}

.features {
    list-style: none;
    margin: var(--spacing-lg) 0;
    flex-grow: 1;
}

.features li {
    display: flex;
    align-items: flex-start;
    margin-bottom: var(--spacing-md);
    padding: var(--spacing-sm);
    border-radius: var(--radius-sm);
    transition: var(--transition);
}

.features li:hover {
    background: rgba(99, 102, 241, 0.05);
    transform: translateX(5px);
}

.features li.featured {
    background: rgba(99, 102, 241, 0.1);
    border-left: 3px solid var(--primary);
}

.feature-content {
    display: flex;
    flex-direction: column;
    margin-left: var(--spacing-sm);
}

.feature-title {
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 2px;
}

.feature-description {
    font-size: 0.9rem;
    color: var(--text-light);
}

.feature-icon {
    color: var(--primary);
    font-size: 1.2rem;
    margin-top: 2px;
}

.features li.featured .feature-icon {
    color: var(--accent);
}

.select-plan {
    width: 100%;
    padding: var(--spacing-md);
    border: none;
    border-radius: var(--radius-md);
    background: linear-gradient(45deg, var(--primary), var(--secondary));
    color: var(--white);
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    margin-top: auto;
}

.select-plan:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-glow);
}

/* Feature Comparison */
.feature-comparison {
    margin: var(--spacing-xl) 0;
    padding-top: var(--spacing-xl);
}

.feature-comparison h2 {
    text-align: center;
    margin-bottom: var(--spacing-xl);
    font-size: 2.5rem;
    background: linear-gradient(45deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.comparison-table {
    overflow-x: auto;
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    margin: 0 auto;
    max-width: 1000px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: var(--spacing-md);
    text-align: left;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

th {
    background: var(--bg-light);
    font-weight: 600;
}

/* FAQ Section */
.faq-section {
    margin-bottom: var(--spacing-xl);
}

.faq-section h2 {
    text-align: center;
    margin-bottom: var(--spacing-lg);
}

.faq-container {
    max-width: 800px;
    margin: 0 auto;
}

.faq-item {
    background: var(--white);
    border-radius: var(--radius-md);
    margin-bottom: var(--spacing-sm);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
}

.faq-question {
    padding: var(--spacing-md);
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
}

.faq-question h3 {
    font-size: 1.1rem;
    font-weight: 500;
}

.toggle-icon {
    font-size: 1.5rem;
    transition: var(--transition);
}

.faq-answer {
    padding: 0 var(--spacing-md);
    max-height: 0;
    overflow: hidden;
    transition: var(--transition);
}

.faq-item.active .faq-answer {
    padding: var(--spacing-md);
    max-height: 200px;
}

.faq-item.active .toggle-icon {
    transform: rotate(45deg);
}

/* Footer */
.footer {
    text-align: center;
    padding: var(--spacing-lg);
    color: var(--text-light);
}

.footer a {
    color: var(--primary);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
}

.footer a:hover {
    color: var(--primary-dark);
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: var(--spacing-md);
    }

    .title {
        font-size: 2rem;
    }

    .pricing-cards {
        grid-template-columns: 1fr;
    }

    .card {
        min-height: auto;
    }

    .popular-badge {
        top: 10px;
        right: 10px;
    }
} 
</style>
<body>
    <div class="container">
        <header class="header">
            <h1 class="title">Prestige Pricing</h1>
            <p class="subtitle">Choose the perfect plan for your needs</p>
            
            <div class="pricing-toggle">
                <span>Monthly</span>
                <label class="switch">
                    <input type="checkbox" id="pricing-toggle">
                    <span class="slider"></span>
                </label>
                <span>Yearly <span class="discount">Save 20%</span></span>
            </div>
        </header>

        <div class="pricing-cards">
            <!-- Basic Plan -->
            <div class="card">
                <div class="card-inner">
                    <div class="card-front">
                        <div class="card-content">
                            <div class="card-header">
                                <h2>Basic</h2>
                                <div class="price">$0<span class="currency">/</span><span class="period">mo</span></div>
                            </div>
                            <ul class="features">
                                <li>
                                    <span class="feature-icon">✓</span>
                                    <div class="feature-content">
                                        <span class="feature-title">5 Projects</span>
                                        <span class="feature-description">Perfect for small teams</span>
                                    </div>
                                </li>
                                <li>
                                    <span class="feature-icon">✓</span>
                                    <div class="feature-content">
                                        <span class="feature-title">10GB Storage</span>
                                        <span class="feature-description">Enough for basic needs</span>
                                    </div>
                                </li>
                                <li>
                                    <span class="feature-icon">✓</span>
                                    <div class="feature-content">
                                        <span class="feature-title">Basic Support</span>
                                        <span class="feature-description">Email support within 24h</span>
                                    </div>
                                </li>
                                <li>
                                    <span class="feature-icon">✓</span>
                                    <div class="feature-content">
                                        <span class="feature-title">Email Notifications</span>
                                        <span class="feature-description">Stay updated with alerts</span>
                                    </div>
                                </li>
                            </ul>
                            <button class="select-plan">Choose Plan</button>
                        </div>
                    </div>
                    <div class="card-back">
                        <div class="card-content">
                            <h3>Basic Plan</h3>
                            <p>Ideal for small businesses and startup projects</p>
                            <button class="select-plan">Get Started</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pro Plan -->
            <div class="card">
                <div class="popular-badge">Most Popular</div>
                <div class="card-inner">
                    <div class="card-front">
                        <div class="card-content">
                            <div class="card-header">
                                <h2>Pro</h2>
                                <div class="price">$10<span class="currency">/</span><span class="period">mo</span></div>
                            </div>
                            <ul class="features">
                                <li class="featured">
                                    <span class="feature-icon">✓</span>
                                    <div class="feature-content">
                                        <span class="feature-title">20 Projects</span>
                                        <span class="feature-description">Perfect for growing teams</span>
                                    </div>
                                </li>
                                <li>
                                    <span class="feature-icon">✓</span>
                                    <div class="feature-content">
                                        <span class="feature-title">50GB Storage</span>
                                        <span class="feature-description">Advanced storage solutions</span>
                                    </div>
                                </li>
                                <li class="featured">
                                    <span class="feature-icon">✓</span>
                                    <div class="feature-content">
                                        <span class="feature-title">Priority Support</span>
                                        <span class="feature-description">24/7 dedicated support</span>
                                    </div>
                                </li>
                                <li>
                                    <span class="feature-icon">✓</span>
                                    <div class="feature-content">
                                        <span class="feature-title">Advanced Analytics</span>
                                        <span class="feature-description">Detailed insights and reports</span>
                                    </div>
                                </li>
                                <li class="featured">
                                    <span class="feature-icon">✓</span>
                                    <div class="feature-content">
                                        <span class="feature-title">API Access</span>
                                        <span class="feature-description">Full API integration</span>
                                    </div>
                                </li>
                            </ul>
                            <button class="select-plan">Choose Plan</button>
                        </div>
                    </div>
                    <div class="card-back">
                        <div class="card-content">
                            <h3>Pro Plan</h3>
                            <p>Professional solutions for growing businesses</p>
                            <button class="select-plan">Get Started</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enterprise Plan -->
            <div class="card">
                <div class="card-inner">
                    <div class="card-front">
                        <div class="card-content">
                            <div class="card-header">
                                <h2>Enterprise</h2>
                                <div class="price">$30<span class="currency">/</span><span class="period">mo</span></div>
                            </div>
                            <ul class="features">
                                <li class="featured">
                                    <span class="feature-icon">✓</span>
                                    <div class="feature-content">
                                        <span class="feature-title">Unlimited Projects</span>
                                        <span class="feature-description">Scale without limits</span>
                                    </div>
                                </li>
                                <li>
                                    <span class="feature-icon">✓</span>
                                    <div class="feature-content">
                                        <span class="feature-title">200GB Storage</span>
                                        <span class="feature-description">Enterprise-grade storage</span>
                                    </div>
                                </li>
                                <li class="featured">
                                    <span class="feature-icon">✓</span>
                                    <div class="feature-content">
                                        <span class="feature-title">24/7 Support</span>
                                        <span class="feature-description">Dedicated support team</span>
                                    </div>
                                </li>
                                <li>
                                    <span class="feature-icon">✓</span>
                                    <div class="feature-content">
                                        <span class="feature-title">Custom Integrations</span>
                                        <span class="feature-description">Tailored to your needs</span>
                                    </div>
                                </li>
                                <li class="featured">
                                    <span class="feature-icon">✓</span>
                                    <div class="feature-content">
                                        <span class="feature-title">Advanced Security</span>
                                        <span class="feature-description">Enterprise-grade protection</span>
                                    </div>
                                </li>
                                <li>
                                    <span class="feature-icon">✓</span>
                                    <div class="feature-content">
                                        <span class="feature-title">Custom Training</span>
                                        <span class="feature-description">Team onboarding included</span>
                                    </div>
                                </li>
                            </ul>
                            <button class="select-plan">Choose Plan</button>
                        </div>
                    </div>
                    <div class="card-back">
                        <div class="card-content">
                            <h3>Enterprise Plan</h3>
                            <p>Custom solutions for large organizations</p>
                            <button class="select-plan">Get Started</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="feature-comparison">
            <h2>Feature Comparison</h2>
            <div class="comparison-table">
                <table>
                    <thead>
                        <tr>
                            <th>Feature</th>
                            <th>Basic</th>
                            <th>Pro</th>
                            <th>Enterprise</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Number of Projects</td>
                            <td>5</td>
                            <td>20</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>Storage</td>
                            <td>10GB</td>
                            <td>50GB</td>
                            <td>200GB</td>
                        </tr>
                        <tr>
                            <td>Support</td>
                            <td>Email</td>
                            <td>Priority</td>
                            <td>24/7</td>
                        </tr>
                        <tr>
                            <td>API Access</td>
                            <td>No</td>
                            <td>Yes</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Custom Integrations</td>
                            <td>No</td>
                            <td>No</td>
                            <td>Yes</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="faq-section">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Can I switch between plans?</h3>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, you can upgrade or downgrade your plan at any time. Changes will be reflected in your next billing cycle.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h3>What is your refund policy?</h3>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>We offer a 14-day money-back guarantee. If you're not satisfied, contact our support team for a full refund.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h3>How is technical support provided?</h3>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Basic plan includes email support, Pro plan includes priority support, and Enterprise plan includes 24/7 dedicated support team.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer class="footer">
        <p>Created by <a href="https://harmoncode.com" target="_blank" rel="noopener noreferrer">HarmonCode</a></p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
  

    const cursorFollower = document.createElement('div');
    cursorFollower.className = 'cursor-follower';
    document.body.appendChild(cursorFollower);

    document.addEventListener('mousemove', (e) => {
        cursor.style.left = e.clientX + 'px';
        cursor.style.top = e.clientY + 'px';
        
        setTimeout(() => {
            cursorFollower.style.left = e.clientX + 'px';
            cursorFollower.style.top = e.clientY + 'px';
        }, 100);
    });

    // Pricing toggle
    const toggle = document.querySelector('.switch input');
    const prices = document.querySelectorAll('.price');
    const periods = document.querySelectorAll('.period');
    const discount = document.querySelector('.discount');

    const monthlyPrices = ['$0', '$10', '$30'];
    const yearlyPrices = ['$0', '$99', '$299'];

    toggle.addEventListener('change', () => {
        prices.forEach((price, index) => {
            price.textContent = toggle.checked ? yearlyPrices[index] : monthlyPrices[index];
        });

        periods.forEach(period => {
            period.textContent = toggle.checked ? '/year' : '/mo';
        });

        discount.style.display = toggle.checked ? 'inline-block' : 'none';
    });

    // FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            
            // Close all other items
            faqItems.forEach(otherItem => {
                otherItem.classList.remove('active');
            });

            // Toggle current item
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });

    // Card hover effects
    const cards = document.querySelectorAll('.card');

    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            cursor.style.transform = 'scale(1.5)';
            cursorFollower.style.transform = 'scale(1.5)';
        });

        card.addEventListener('mouseleave', () => {
            cursor.style.transform = 'scale(1)';
            cursorFollower.style.transform = 'scale(1)';
        });
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.card, .faq-item, .comparison-table').forEach(el => {
        observer.observe(el);
    });

    // Price calculation based on features
    const featureCheckboxes = document.querySelectorAll('.feature-checkbox');
    const totalPrice = document.querySelector('.total-price');

    function updateTotalPrice() {
        let total = 0;
        featureCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                total += parseInt(checkbox.dataset.price);
            }
        });
        totalPrice.textContent = `$${total}`;
    }

    featureCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateTotalPrice);
    });

    // Local storage for user preferences
    const savePreferences = () => {
        const preferences = {
            pricingType: toggle.checked ? 'yearly' : 'monthly',
            selectedFeatures: Array.from(featureCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.id)
        };
        localStorage.setItem('pricingPreferences', JSON.stringify(preferences));
    };

    const loadPreferences = () => {
        const saved = localStorage.getItem('pricingPreferences');
        if (saved) {
            const preferences = JSON.parse(saved);
            toggle.checked = preferences.pricingType === 'yearly';
            preferences.selectedFeatures.forEach(featureId => {
                const checkbox = document.getElementById(featureId);
                if (checkbox) checkbox.checked = true;
            });
            updateTotalPrice();
        }
    };

    toggle.addEventListener('change', savePreferences);
    featureCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', savePreferences);
    });

    loadPreferences();
}); 
    </script>
</body>
</html> 