/**
 * Marken Bank - Main JavaScript
 * Handles theme toggling, animations, and interactions
 */

// ========== THEME MANAGEMENT ==========
const ThemeManager = {
  init() {
    this.theme = localStorage.getItem('theme') || 'light';
    this.applyTheme(this.theme);
    this.attachListeners();
  },

  applyTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);
    this.theme = theme;
    this.updateToggleIcons();
  },

  toggle() {
    const newTheme = this.theme === 'light' ? 'dark' : 'light';
    this.applyTheme(newTheme);
  },

  updateToggleIcons() {
    const lightIcons = document.querySelectorAll('.theme-icon-light');
    const darkIcons = document.querySelectorAll('.theme-icon-dark');
    
    if (this.theme === 'light') {
      lightIcons.forEach(icon => icon.style.display = 'inline');
      darkIcons.forEach(icon => icon.style.display = 'none');
    } else {
      lightIcons.forEach(icon => icon.style.display = 'none');
      darkIcons.forEach(icon => icon.style.display = 'inline');
    }
  },

  attachListeners() {
    document.querySelectorAll('.theme-toggle').forEach(toggle => {
      toggle.addEventListener('click', () => this.toggle());
    });
  }
};

// ========== ANIMATIONS ==========
const AnimationManager = {
  init() {
    this.initAOS();
    this.initCounters();
    this.initParticles();
  },

  initAOS() {
    if (typeof AOS !== 'undefined') {
      AOS.init({
        duration: 800,
        easing: 'ease-out',
        once: true,
        offset: 100
      });
    }
  },

  initCounters() {
    const counters = document.querySelectorAll('.counter');
    
    counters.forEach(counter => {
      const updateCounter = () => {
        const target = +counter.getAttribute('data-target');
        const current = +counter.innerText.replace(/,/g, '');
        const increment = target / 100;
        
        if (current < target) {
          counter.innerText = Math.ceil(current + increment).toLocaleString();
          setTimeout(updateCounter, 20);
        } else {
          counter.innerText = target.toLocaleString();
        }
      };
      
      // Start counter when in viewport
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            updateCounter();
            observer.unobserve(counter);
          }
        });
      });
      
      observer.observe(counter);
    });
  },

  initParticles() {
    const particlesContainer = document.getElementById('particles-js');
    if (particlesContainer && typeof particlesJS !== 'undefined') {
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
            type: 'circle'
          },
          opacity: {
            value: 0.5,
            random: false
          },
          size: {
            value: 3,
            random: true
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
            bounce: false
          }
        },
        interactivity: {
          detect_on: 'canvas',
          events: {
            onhover: {
              enable: true,
              mode: 'grab'
            },
            onclick: {
              enable: true,
              mode: 'push'
            },
            resize: true
          }
        },
        retina_detect: true
      });
    }
  }
};

// ========== NAVBAR SCROLL EFFECT ==========
const NavbarManager = {
  init() {
    window.addEventListener('scroll', () => {
      const navbar = document.querySelector('.navbar-custom');
      if (navbar) {
        if (window.scrollY > 50) {
          navbar.classList.add('scrolled');
        } else {
          navbar.classList.remove('scrolled');
        }
      }
    });
  }
};

// ========== TOAST NOTIFICATIONS ==========
const Toast = {
  show(message, type = 'success') {
    if (typeof Toastify !== 'undefined') {
      Toastify({
        text: message,
        duration: 3000,
        gravity: 'top',
        position: 'right',
        backgroundColor: type === 'success' ? '#00D1A0' : 
                        type === 'error' ? '#FF4757' : 
                        type === 'warning' ? '#FF8F3D' : '#0066FF',
        stopOnFocus: true
      }).showToast();
    } else {
      alert(message);
    }
  }
};

// ========== FORM VALIDATION ==========
const FormValidator = {
  validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
  },

  validatePhone(phone) {
    const re = /^[\+]?[(]?[0-9]{1,4}[)]?[-\s\.]?[(]?[0-9]{1,4}[)]?[-\s\.]?[0-9]{1,9}$/;
    return re.test(phone);
  },

  validatePassword(password) {
    return {
      length: password.length >= 8,
      uppercase: /[A-Z]/.test(password),
      lowercase: /[a-z]/.test(password),
      number: /[0-9]/.test(password),
      special: /[^A-Za-z0-9]/.test(password)
    };
  },

  showPasswordStrength(password) {
    const strength = this.validatePassword(password);
    const score = Object.values(strength).filter(Boolean).length;
    const strengthBar = document.querySelector('.password-strength-bar');
    const strengthText = document.querySelector('.password-strength-text');
    
    if (!strengthBar) return;
    
    const colors = ['#FF4757', '#FF8F3D', '#FFA502', '#00D1A0', '#00D1A0'];
    const texts = ['Très faible', 'Faible', 'Moyen', 'Fort', 'Très fort'];
    
    strengthBar.style.width = (score * 20) + '%';
    strengthBar.style.backgroundColor = colors[score - 1] || colors[0];
    if (strengthText) {
      strengthText.textContent = texts[score - 1] || texts[0];
    }
  }
};

// ========== CARD MANAGEMENT ==========
const CardManager = {
  revealCardNumber(button, cardId) {
    const cardNumberElement = document.querySelector(`#card-number-${cardId}`);
    if (!cardNumberElement) return;
    
    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Chargement...';
    
    // Simulate API call
    fetch(`/dashboard/cards/${cardId}/reveal`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        cardNumberElement.textContent = data.card_number;
        button.textContent = 'Masquer';
        button.disabled = false;
      }
    })
    .catch(error => {
      Toast.show('Erreur lors de la révélation du numéro', 'error');
      button.disabled = false;
    });
  },

  flipCard(cardElement) {
    cardElement.classList.toggle('flipped');
  }
};

// ========== FILE UPLOAD ==========
const FileUpload = {
  init() {
    const dropZones = document.querySelectorAll('.drop-zone');
    
    dropZones.forEach(dropZone => {
      const input = dropZone.querySelector('input[type="file"]');
      
      dropZone.addEventListener('click', () => input.click());
      
      dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('drag-over');
      });
      
      dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('drag-over');
      });
      
      dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('drag-over');
        
        const files = e.dataTransfer.files;
        if (files.length) {
          input.files = files;
          this.handleFiles(files, dropZone);
        }
      });
      
      input.addEventListener('change', (e) => {
        this.handleFiles(e.target.files, dropZone);
      });
    });
  },

  handleFiles(files, dropZone) {
    const preview = dropZone.querySelector('.file-preview');
    if (!preview) return;
    
    Array.from(files).forEach(file => {
      const reader = new FileReader();
      reader.onload = (e) => {
        if (file.type.startsWith('image/')) {
          preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="img-fluid rounded">`;
        } else {
          preview.innerHTML = `<p><i class="fas fa-file"></i> ${file.name}</p>`;
        }
      };
      reader.readAsDataURL(file);
    });
  }
};

// ========== COPY TO CLIPBOARD ==========
function copyToClipboard(text, button) {
  navigator.clipboard.writeText(text).then(() => {
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-check"></i> Copié!';
    button.classList.add('btn-success');
    
    setTimeout(() => {
      button.innerHTML = originalText;
      button.classList.remove('btn-success');
    }, 2000);
    
    Toast.show('Copié dans le presse-papiers!', 'success');
  }).catch(err => {
    Toast.show('Erreur lors de la copie', 'error');
  });
}

// ========== QUICK LOGIN (Demo Accounts) ==========
function quickLogin(email, password) {
  document.querySelector('#email').value = email;
  document.querySelector('#password').value = password;
  document.querySelector('#login-form').submit();
}

// ========== INITIALIZE EVERYTHING ==========
document.addEventListener('DOMContentLoaded', () => {
  ThemeManager.init();
  AnimationManager.init();
  NavbarManager.init();
  FileUpload.init();
  
  console.log('🏦 Marken Bank initialized successfully!');
});

// ========== EXPORT FOR GLOBAL ACCESS ==========
window.MarkenBank = {
  Theme: ThemeManager,
  Toast,
  CardManager,
  FormValidator,
  copyToClipboard,
  quickLogin
};
