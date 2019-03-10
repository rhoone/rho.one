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
        'queue_downloading',
        'queue_analyzing',
        'queue_indexing',
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
        'queue_downloading' => [
            'class' => \yii\queue\redis\Queue::class,
            'as log' => \yii\queue\LogBehavior::class,
            'redis' => 'redis_queue_downloading',
        ],
        'queue_analyzing' => [
            'class' => \yii\queue\redis\Queue::class,
            'as log' => \yii\queue\LogBehavior::class,
            'redis' => 'redis_queue_analyzing',
        ],
        'queue_indexing' => [
            'class' => \yii\queue\redis\Queue::class,
            'as log' => \yii\queue\LogBehavior::class,
            'redis' => 'redis_queue_indexing',
        ],
        'redis_queue_downloading' => [
            'class' => \yii\redis\Connection::class,
            'hostname' => 'redis_queue',
            'database' => 13,
        ],
        'redis_queue_analyzing' => [
            'class' => \yii\redis\Connection::class,
            'hostname' => 'redis_queue',
            'database' => 14,
        ],
        'redis_queue_indexing' => [
            'class' => \yii\redis\Connection::class,
            'hostname' => 'redis_queue',
            'database' => 15,
        ],
        'amqp_queue' => [
            'class' => \yii\queue\amqp_interop\Queue::class,
            'port' => 5672,
            'user' => 'guest',
            'password' => 'guest',
            'queueName' => 'download_queue',
            'driver' => \yii\queue\amqp_interop\Queue::ENQUEUE_AMQP_LIB,
            'dsn' => 'amqp:',
        ],
    ],
    'modules' => [
        'spider' => [
            'class' => 'console\modules\spider\Module',
        ],
    ],
    'params' => $params,
];
