<?php
// Session Lifetime Settings (1 year)
$lifetime = 31536000; // 365 * 24 * 60 * 60 seconds

ini_set('session.gc_maxlifetime', $lifetime);
ini_set('session.cookie_lifetime', $lifetime);
session_set_cookie_params($lifetime);

// Prevent PHP from auto-destroying long sessions
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);
?>
