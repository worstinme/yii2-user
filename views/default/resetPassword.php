<?php
use yii\helpers\Html;
use worstinme\uikit\ActiveForm;

$this->title = Yii::t('user', 'TITLE_RESET_PASSWORD');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-reset-password">

    <p><?= Yii::t('user', 'PLEASE_FILL_FOR_RESET') ?></p>

    <?php $form = ActiveForm::begin(['id' => 'reset-password-form','field_width'=>'full','field_size'=>'large']); ?>
    
        <?= $form->field($model, 'password')->passwordInput(['autocomplete'=>'off'])->label(false) ?>
        
        <div class="uk-form-row">
        <?= Html::submitButton(Yii::t('user', 'BUTTON_SAVE_PASSWORD'), ['class' => 'uk-width-1-1 uk-button-large uk-button uk-button-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        
</div>