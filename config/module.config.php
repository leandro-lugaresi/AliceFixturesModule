<?php

return [
    'service_manager' => [
        'factories' => [
            'AliceFixturesCommand' => 'AliceFixturesModule\Command\AliceFixturesCommandFactory'
        ],
    ],
    'alice' => [
        'fixtures' => [
            'modules' => [],
        ],
    ],
];
