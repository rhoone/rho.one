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
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;