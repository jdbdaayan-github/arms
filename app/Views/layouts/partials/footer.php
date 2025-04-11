<?php
$session = \Config\Services::session();

// Set session expiration time (30 minutes from now)
$session_lifetime = 30 * 60; // 30 minutes in seconds
$current_time = time();
$session_expiration_time = $session->get('session_start_time') ? $session->get('session_start_time') + $session_lifetime : $current_time + $session_lifetime;

// Store session expiration time in session
$session->set('session_expiration_time', $session_expiration_time);

// Calculate the remaining time until session expiration
$remaining_time = $session_expiration_time - $current_time;
$hours = floor($remaining_time / 3600);
$minutes = floor(($remaining_time % 3600) / 60);
$seconds = $remaining_time % 60;
$formatted_duration = "{$hours} hours, {$minutes} minutes, {$seconds} seconds";
?>

<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.1.0
    </div>
    <strong>&copy; 2025 <a href="#">DSWD-AS-RAMD</a>.</strong> All rights reserved.
    <div class="float-right d-none d-sm-block">
        <small id="session-time" style="cursor: pointer;" onclick="toggleSessionTime()"><?= $formatted_duration ?></small>
    </div>
</footer>

<script>
    function updateSessionTime() {
        const sessionTime = document.getElementById('session-time');
        
        // Get the session expiration time from PHP
        const expirationTime = <?= $session_expiration_time ?>;
        const currentTime = Math.floor(Date.now() / 1000); // Current time in seconds

        let remainingTime = expirationTime - currentTime;

        // Update the countdown every second
        const interval = setInterval(function() {
            remainingTime--; // Decrease the remaining time by 1 second

            // Calculate hours, minutes, and seconds
            const hours = Math.floor(remainingTime / 3600);
            const minutes = Math.floor((remainingTime % 3600) / 60);
            const seconds = remainingTime % 60;

            // Update the session time in the footer
            sessionTime.innerText = `${hours} hours, ${minutes} minutes, ${seconds} seconds`;

            // If the session time reaches zero, stop the countdown and handle session expiration
            if (remainingTime <= 0) {
                clearInterval(interval);
                sessionTime.innerText = "Session expired";
                alert("Your session has expired.");
                // Perform any action, like redirecting or logging out the user
                // For example: window.location.href = "/logout";
            }
        }, 1000); // Update every second
    }

    function toggleSessionTime() {
        const sessionTime = document.getElementById('session-time');
        if (sessionTime.innerText === "Click to see session time") {
            // If text is clicked, show the actual session countdown
            updateSessionTime();
        } else {
            // If session duration is shown, hide it
            sessionTime.innerText = "Click to see session time";
        }
    }

    // Initialize session time update when the page is loaded
    document.addEventListener("DOMContentLoaded", function() {
        updateSessionTime();
    });
</script>
