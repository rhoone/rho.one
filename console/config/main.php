<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'queue',
    ],
    'controllerNamespace' => 'console\controllers',
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'queue' => [
            'class' => \yii\queue\redis\Queue::class,
            'as log' => \yii\queue\LogBehavior::class,
            'redis' => 'redis_queue',
        ],
        'redis_queue' => [
            'class' => \yii\redis\Connection::class,
            'hostname' => 'redis_queue',
            'database' => 13,
        ],
    ],
    'modules' => [
        'spider' => [
            'class' => 'console\modules\spider\Module',
        ],
    ],
    'params' => $params,
];
