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

/**
 * AuthChoice prints buttons for authentication via various auth clients.
 * It opens a popup window for the client authentication process.
 * By default this widget relies on presence of [[\yii\authclient\Collection]] among application components
 * to get auth clients information.
 *
 * Example:
 *
 * ~~~php
 * <?= yii\authclient\widgets\AuthChoice::widget([
 *     'baseAuthUrl' => ['site/auth']
 * ]); ?>
 * ~~~
 *
 * You can customize the widget appearance by using [[begin()]] and [[end()]] syntax
 * along with using method [[clientLink()]] or [[createClientUrl()]].
 * For example:
 *
 * ~~~php
 * <?php
 * use yii\authclient\widgets\AuthChoice;
 * ?>
 * <?php $authAuthChoice = AuthChoice::begin([
 *     'baseAuthUrl' => ['site/auth']
 * ]); ?>
 * <ul>
 * <?php foreach ($authAuthChoice->getClients() as $client): ?>
 *     <li><?php $authAuthChoice->clientLink($client) ?></li>
 * <?php endforeach; ?>
 * </ul>
 * <?php AuthChoice::end(); ?>
 * ~~~
 *
 * This widget supports following keys for [[ClientInterface::getViewOptions()]] result:
 *  - popupWidth - integer width of the popup window in pixels.
 *  - popupHeight - integer height of the popup window in pixels.
 *  - widget - configuration for the widget, which should be used to render a client link;
 *    such widget should be a subclass of [[AuthChoiceItem]].
 *
 * @see \yii\authclient\AuthAction
 *
 * @property array $baseAuthUrl Base auth URL configuration. This property is read-only.
 * @property ClientInterface[] $clients Auth providers. This property is read-only.
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.0
 */
class AuthChoice extends \yii\authclient\widgets\AuthChoice
{

    public function clientLink($client, $text = null, array $htmlOptions = [])
    {
        if ($text === null) {
            $text = Html::tag('span', '', ['class' => 'auth-icon ' . $client->getName()]);
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