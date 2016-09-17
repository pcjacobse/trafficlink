<?php

use Monolog\Logger;

return [
    'monolog' =>
        [
            'logger_name' => 'MyLog',
            'handlers' =>
                [
                    'main'   =>
                        [
                            'type'   => 'stream',
                            'path'   => 'data/main.log',
                            'level'  => Logger::DEBUG,
                            'bubble' => true,
                        ],
                ],
        ],
];
