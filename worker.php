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

// Get the dash actions
$dash_actions_json = file_get_contents("./storage/dash_actions.json");

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
            const dashActions = <?php echo $dash_actions_json ?? '[]'; ?>;
            const scriptName = "<?php echo $script_name ?? '' ?>";
        </script>

        <?php echo $header; ?>

        <main class='w-full flex flex-col items-center justify-start py-20'>
            <p id='worker-title' class='text-center text-3xl font-black'></p>

            <div id='worker-frame' class="relative flex flex-col my-10">
                <form id='worker-form' class='flex flex-col w-200' action="./handlers/script_handler.php" method="post" enctype="multipart/form-data">
                    <input name='script_name' type="text" class="hidden" value="<?php echo $script_name ?>"/>
                    
                    <div id='uploads-container' class='w-fit max-w-full grid grid-cols-2 gap-10 mx-auto'></div>

                    <button type='submit' 
                        class='py-2 px-12 bg-pink-600 text-neutral-50 font-black text-lg w-fit rounded-md mt-10 mx-auto cursor-pointer hover:shadow-md'>
                        Run
                    </button>
                </form>
            </div>
        </main>

        <?php echo $footer; ?>

        <script src="./src/js/app.js"></script>
        <script src="./src/js/worker.js" type='module'></script>
    </body>
</html>
