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
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => [
                        '//cdn.bootcss.com/jquery/3.2.1/jquery.min.js',
                    ],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'css' => [
                        '//cdn.bootcss.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css',
                    ],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'js' => [
                        '//cdn.bootcss.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js',
                    ],
                ],
                'rhoone\assets\NprogressAsset' => [
                    'sourcePath' => null,
                    'js' => [
                        '//cdn.bootcss.com/nprogress/0.2.0/nprogress.min.js',
                    ],
                    'css' => [
                        '//cdn.bootcss.com/nprogress/0.2.0/nprogress.min.css',
                    ],
                ],
                'common\assets\FontAwesomeAsset' => [
                    'sourcePath' => null,
                    'css' => [
                        '//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css',
                    ],
                ],
                'common\assets\OpenSansAsset' => [
                    'sourcePath' => null,
                    'css' => [
                        '//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css',
                    ],
                ],
                'common\assets\HolderAsset' => [
                    'sourcePath' => null,
                    'js' => [
                        '//cdn.bootcss.com/holder/2.9.6/holder.min.js',
                    ],
                ],
            ],
        ],
        'elasticsearch' => [
            'class' => 'yii\elasticsearch\Connection',
            'nodes' => [
                ['http_address' => 'inet[/elasticsearch:9200]',],
            ],
        ],
        'urlManager' => [
            'rules' => [
                'about' => 'site/about',
            ],
        ],
        'mongodb' => [
            'class' => \yii\mongodb\Connection::class,
            'dsn' => 'mongodb://mongodb_library_tongjiuniversity:27017/tongjiuniversity',
            'options' => [
                'username' => 'owner',
                'password' => '123456',
            ],
        ],
    ],
    'modules' => [
        'rhoone' => [
            'class' => 'rhoone\Module',
        ],
    ],
];
