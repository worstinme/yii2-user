<?php
/**
 * @link https://github.com/worstinme/yii2-user
 * @copyright Copyright (c) 2014 Evgeny Zakirov
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace worstinme\user;

use Yii;
use yii\base\InvalidConfigException;

/**
 * @author Evgeny Zakirov
 * @package worstinme\user
 */
class Module extends \yii\base\Module
{
	public $controllerNamespace = 'worstinme\user\controllers';

	public function init()
    {
        parent::init();

        $this->registerTranslations();

        

        // custom initialization code goes here
    }

    public function registerTranslations()
	{
	    Yii::$app->i18n->translations['worstinme/user/*'] = [
	        'class' => 'yii\i18n\PhpMessageSource',
	        'sourceLanguage' => Yii::$app->sourceLanguage,
	        'basePath' => '@vendor/worstinme/yii2-user/messages',
	        'fileMap' => [
	            'worstinme/user/app' => 'app.php',
	        ],
	    ];
	}

	public static function t($category, $message, $params = [], $language = null)
	{
	    return Yii::t('worstinme/user/' . $category, $message, $params, $language);
	}
}