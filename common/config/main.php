<?php
return [
	'name' => 'BlockChain',
	'language'=>'ru-RU',
	'defaultRoute' => 'block',
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
