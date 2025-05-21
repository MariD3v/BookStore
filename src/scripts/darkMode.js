const toggleDarkMode = () => {
    const root = document.documentElement;
    const bulbIcon = document.getElementById('bulbIcon');

    root.classList.toggle('light-mode');

    const isLightMode = root.classList.contains('light-mode');
    bulbIcon.setAttribute('fill', isLightMode ? '#FFD700' : '#e3e3e3');

    localStorage.setItem('theme', isLightMode ? 'light' : 'dark');
};
window.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'light') {
        document.documentElement.classList.add('light-mode');
        document.getElementById('bulbIcon').setAttribute('fill', '#FFD700');
    }
});