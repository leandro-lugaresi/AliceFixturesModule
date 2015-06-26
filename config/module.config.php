<?php 

return [
	'controllers' => [
        'invokables' => [
            'AliceFixturesModule\Controller\AliceFixtures'        => 'AliceFixturesModule\Controller\AliceFixturesController',
        ],
    ],
	'console' => [
        'router' => [
            'routes' => [
                'import-alice' => [
                    'options' => [
                        'route'    => 'fixtures load alice [--filter=] [--module=] [--locale=] [--conection=]',
                        'defaults' => [
                            'controller' => 'AliceFixturesModule\Controller\AliceFixtures',
                            'action'     => 'aliceLoad'
                        ]
                    ]
                ]
            ]
        ]
    ],
];
