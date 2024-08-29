<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Settings Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="settings-container">
        <h1>Settings</h1>
        <form id="settingsForm">
            <div class="setting-item">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="setting-item">
                <label for="theme">Theme:</label>
                <select id="theme" name="theme">
                    <option value="light">Light</option>
                    <option value="dark">Dark</option>
                </select>
            </div>
            <div class="setting-item">
                <label for="notifications">Enable Notifications:</label>
                <input type="checkbox" id="notifications" name="notifications">
            </div>
            <button type="button" id="saveButton">Save Data</button>
        </form>
        <p id="statusMessage"></p>
    </div>
    <script src="script.js"></script>
</body>
</html>
