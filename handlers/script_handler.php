<?php

# Base error reporting
ini_set('display_startup_error', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('America/Chicago');

require_once "../vendor/autoload.php";

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    echo "<h2>Error 405 : Method Not Allowed</h2>";
    echo "<a href=\"http://" . $_SERVER['HTTP_HOST'] . "/\">Go Home</a>";
    die(405);
}

$root = dirname(__DIR__);
$scripts_dir ="$root/storage/scripts/";
$target_dir = "$root/storage/uploads/";

// what script needs to be passed?
$script_name = $_POST['script_name'];

// get all the files that were passed
$files = $_FILES;

// check that the target directory exists
if (!is_dir($target_dir)) {
    mkdir($target_dir);
}

// Gather the script's required arguments
$req_args = [];
$arg_string = "";
// get all the actions and find the current one.
$dash_actions = json_decode(file_get_contents("$root/storage/dash_actions.json"), true);
foreach ($dash_actions as $da) {
    if ($da['path'] === $script_name) {
        $target_action = $da;
    }
}

// exit if you can't find the action for whatever reason
if (!isset($target_action)) {
    echo "<h2>Error 500: There was an issue processing your request. :(</h2>";
    echo "<a href=\"http://" . $_SERVER['HTTP_HOST'] . "/\">Go Home</a>";
    exit(500);
}

// get the target actions arguments
if (!empty($target_action["arguments"])) {
    $req_args = $target_action["arguments"];
}

// count how many requred files there are and get the format if it's a file
$req_file_count = 0;
foreach ($req_args as $flag => $type) {
    if (str_starts_with($type, 'file')) {
        $req_file_count++;
    }
}

// exit if the file count's do not match
$prov_file_count = count($files);
if ($prov_file_count !== $req_file_count) {
    echo "<h2>Error 400: This tool requires $req_file_count files. You provided $prov_file_count</h2>";
    echo "<a href=\"http://" . $_SERVER['HTTP_HOST'] . "/\">Go Home</a>";
    exit(400);
}

// Verify the files and tranfer them into the /uploads directory
foreach ($files as $upload_name => $file) {
    $name = $file['name'];
    $type = $file['type'];
    $tmp_name = $file['tmp_name'];
    $size = $file['size'];

    $allowed_files_types = [
        "csv" => "text/csv",
    ];

    $date = date('mdy_Hi');
    $final_file_name = "$date-$name";

    if (in_array($type, $allowed_files_types)) {
        if (!move_uploaded_file($tmp_name, $target_dir . $final_file_name)) {
            echo "<h2>Error 500: There was an issue processing your request. :(</h2>";
            echo "<a href=\"http://" . $_SERVER['HTTP_HOST'] . "/\">Go Home</a>";
            exit(500);
        } else {
            echo "Transferred $date-$name... <br />";
            
            // add the argument onto the end of the string
            $arg_string .= " --" . str_replace('_upload', '', $upload_name) . "=\"$final_file_name\"";
        }
    }
}


// May 09 2025 - Kyle
//
// Despite the script existing and being directly executable. For whatever reason, PHP is not able to
// execute the script by the full file path.
//
// This: shell_exec('/var/www/pi_accounting/storage/scripts/test_report.py') results
// in bash: /var/www/pi_accounting/storage/scripts/test_report.py: cannot execute: required file not found
//
// To get around this, you need to split up the shell_exec() call into two commands. 
//  1. cd into the scripts directory
//  2. run the script
//
// The command should look roughly like "cd /var/www/pi_accounting/storage/scripts; ./script_name.py"

$shell_command = "cd /var/www/pi_accounting/storage/scripts; ./$script_name";

// Attach arguments to the script name 
$shell_command = $shell_command . $arg_string . "2>&1";

// Call the target script and grab the output.
$output = shell_exec($shell_command);

// YOU LEFT OFF HERE

// FOR SOME REASON THE PHP IS NOT WAITING FOR THE PYTHON TO RUN
// THAT OR THE PYTHON IS FAILING IN BUT NOT IN TESTING

dd($script_name, $files, $output, $shell_command);
