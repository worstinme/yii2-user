<?php 

namespace worstinme\user;

use Yii;

class User extends \yii\web\User
{

    public function init()
    {
        parent::init();

        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['user'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-EN',
            'basePath' => '@worstinme/user/messages',
        ];
    }
    
}