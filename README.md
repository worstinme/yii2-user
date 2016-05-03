# yii2-user

`In developing. Use at your own risk`

User Auth / DB-RBAC / AuthClient module stiled with Uikit Framework.

[![Latest Stable Version](https://poser.pugx.org/worstinme/yii2-user/v/stable.png)](https://packagist.org/packages/worstinme/yii2-user)
[![Total Downloads](https://poser.pugx.org/worstinme/yii2-user/downloads.png)](https://packagist.org/packages/worstinme/yii2-user)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist worstinme/yii2-user
```

or add

```
"worstinme/yii2-user": "^1.0.0"
```

to the require section of your `composer.json` file.

Required configurations
-----------------------

```php
'modules' => [
    'user' => [
        'class' => 'worstinme\user\Module',
    ],
    'useradmin' => [
        'class' => 'worstinme\user\backend\Module',
    ],
    ....
 ],
'components' => [
	'user' => [
        'class'=>'worstinme\user\User',
        'identityClass' => 'worstinme\user\models\User',
        'enableAutoLogin' => true,
        'loginUrl'=>['/user/default/login'],
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
RBAC configurations
-------------------
to web.php & console.php components section

```php
    'authManager' => [
            'class' => 'yii\rbac\DbManager',
    ],
]
```
& migrations

```
$ yii migrate --migrationPath=@yii/rbac/migrations/
```

Then, use migrations to create user tables & default user administrator:administrator with admin role(don't forget to change it's default password).

```
$ yii migrate --migrationPath=@worstinme/user/migrations/
```