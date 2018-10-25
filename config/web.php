<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'upload'       => [
            'class' => 'app\services\UploadService',
        ],
        'uploadTrainings'       => [
            'class' => 'app\services\UploadTrainingsService',
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-blue',
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => ['user','moder','admin'], //здесь прописываем роли
            //зададим куда будут сохраняться наши файлы конфигураций RBAC
            'itemFile' => '@app/config/rbac/items.php',
            'assignmentFile' => '@app/config/rbac/assignments.php',
            'ruleFile' => '@app/config/rbac/rules.php',
        ],
        'request' => [
            'baseUrl'=> '',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '1ooYZiv-2nMnfF6OJJQtv2MGyME7ll7r',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'api/v1/books/list' => 'api/books/list',
                'api/v1/books/by-id/<id:\d+>' => 'api/books/by-id',
                'api/v1/books/update/<id:\d+>' => 'api/books/update',
                'api/v1/books/id/<id:\d+>' => 'api/books/id',

                '/' => '/books/index',
                '' => '/books/index',
            ],
        ],
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => '@app/modules/admin/views/layouts/main',
        ],
        'api' => [
            'class' => 'app\modules\api\v1\v1',
        ],
    ],
    'params' => $params,
    'aliases'      => require '_aliases.php',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

// Добавляю генератор кода ajax_form_crud
if (YII_ENV_DEV) {
	$config['modules']['gii']['generators']['ajax_form_crud_generator'] = [
		'class' => 'alhimik1986\yii2_crud_module\generators\crud\Generator',
		'templates' => [
			'ajax_form_template' => '@vendor/alhimik1986/yii2_crud_module/generators/crud/default',
		],
	];
}

return $config;
