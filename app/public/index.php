<?php
/*************************************************************************
 * Copyright (C) 2015 kairet                                             *
 *                                                                       *
 * This program is free software: you can redistribute it and/or modify  *
 * it under the terms of the GNU General Public License as published by  *
 * the Free Software Foundation, either version 3 of the License, or     *
 * (at your option) any later version.                                   *
 *                                                                       *
 * This program is distributed in the hope that it will be useful,       *
 * but WITHOUT ANY WARRANTY; without even the implied warranty of        *
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         *
 * GNU General Public License for more details.                          *
 *                                                                       *
 * You should have received a copy of the GNU General Public License     *
 * along with this program.  If not, see <http://www.gnu.org/licenses/>. *
 *************************************************************************/

require __DIR__ . "/../../bootstrap.php";

$app = new Silex\Application();

// Setup silex configuration
$app['debug'] = \KCMS\Config::DEV_MODE;
$app->register(new Silex\Provider\ServiceControllerServiceProvider());

// Add services
$app['entityManager'] = $app->share(function () {
    return \KCMS\Services\ServiceContext::getEntityManager();
});

// Setup error handling
$app->error(function (\Exception $e, $code) {
    // TODO: Do not output internal errors in production environment
    // TODO: Error-logging
    if ($e->getCode() !== 0) {
        return new \Symfony\Component\HttpFoundation\Response(
            $e->getCode() . ': ' . $e->getMessage(),
            400, /* Ignored by silex */
            array('X-Status-Code' => $e->getCode())
        );
    } else {
        return new \Symfony\Component\HttpFoundation\Response($code . ': ' . $e->getMessage());
    }
});

// Setup converter
$app['user.converter'] = $app->share(function () use ($app) {
    return new \KCMS\Converter\UserConverter(\KCMS\Services\ServiceContext::getEntityManager());
});

// Setup controllers

// Add user controller as a service
$app['user.controller'] = $app->share(function () use ($app) {
    return new \KCMS\Controller\UserController(\KCMS\Services\ServiceContext::getEntityManager());
});

// Define routes for user controller
/** @var \Silex\ControllerCollection $user */
$user = $app['controllers_factory'];
$user->get('/', 'user.controller:getAllUsers');
$user->get('/{user}', 'user.controller:getUser')->convert('user', 'user.converter:convertFromId');
$user->put('/{user}', 'user.controller:createUser')->convert('user', 'user.converter:convertFromJson');
$user->delete('/{user}', 'user.controller:deleteUser')->convert('user', 'user.converter:convertFromId');

// Mount user controller
$app->mount('/users', $user);


// Convert controller responses accordingly
$app->view(function ($controllerResult, \Symfony\Component\HttpFoundation\Request $request) {
    switch ($request->getMethod()) {
        case 'GET':
            if ($controllerResult !== null) {
                return new \Symfony\Component\HttpFoundation\JsonResponse($controllerResult);
            } else {
                return new \Symfony\Component\HttpFoundation\Response();
            }
            break;
        case 'PUT':
            return new \Symfony\Component\HttpFoundation\Response('', $status = 201);
            break;
        case 'DELETE':
            return new \Symfony\Component\HttpFoundation\Response('', $status = 204);
            break;
    }

    return new \Symfony\Component\HttpFoundation\Response();
});

// Start the application
$app->run();
