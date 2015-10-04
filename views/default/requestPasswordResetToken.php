<?php
use yii\helpers\Html;
use worstinme\uikit\ActiveForm;
use worstinme\user\Module;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\user\models\PasswordResetRequestForm */

$this->title = Module::t('app', 'TITLE_RESET_PASSWORD');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-request-password-reset">
    
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Module::t('app', 'PLEASE_FILL_FOR_RESET_REQUEST') ?></p>

    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form','field_width'=>'full','field_size'=>'large']); ?>
    
        <?= $form->field($model, 'email')->textInput(['placeholder' => Module::t('app','USER_EMAIL')])->label(false) ?>
                
        <div class="uk-form-row">
            <?= Html::submitButton(Module::t('app', 'BUTTON_SEND'), ['class' => 'uk-button uk-button-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    
</div>