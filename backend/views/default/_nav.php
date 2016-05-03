<?php

use worstinme\uikit\Nav;

?>
<div class="uk-panel uk-panel-box">
<h3 class="uk-panel-title">Пользователи</h3>
<?= Nav::widget([
    'options'=>['class'=>'uk-nav-side','data-uk-nav'=>true],
    'items' => [
        ['label' => 'Список пользователей', 'url' => ['/'.Yii::$app->controller->module->id.'/default/index'],], 
        '<li class="uk-nav-divider"></li>',
        ['label' => 'Управление ролями', 'url' => ['/'.Yii::$app->controller->module->id.'/default/role'],], 
        ['label' => 'Управление доступами', 'url' => ['/'.Yii::$app->controller->module->id.'/default/permission'],], 
        '<li class="uk-nav-divider"></li>',
        ['label' => 'Добавить правило', 'url' => ['/'.Yii::$app->controller->module->id.'/default/add-permission'],],
        ['label' => 'Добавить роль', 'url' => ['/'.Yii::$app->controller->module->id.'/default/add-role'],],
    ],
]); ?>
</div>