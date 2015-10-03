<?php
/**
 * @link https://github.com/worstinme/yii2-user
 * @copyright Copyright (c) 2014 HimikLab
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace worstinme\user;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Module;


class User extends Module
{
	public $controllerNamespace = 'worstinme\user\controllers';

	public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}