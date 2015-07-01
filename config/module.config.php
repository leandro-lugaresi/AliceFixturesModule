<?php

return [
    'service_manager' => [
        'factories' => [
            'AliceFixturesModule\Command\AliceFixturesCommand' => 'AliceFixturesModule\Factory\AliceFixturesCommandFactory',
            'AliceFixturesModule\AliceLoader' => 'AliceFixturesModule\Factory\AliceLoaderFactory',
        ],
    ],
    'alice' => [
        'fixtures' => [
            'modules' => [],
        ],
    ],
];
