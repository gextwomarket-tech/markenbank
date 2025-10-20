import './bootstrap';
import 'bootstrap';
import '@fortawesome/fontawesome-free/js/all';
import AOS from 'aos';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Chart from 'chart.js/auto';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger);

// Initialize AOS (Animate On Scroll)
document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        offset: 50,
    });

    // Navbar scroll effect
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    // Theme toggle
    const themeToggle = document.querySelector('.theme-toggle');
    if (themeToggle) {
        const currentTheme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-theme', currentTheme);

        themeToggle.addEventListener('click', () => {
            const theme = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
        });
    }

    // Initialize Particles.js for hero section
    if (typeof particlesJS !== 'undefined' && document.getElementById('particles-js')) {
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 80,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: '#0066FF'
                },
                shape: {
                    type: 'circle',
                },
                opacity: {
                    value: 0.5,
                    random: false,
                },
                size: {
                    value: 3,
                    random: true,
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#0066FF',
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 2,
                    direction: 'none',
                    random: false,
                    straight: false,
                    out_mode: 'out',
                    bounce: false,
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: {
                        enable: true,
                        mode: 'repulse'
                    },
                    onclick: {
                        enable: true,
                        mode: 'push'
                    },
                    resize: true
                },
            },
            retina_detect: true
        });
    }

    // Initialize Swiper for testimonials/cards
    const testimonialSwiper = document.querySelector('.testimonials-swiper');
    if (testimonialSwiper) {
        new Swiper('.testimonials-swiper', {
            modules: [Navigation, Pagination, Autoplay],
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    }

    // GSAP Animations
    // Hero title animation
    const heroTitle = document.querySelector('.hero-title');
    if (heroTitle) {
        gsap.from(heroTitle, {
            opacity: 0,
            y: 50,
            duration: 1,
            ease: 'power3.out'
        });
    }

    // Stat numbers animation
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(stat => {
        const target = parseInt(stat.getAttribute('data-target'));
        gsap.to(stat, {
            textContent: target,
            duration: 2,
            ease: 'power1.out',
            snap: { textContent: 1 },
            scrollTrigger: {
                trigger: stat,
                start: 'top 80%',
            }
        });
    });

    // Card flip effect
    const flipCards = document.querySelectorAll('.flip-card');
    flipCards.forEach(card => {
        card.addEventListener('click', () => {
            card.classList.toggle('flipped');
        });
    });

    // Copy to clipboard
    const copyButtons = document.querySelectorAll('[data-copy]');
    copyButtons.forEach(button => {
        button.addEventListener('click', () => {
            const text = button.getAttribute('data-copy');
            navigator.clipboard.writeText(text).then(() => {
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i> Copié!';
                setTimeout(() => {
                    button.innerHTML = originalText;
                }, 2000);
            });
        });
    });

    // Chart.js - Dashboard charts
    const transactionChart = document.getElementById('transactionChart');
    if (transactionChart) {
        const ctx = transactionChart.getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: transactionChart.dataset.labels ? JSON.parse(transactionChart.dataset.labels) : [],
                datasets: [
                    {
                        label: 'Crédits',
                        data: transactionChart.dataset.credits ? JSON.parse(transactionChart.dataset.credits) : [],
                        borderColor: '#00D1A0',
                        backgroundColor: 'rgba(0, 209, 160, 0.1)',
                        tension: 0.4,
                        fill: true,
                    },
                    {
                        label: 'Débits',
                        data: transactionChart.dataset.debits ? JSON.parse(transactionChart.dataset.debits) : [],
                        borderColor: '#FF4D6D',
                        backgroundColor: 'rgba(255, 77, 109, 0.1)',
                        tension: 0.4,
                        fill: true,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#B0B7C3'
                        }
                    }
                },
                scales: {
                    y: {
                        ticks: { color: '#B0B7C3' },
                        grid: { color: 'rgba(255, 255, 255, 0.1)' }
                    },
                    x: {
                        ticks: { color: '#B0B7C3' },
                        grid: { color: 'rgba(255, 255, 255, 0.1)' }
                    }
                }
            }
        });
    }

    // Auto-login demo accounts
    const demoLoginButtons = document.querySelectorAll('.demo-login-btn');
    demoLoginButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const email = button.getAttribute('data-email');
            const password = button.getAttribute('data-password');
            
            document.querySelector('input[name="email"]').value = email;
            document.querySelector('input[name="password"]').value = password;
            
            // Optional: Auto-submit
            // document.querySelector('form').submit();
        });
    });

    // Form validation feedback
    const forms = document.querySelectorAll('.needs-validation');
    forms.forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // Toast notifications
    const toastElList = document.querySelectorAll('.toast');
    toastElList.forEach(toastEl => {
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    });

    // Tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // Popovers
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

    // Number formatting for currency
    const currencyElements = document.querySelectorAll('.currency');
    currencyElements.forEach(el => {
        const value = parseFloat(el.textContent);
        if (!isNaN(value)) {
            el.textContent = new Intl.NumberFormat('fr-FR', {
                style: 'currency',
                currency: el.dataset.currency || 'USD'
            }).format(value);
        }
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

    // Loading overlay
    const loadingOverlay = document.querySelector('.loading-overlay');
    if (loadingOverlay) {
        setTimeout(() => {
            loadingOverlay.classList.add('fade-out');
            setTimeout(() => loadingOverlay.remove(), 500);
        }, 1000);
    }
});

// Make functions globally available
window.AOS = AOS;
window.gsap = gsap;
window.Chart = Chart;
