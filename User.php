<?php
/**
 * @link https://github.com/worstinme/yii2-user
 * @copyright Copyright (c) 2014 Evgeny Zakirov
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace worstinme\user;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Module;

/**
 * @author Evgeny Zakirov
 * @package worstinme\user
 */
class User extends Module
{
	public $controllerNamespace = 'worstinme\user\controllers';

	public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}