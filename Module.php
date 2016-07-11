<?php
/**
 * @link https://github.com/worstinme/yii2-user
 * @copyright Copyright (c) 2014 Evgeny Zakirov
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace worstinme\user;

use Yii;
use yii\base\InvalidConfigException;


class Module extends \yii\base\Module
{
	public $controllerNamespace = 'worstinme\user\controllers';
	public $profileModel = '\worstinme\user\models\Profile';
	public $layout = 'clean';

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

	public static function t($category, $message, $params = [], $language = null)
	{
	    return Yii::t('modules/user/' . $category, $message, $params, $language);
	}
}