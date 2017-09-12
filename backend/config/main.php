<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.10.157'],
            'generators' => [ //here
                'crud' => [
                    'class' => 'yii\gii\generators\crud\Generator',
                    'templates' => [
                        'adminlte' => '@vendor/dmstr/yii2-adminlte-asset/gii/templates/crud/simple',
                    ]
                ]
            ],
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'top-menu', // avaliable value 'left-menu', 'right-menu' and 'top-menu'
            'controllerMap' => [
                 'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'backend\models\User',
                    'idField' => 'id'
                ]
            ],
            'menus' => [
                'assignment' => [
                    'label' => 'Grand Access' // change label
                ],
                'route' => null, // disable menu
            ],
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-red-light',
                    // 'skin' => "skin-blue",
                    // 'skin' => "skin-black",
                    // 'skin' => "skin-red",
                    // 'skin' => "skin-yellow",
                    // 'skin' => "skin-purple",
                    // 'skin' => "skin-green",
                    // 'skin' => "skin-blue-light",
                    // 'skin' => "skin-black-light",
                    // 'skin' => "skin-red-light",
                    // 'skin' => "skin-yellow-light",
                    // 'skin' => "skin-purple-light",
                    // 'skin' => "skin-green-light"
                ],
            ],
        ],
       'urlManager' => [
            // here is your normal backend url manager config
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
       ],

      /*
       'urlManagerFrontend' => [
           // here is your frontend URL manager config
           // To access frontend url from backend. echo Yii::$app->urlManagerFrontend->createUrl(...);
       ],
       */
      'as access' => [
        'class' => 'backend\components\AccessControl',
        'allowActions' => [
            'admin/*', // add or remove allowed actions to this list
        ]
    ],
    ],
    'params' => $params,
];
