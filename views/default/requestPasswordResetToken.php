<?php
use yii\helpers\Html;
use worstinme\uikit\ActiveForm;

$this->title = Yii::t('user', 'TITLE_RESET_PASSWORD');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-request-password-reset">

    <p><?= Yii::t('user', 'PLEASE_FILL_FOR_RESET_REQUEST') ?></p>

    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form','field_width'=>'full','field_size'=>'large']); ?>
    
        <?= $form->field($model, 'email')->textInput(['autocomplete'=>'off','placeholder' => Yii::t('user','USER_EMAIL')])->label(false) ?>
                
        <div class="uk-form-row">
            <?= Html::submitButton(Yii::t('user', 'BUTTON_SEND'), ['class' => 'uk-button uk-button-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    
</div>