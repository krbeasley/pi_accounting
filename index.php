<?php

# Base error reporting
ini_set('display_startup_error', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="./src/styles/output.css">
    <!-- Optionally include any other meta tags or external links here -->
</head>
<body>
    <header>
        <!-- Your header content goes here -->
    </header>
    
    <main>
        <h1 class='text-6xl font-black'>HELLO WORLD</h1>
    </main>
    
    <footer>
        <!-- Your footer content goes here -->
    </footer>
    
    <script src="./src/js/app.js"></script>
    <!-- Optionally include other scripts here -->
</body>
</html>
