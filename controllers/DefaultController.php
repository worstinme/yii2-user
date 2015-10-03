<?php
/**
 * @link https://github.com/worstinme/yii2-user
 * @copyright Copyright (c) 2014 Evgeny Zakirov
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace worstinme\user\controllers;

use Yii;
use yii\web\Controller;

/**
 * @author Evgeny Zakirov
 * @package worstinme\user
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        echo 'HelloWorld';
    }
}
