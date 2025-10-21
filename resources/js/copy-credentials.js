// Copy credentials to clipboard
window.copyCredentials = function(email, password) {
    const text = `Email: ${email}\nMot de passe: ${password}`;
    navigator.clipboard.writeText(text).then(() => {
        // Show feedback notification
        const notification = document.createElement('div');
        notification.className = 'copy-notification';
        notification.textContent = 'Identifiants copiés !';
        document.body.appendChild(notification);
        
        // Remove notification after animation
        setTimeout(() => {
            notification.remove();
        }, 3000);
    });
};