<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl'=>'/api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'backend\models\Token',
            'loginUrl' => null,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'enableSession'=>false,
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class'=>'yii\rest\UrlRule',
                    'controller'=>'auth',
                    'extraPatterns' =>[

                    ]
                ],
                [
                    'class'=>'yii\rest\UrlRule',
                    'controller'=>'companies',
                    'extraPatterns' =>[
                        'POST gettashkilot'=>'gettashkilot',
                        'GET  companytype' =>'companytype',
                        'POST  create-company-type' =>'create-company-type',
                        'POST  update-company-type' =>'update-company-type',
                        'POST  send' =>'send',
                    ]
                ]
            ],
        ],

    ],
    'params' => $params,
];
