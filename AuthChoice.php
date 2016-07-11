<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace worstinme\user;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\authclient\ClientInterface;


class AuthChoice extends \yii\authclient\widgets\AuthChoice
{

    public function clientLink($client, $text = null, array $htmlOptions = [])
    {
        if ($text === null) {
            $text = Html::tag('span', '<i class="uk-icon-'.$client->getName().'"></i>', ['class' => 'uk-button']);
            //$text .= Html::tag('span', $client->getTitle(), ['class' => 'auth-title']);
        }
        if (!array_key_exists('class', $htmlOptions)) {
            $htmlOptions['class'] = 'auth-link ' . $client->getName();
        }

        $viewOptions = $client->getViewOptions();
        if (empty($viewOptions['widget'])) {
            if ($this->popupMode) {
                if (isset($viewOptions['popupWidth'])) {
                    $htmlOptions['data-popup-width'] = $viewOptions['popupWidth'];
                }
                if (isset($viewOptions['popupHeight'])) {
                    $htmlOptions['data-popup-height'] = $viewOptions['popupHeight'];
                }
            }
            echo Html::a($text, $this->createClientUrl($client), $htmlOptions);
        } else {
            $widgetConfig = $viewOptions['widget'];
            if (!isset($widgetConfig['class'])) {
                throw new InvalidConfigException('Widget config "class" parameter is missing');
            }
            /* @var $widgetClass Widget */
            $widgetClass = $widgetConfig['class'];
            if (!(is_subclass_of($widgetClass, AuthChoiceItem::className()))) {
                throw new InvalidConfigException('Item widget class must be subclass of "' . AuthChoiceItem::className() . '"');
            }
            unset($widgetConfig['class']);
            $widgetConfig['client'] = $client;
            $widgetConfig['authChoice'] = $this;
            echo $widgetClass::widget($widgetConfig);
        }
    }
 
}