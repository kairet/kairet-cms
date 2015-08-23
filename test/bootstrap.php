<?php
use Doctrine\Common\Annotations\AnnotationRegistry;

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

// This is necessary as validation using annotations conflicts with doctrine-orm annotations otherwise...
AnnotationRegistry::registerLoader(function ($class) use ($loader) {
    $loader->loadClass($class);
    return class_exists($class, false);
});
AnnotationRegistry::registerFile(
    __DIR__ . '/../vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php'
);

return $loader;
