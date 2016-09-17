<?php

return [
    'dependencies' => [
        'invokables' => [
        ],
        'factories' => [
            \App\Command\UpdateCommand::class => \App\Command\UpdateCommandFactory::class,
        ],
    ],

    'console' => [
        'commands' => [
            \App\Command\UpdateCommand::class,
        ],
    ],
];
