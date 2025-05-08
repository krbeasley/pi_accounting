<?php

# Base error reporting
ini_set('display_startup_error', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once './vendor/autoload.php';

use Dotenv\Dotenv;
use App\DashActions\Action;

// Load the env file
$dotenv = Dotenv::createImmutable(__DIR__);
try {
    $dotenv->load();
} catch (\Exception $e) {
    echo "Kyle forgot to transfer the env file...";
    die(500);
}

// What worker script needs to run?
$script_name = $_GET['sn'];

// Error message if no script name or bad script name provided
if (empty($script_name)) {
    echo "<h2>Please provide a script name (or just click a link like a normal person)</h2>";
    echo "<a href='./index.php'>Go Home</a>";
    die(400);
}

// Get the action
$action = Action::loadForScript($script_name);

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
            const script_name = <?php echo "'" . $script_name . "'" ?>;
        </script>

        <?php echo $header; ?>

        <main class='w-full flex flex-col items-center justify-start py-20'>
            <p class='text-center text-3xl font-black'><?php echo $worker_title ?? "Worker Title Goes Here"; ?></p>

            <div id='worker-frame' class="bg-neutral-200 relative flex flex-col">
                <form id='worker-form' class='' action="" method="post">
                    <input name='script_name' type="text" class="opacity-10"/>
                </form>
            </div>
        </main>

        <?php echo $footer; ?>

        <script src="./src/js/app.js"></script>
    </body>
</html>
