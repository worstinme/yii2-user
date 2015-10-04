<?php
use yii\captcha\Captcha;
use yii\helpers\Html;
use worstinme\uikit\ActiveForm;
use worstinme\user\Module;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\user\models\SignupForm */

$this->title = Module::t('app', 'TITLE_SIGNUP');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uk-vertical-align uk-text-center uk-height-1-1">
    <div class="uk-vertical-align-middle">
        <div class="uk-panel uk-panel-box mg-user-form uk-margin-top">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Module::t('app', 'PLEASE_FILL_FOR_SIGNUP') ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup','layout'=>'stacked','field_width'=>'full','field_size'=>'large']); ?>
            <?= $form->field($model, 'username')->label(false)->textInput(['placeholder' => Module::t('app','USER_USERNAME')]) ?>
            <?= $form->field($model, 'email')->label(false)->textInput(['placeholder' => Module::t('app','USER_EMAIL')]) ?>
            <?= $form->field($model, 'password')->passwordInput(['placeholder'=>Module::t('app','USER_PASSWORD')])->label(false) ?>
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'captchaAction' => '/user/default/captcha',
                'template' => '<div class="uk-grid"><div class="uk-width-1-2">{input}</div><div class="uk-width-1-2">{image}</div></div>',
            ],['placeholder' => Module::t('app','USER_EMAIL')])->label(false) ?>

            <div class="uk-form-row">
                <?= Html::submitButton(Module::t('app', 'USER_BUTTON_REG'), ['class' => 'uk-button-large uk-button uk-button-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>
</div>