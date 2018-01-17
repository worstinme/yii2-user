<?php
/**
 * @link https://github.com/worstinme/yii2-user
 * @copyright Copyright (c) 2014 Evgeny Zakirov
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace worstinme\user\backend;
use Yii;
use yii\base\InvalidConfigException;
class Module extends \yii\base\Module
{
	public $controllerNamespace = 'worstinme\user\backend\controllers';
	public $activeFormClass = 'worstinme\uikit\ActiveForm';
	public function init()
    {
        parent::init();
        $this->registerTranslations();
    }
    public function registerTranslations()
	{
	    Yii::$app->i18n->translations['user'] = [
	        'class' => 'yii\i18n\PhpMessageSource',
	        'sourceLanguage' => 'ru-RU',
	        'basePath' => '@worstinme/user/messages',
	    ];
	}
}