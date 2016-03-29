<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = Yii::t('user', 'TITLE_PROFILE');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class=" main user-profile">
<div class="uk-container uk-container-center uk-text-center">

<h1><span><?= Html::encode($this->title) ?></span></h1>

<div class="uk-grid">
<div class="uk-width-1-2 uk-push-1-4">

    <table id="w0" class="uk-table uk-table-bordered uk-table-middle uk-table-condensed">
    <tbody>
        <tr><th>Имя пользователя</th><td class="uk-text-right"><?=$model->username?></td></tr>
        <tr><th>Email</th><td class="uk-text-right"><?=$model->email?></td></tr>

        <?php foreach ($model->jsonParams as $param): ?>
        <tr><th><?=$model->getAttributeLabel($param);?></th><td class="uk-text-right"><?=!empty($model->{$param})?$model->{$param}:'не указано'?></td></tr>    
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <td class="uk-text-left"><hr><?= Html::a(Yii::t('user', 'LINK_CHANGE_PASSWORD'), ['change-password']) ?></td>
            <td class="uk-text-right"><hr><?= Html::a(Yii::t('user', 'BUTTON_UPDATE'), ['update']) ?></td>
        </tr>
    </tfoot>
    </table>
</div>
</div>

</div>
</div>