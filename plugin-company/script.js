document.getElementById('saveButton').addEventListener('click', function() {
    // Get values from the form
    const username = document.getElementById('username').value;
    const theme = document.getElementById('theme').value;
    const notifications = document.getElementById('notifications').checked;

    // Create an object to store the settings
    const settings = {
        username: username,
        theme: theme,
        notifications: notifications
    };

    // Save the settings object to local storage
    localStorage.setItem('userSettings', JSON.stringify(settings));

    // Update status message
    document.getElementById('statusMessage').textContent = 'Settings saved successfully!';
});

// Load settings when the page loads
window.onload = function() {
    const savedSettings = JSON.parse(localStorage.getItem('userSettings'));

    if (savedSettings) {
        document.getElementById('username').value = savedSettings.username;
        document.getElementById('theme').value = savedSettings.theme;
        document.getElementById('notifications').checked = savedSettings.notifications;
    }
};
