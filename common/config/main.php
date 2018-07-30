<?php

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => ['rhoone'],
    'language' => 'zh-CN',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'assetManager' => [
            'linkAssets' => true,
        ],
    ],
    'modules' => [
        'rhoone' => [
            'class' => 'rhoone\Module',
        ],
    ],
];
