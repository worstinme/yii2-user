<?php

use worstinme\uikit\ActiveForm;
use yii\helpers\Html;
use worstinme\user\AuthChoice;

$this->title = Yii::t('user', 'TITLE_UPDATE');

?>

<div class="user-default-update">

    <?php if ($confirm_email): ?>
        <div class="uk-alert uk-alert-danger">
            <div class="uk-float-right">
                <?= Html::a(Yii::t('user', 'REQUEST_EMAIL_CONFIRM'), ['/user/default/request-email-confirm'], ['target' => '_blank', 'data' => ['method' => 'post']]); ?>
            </div>
            <?= Yii::t('user', 'USER_EMAIL_NOT_CONFIRMED') ?>
        </div>
    <?php endif ?>

    <?php $form = ActiveForm::begin(['layout' => 'stacked', 'field_width' => 'large', 'field_size' => 'large']); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['value' => '', 'maxlength' => '255']); ?>

    <?= $form->field($model, 'password_repeat')->passwordInput(['value' => '', 'maxlength' => '255']); ?>

    <div class="uk-form-row">
        <?= Html::submitButton(Yii::t('user', 'BUTTON_SAVE'), ['class' => 'uk-width-1-1 uk-button-large uk-button uk-button-primary']) ?>
    </div>

    <?php if (Yii::$app->has('authClientCollection')): ?>
        <p><?= Yii::t('user', 'LINK_SOCIAL_TO_USER') ?></p>
        <div class="uk-margin-top">
            <?php $authAuthChoice = AuthChoice::begin(['baseAuthUrl' => ['/user/default/auth']]); ?>
            <div class="services uk-display-inline-block uk-subnav">
                <?php foreach ($authAuthChoice->getClients() as $client): ?>
                    <?php $authAuthChoice->clientLink($client) ?>
                <?php endforeach; ?>
            </div>
            <?php AuthChoice::end(); ?>
        </div>
    <?php endif ?>

    <?php ActiveForm::end(); ?>
</div>

