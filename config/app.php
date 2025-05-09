<?php

return [

    "name" => $_ENV['APP_NAME'] ?? 'Pi Accounting',
    "env" => $_ENV['APP_ENV'] ?? 'production',
    "url" => $_ENV['URL'] ?? "192.168.10.151:420",   // this will need to be modified at somepoint
    "upload_dir" => $_ENV['UPLOAD_DIR'] ?? '/var/tmp/pi_accounting'

];
