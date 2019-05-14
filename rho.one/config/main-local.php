<?php

$config = [
    'components' => [
        'request' => [
            'cookieValidationKey' => '1RH-m4EdB4bviYKtl2TajL0YiAQrckY8',
        ]
    ]
];

if (!YII_ENV_TEST) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
        'panels' => [
            'elasticsearch' => 'yii\elasticsearch\DebugPanel',
            'mongodb' => [
                'class' => 'yii\mongodb\debug\MongoDbPanel',
                // 'db' => 'mongodb', // MongoDB component ID, defaults to `db`. Uncomment and change this line, if you registered MongoDB component with a different ID.
            ],
        ],
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;