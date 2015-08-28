<?php
require __DIR__ . '/../Config.php';

// Install composer dependencies
if (\KCMS\Config::DEV_MODE === true) {
    echo shell_exec('composer install');
} else {
    echo shell_exec(
        'composer install --no-ansi --no-dev --no-interaction --no-progress --no-scripts --optimize-autoloader'
    );
}

// Create database schema
if (PHP_OS == 'Linux') {
    echo shell_exec('./vendor/bin/doctrine orm:schema-tool:update --force --dump-sql');
} else {
    echo shell_exec('vendor\bin\doctrine orm:schema-tool:update --force --dump-sql');
}
