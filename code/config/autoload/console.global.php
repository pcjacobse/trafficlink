<?php

return [
    'dependencies' => [
        'invokables' => [
        ],
        'factories' => [
            \App\Command\SetupCommand::class => \App\Command\SetupCommandFactory::class,
        ],
    ],

    'console' => [
        'commands' => [
            \App\Command\SetupCommand::class,
        ],
    ],
];
