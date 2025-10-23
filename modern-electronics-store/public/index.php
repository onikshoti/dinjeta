<?php
// Entry point for the modern electronics store application

// Load configuration
require_once '../config/config.php';

// Autoload classes
spl_autoload_register(function ($class_name) {
    include '../src/' . str_replace('\\', '/', $class_name) . '.php';
});

// Start the session
session_start();

// Include the router
require_once 'router.php';
?>