<?php

use Jgut\Slim\Controller\Resolver;

// Dependencies Configuration

$container = $app->getContainer();

/* Services */

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// request handler strategy
$container['foundHandler'] = function () {
    return new Slim\Handlers\Strategies\RequestResponseArgs();
};

// facebook service
$container['facebookService'] = function ($c) {
    $settings = $c->get('settings')['facebookSDK'];
    $logger   = $c->get('logger');
    return new Aivo\Service\FacebookService(
        $logger,
        $settings['app_id'],
        $settings['app_secret'],
        $settings['default_graph_version']
    );
};

/* Controllers */

$controllers = [
    'Aivo\Controller\FacebookController'
];

// Register Controllers
foreach (Resolver::resolve($controllers) as $controller => $callback) {
    $container[$controller] = $callback;
}
