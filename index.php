<?php

# Base error reporting
ini_set('display_startup_error', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once './vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);

// Load the env file
try {
    $dotenv->load();
} catch (\Exception $e) {
    echo "Transfer the env file...";
    die(500);
}

// Load the dashboard actions

// Get the includes
try {
    $head = getAndReplace('includes.head', [
        'title' => "Home | Pi Accounting",
        'description' => "",
        'keywords' => "",
    ]);

    $header = getAndReplace('includes.header');
    $footer = getAndReplace('includes.footer', [
        'year' => date('Y'),
    ]);
} catch (\Exception $e) {
    echo $e->getMessage();
    die($e->getCode());
}

?>

<!DOCTYPE html>
<html lang="en">
    <?php echo $head; ?>
<body>
    <?php echo $header; ?>

    <main class='w-full flex flex-col items-center justify-start'>
        <div class='w-11/12 max-w-[1200px] flex flex-wrap gap-10 items-center justify-center'>

        <?php 
        ?>
            
        </div>
    </main>

    <?php echo $footer; ?>

    <script src="./src/js/app.js"></script>
</body>
</html>
