<?php
use KCMS\Config;
use KCMS\Controller\UserController;
use KCMS\Converter\UserConverter;
use KCMS\Services\ServiceLocator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validation;

require __DIR__ . "/../../bootstrap.php";

$app = new Silex\Application();

// Setup silex configuration
$app['debug'] = \KCMS\Config::DEV_MODE;
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(
    new Silex\Provider\MonologServiceProvider(),
    [
        'monolog.logfile' => __DIR__ . '/../../' . Config::LOG_PATH,
        'monolog.name'    => 'kcms',
        'monolog.level'   => Config::LOG_LEVEL
    ]
);

// Setup ServiceLocator
ServiceLocator::registerValidator(Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator());
ServiceLocator::registerMonolog($app['monolog']);

// Setup error handling
$app->error(function (\Exception $e, $code) {
    // Log the error
    ServiceLocator::getMonolog()->addError($e->getMessage());

    // TODO: Do not output internal errors in production environment
    if ($e->getCode() !== 0) {
        return new Response(
            $e->getCode() . ': ' . $e->getMessage(),
            400, /* Ignored by silex */
            array('X-Status-Code' => $e->getCode())
        );
    } else {
        return new Response($code . ': ' . $e->getMessage());
    }
});

// Setup converter
$app['user.converter'] = $app->share(function () use ($app) {
    return new UserConverter(ServiceLocator::getEntityManager());
});

// Setup controllers

// Add user controller as a service
$app['user.controller'] = $app->share(function () use ($app) {
    return new UserController(ServiceLocator::getEntityManager());
});

// Define routes for user controller
/** @var \Silex\ControllerCollection $user */
$user = $app['controllers_factory'];
$user->get('/', 'user.controller:getAllUsers');
$user->get('/{user}', 'user.controller:getUser')->convert('user', 'user.converter:convertFromId');
$user->post('/', 'user.controller:createUser')->convert('user', 'user.converter:convertFromRequestBody');
$user->delete('/{user}', 'user.controller:deleteUser')->convert('user', 'user.converter:convertFromId');

// Mount user controller
$app->mount('/users', $user);


// Convert controller responses accordingly
$app->view(function ($controllerResult, \Symfony\Component\HttpFoundation\Request $request) {
    switch ($request->getMethod()) {
        case 'GET':
            if ($controllerResult !== null) {
                return new JsonResponse($controllerResult);
            } else {
                return new Response();
            }
            break;
        case 'PUT':
        case 'POST':
            return new JsonResponse($controllerResult, $status = 201);
            break;
        case 'DELETE':
            return new Response('', $status = 204);
            break;
    }

    return new Response();
});

// Start the application
$app->run();
