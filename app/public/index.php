<?php
require __DIR__ . "/../../bootstrap.php";

$app = new Silex\Application();

// Setup silex configuration
$app['debug'] = \KCMS\Config::DEV_MODE;
$app->register(new Silex\Provider\ServiceControllerServiceProvider());

// Add services
$app['entityManager'] = $app->share(function () {
    return \KCMS\Database\DbService::getEntityManager();
});

// Setup controllers

// Add user controller as a service
$app['users.controller'] = $app->share(function () use ($app) {
    return new \KCMS\Controller\UserController($app['entityManager']);
});

// Define routes for user controller
/** @var \Silex\ControllerCollection $user */
$user = $app['controllers_factory'];
$user->get('/', 'users.controller:getAllUsersJson');
$user->get('/{id}', 'users.controller:getUserJson');

// Mount user controller
$app->mount('/users', $user);


// Start the application
$app->run();
