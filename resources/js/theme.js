// Theme Management
document.addEventListener('DOMContentLoaded', () => {
    // Check for saved theme preference or use light theme by default
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
    
    // Theme toggle handler
    window.toggleTheme = function() {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        
        // Update theme
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        
        // Trigger custom event for components that need to react to theme changes
        document.dispatchEvent(new CustomEvent('themeChanged', { detail: { theme: newTheme } }));
    };
});