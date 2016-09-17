<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
        ],
        'factories'  => [
            App\Action\HomePageAction::class => App\Action\HomePageFactory::class,
            App\Action\RestAction::class     => App\Action\RestFactory::class,
        ],
    ],

    'routes' => [
        [
            'name'            => 'home',
            'path'            => '/',
            'middleware'      => App\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name'            => 'rest',
            'path'            => '/api/data',
            'middleware'      => App\Action\RestAction::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
