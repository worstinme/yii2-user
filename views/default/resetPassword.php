<?php
use yii\helpers\Html;
use worstinme\uikit\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\user\models\ResetPasswordForm */

$this->title = Yii::t('user', 'TITLE_RESET_PASSWORD');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-reset-password">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::t('user', 'PLEASE_FILL_FOR_RESET') ?></p>

    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
    
        <?= $form->field($model, 'password')->passwordInput() ?>
        
        <div class="uk-form-row">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>
        
</div>