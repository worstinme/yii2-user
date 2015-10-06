# yii2-user

User AUTH / RBAC / AUTHCLIENT Mdoule stiled width UiKit Css Framework.

See also [yii2-user-admin](https://github.com/worstinme/yii2-user-admin).

[![Latest Stable Version](https://poser.pugx.org/worstinme/yii2-user/v/stable.png)](https://packagist.org/packages/worstinme/yii2-user)
[![Total Downloads](https://poser.pugx.org/worstinme/yii2-user/downloads.png)](https://packagist.org/packages/worstinme/yii2-user)
[![Build Status](https://travis-ci.org/worstinme/yii2-user.svg?branch=master)](https://travis-ci.org/worstinme/yii2-user)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist worstinme/yii2-user
```

or add

```
"worstinme/yii2-user": "~2.0.0"
```

to the require section of your `composer.json` file.


Required configurations
-----------------------

```php
'modules' => [
    'user' => [
        'class' => 'worstinme\user\Module',
    ],
    ....
 ],
'components' => [
	'user' => [
        'class'=>'worstinme\user\User',
        'identityClass' => 'worstinme\user\models\User',
        'enableAutoLogin' => true,
        'loginUrl'=>array('/user/default/login'),
    ],
    'authClientCollection' => [
        'class' => 'yii\authclient\Collection',
        'clients' => [
            'google' => [
                'class' => 'yii\authclient\clients\GoogleOpenId'
            ],
            'facebook' => [
                'class' => 'yii\authclient\clients\Facebook',
                'clientId' => 'facebook_client_id',
                'clientSecret' => 'facebook_client_secret',
            ],
            // etc.
        ],
    ]
    //	...
]
```

& migrations

```
$ yii migrate --migrationPath=@worstinme/user/migrations/
```

RBAC configurations
-------------------

```php
'components' => [
    'authManager' => [
            'class' => 'yii\rbac\DbManager',
    ],
    //	...
]
```
& migrations

```
$ yii migrate --migrationPath=@yii/rbac/migrations/
```