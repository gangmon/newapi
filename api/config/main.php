<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'wechat' => [ // 指定微信模块
            'class' => 'callmez\wechat\Module',
            'adminId' => [1,2,3], // 填写管理员ID, 该设置的用户将会拥有wechat最高权限, 如多个请填写数组 [1, 2]
        ],
    ],
    'components' => [
        'applet' => [
            'class' => 'hollisho\applet\Applet',
            'appid' => 'wx2f44d41564140f7f',
            'secret' => 'de27bae6891e039c3b67909ddb645b57'
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-api',
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,//api应用所接受的URL请求，至少要符合一条rules中设定的规则，否则就会抛出异常
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'article',

                    'extraPatterns' => [
                        'POST search' => 'search',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'top10',
                    'pluralize' => false,//使URL访问时不需要加S

                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'appid',
                    'pluralize' => false,

                    'extraPatterns' => [
                        'POST search' => 'search',
                        'GET test' => 'test',
                        'GET gettoken' => 'gettoken',
                        'POST gettoken' => 'gettoken',
                        'GET qrcode' => 'qrcode',
                        'POST qrcode' => 'qrcode',
                        'POST template' => 'template',
                        'POST sendmsg' => 'sendmsg'

                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'userapi',
                    'pluralize' => false,

                    'extraPatterns' => [
                        'POST findexit' => 'findexit',
                        'GET findexit'  => 'findexit',
                    ],

                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'post',

                    'extraPatterns' => [
                        'POST search' => 'search',
                        'GET search' => 'search',
                        'POST addread' => "addread",
                        'POST searchsomething' => 'searchsomething',

                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'comment',

                    'extraPatterns' => [
                        'POST search' => 'search',
                        'GET search' => 'search',
                        'POST addread' => "addread",
                        'POST searchsomething' => 'searchsomething',

                    ],
                ],
            ],
        ],
        
    ],
    'params' => $params,
];
