<?php
use Doctrine\Common\Annotations\AnnotationRegistry;

if (!file_exists(__DIR__ . '/Config.php')) {
    die('Configuration-file not setup');
}

$loader = require __DIR__ . '/vendor/autoload.php';

// This is necessary as validation using annotations conflicts with doctrine-orm annotations otherwise...
AnnotationRegistry::registerLoader(function ($class) use ($loader) {
    $loader->loadClass($class);
    return class_exists($class, false);
});
AnnotationRegistry::registerFile(
    __DIR__ . '/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php'
);
