<?php

# Base error reporting
ini_set('display_startup_error', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once './vendor/autoload.php';

use Dotenv\Dotenv;

// Load the env file
$dotenv = Dotenv::createImmutable(__DIR__);
try {
    $dotenv->load();
} catch (\Exception $e) {
    echo "Transfer the env file...";
    die(500);
}

$dash_actions = file_get_contents('./storage/dash_actions.json');

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
        <script>
            // inject any server side values into the front end here
            const dashActions = <?php echo $dash_actions; ?>;
        </script>

        <?php echo $header; ?>

        <main class='w-full flex flex-col items-center justify-start py-20'>
            <div id='actions-container' class='w-11/12 max-w-[1200px] flex flex-wrap gap-10 items-center justify-center'>
                <!-- Dashboard actions are created by the page's javascript --> 
            </div>
        </main>

        <?php echo $footer; ?>

        <script src="./src/js/dashboard.js" type='module'></script>
        <script src="./src/js/app.js"></script>
    </body>
</html>
