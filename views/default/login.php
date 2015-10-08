<?php
use yii\helpers\Html;
use worstinme\uikit\ActiveForm;
use worstinme\user\AuthChoice;

$this->title = 'Login'; 
?>

<div class="user-default-login">

    <?php $form = ActiveForm::begin(['id' => 'login-form','layout'=>'stacked','field_width'=>'full','field_size'=>'large']); ?>
                    
        <?= $form->field($model, 'username')->label(false)->textInput(['placeholder' => Yii::t('user','CONTACT_NAME_EMAIL')])  ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>Yii::t('user','USER_PASSWORD')])->label(false) ?>
                    
        <div class="uk-form-row">
            <?= Html::submitButton(Yii::t('user','USER_BUTTON_SIGNUP'), ['class' => 'uk-button uk-button-success uk-button-large uk-width-1-1', 'name' => 'login-button']) ?>
        </div>
                    
        <div class="uk-form-row">
            <?= $form->field($model, 'rememberMe',['options'=> ['class'=>'uk-float-left uk-text-small']])->checkbox() ?> 
            <?= Html::a(Yii::t('user','LINK_RESET_PASSWORD'), ['/user/default/request-password-reset'],['class'=>'uk-text-small uk-float-right']) ?>
        </div>

        <?php $authAuthChoice = AuthChoice::begin([ 'baseAuthUrl' => ['/user/default/auth']]); ?>
        <div class="services uk-margin-top">
        <?php foreach ($authAuthChoice->getClients() as $client): ?>
            <?php $authAuthChoice->clientLink($client) ?>
        <?php endforeach; ?>
        </div>
        <?php AuthChoice::end(); ?>
                    
        <div class="uk-form-row uk-text-center">
            <?= Html::a(Yii::t('user','NAV_SIGNUP'), ['/user/default/signup'],['class'=>'uk-button uk-button-primary uk-button-mini uk-width-1-1']) ?>
        </div>

    <?php ActiveForm::end(); ?>

    

</div>