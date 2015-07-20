<?php
function includeIfExists($file)
{
    if (file_exists($file)) {
        return include $file;
    }
    return null;
}

if (!$loader = includeIfExists(__DIR__ . "/../vendor/autoload.php")) {
    die("Composer is not setup correctly");
}
$loader->add("Tests", __DIR__);
return $loader;
