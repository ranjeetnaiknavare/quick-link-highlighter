// Example: Open external links in a new tab
document.addEventListener('DOMContentLoaded', function() {
    const externalLinks = document.querySelectorAll('.qlh-external-link');
    externalLinks.forEach(link => {
        link.setAttribute('target', '_blank');
        link.setAttribute('rel', 'noopener noreferrer');
    });
});