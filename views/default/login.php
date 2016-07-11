<?php
use yii\helpers\Html;
use worstinme\uikit\ActiveForm;
use worstinme\user\AuthChoice;

$this->title = Yii::t('user', 'TITLE_LOGIN');; 

?>
<div class="user-default-login">
<?php $form = ActiveForm::begin(['id' => 'login-form','layout'=>'stacked','field_width'=>'full','field_size'=>'large','fieldConfig'=>['template'=>'{input}{error}']]); ?>
                    
    <?= $form->field($model, 'username')->label(false)->textInput(['placeholder' => Yii::t('user','CONTACT_NAME_EMAIL')])  ?>

    <?= $form->field($model, 'password')->passwordInput(['placeholder'=>Yii::t('user','USER_PASSWORD')])->label(false) ?>
                
    <div class="uk-form-row">
        <?= Html::submitButton(Yii::t('user','NAV_LOGIN'), ['class' => 'uk-button uk-button-success uk-button-large uk-width-1-1', 'name' => 'login-button']) ?>
    </div>
                
    <div class="uk-form-row">
        <?= $form->field($model, 'rememberMe',['options'=> ['class'=>'uk-float-left uk-text-small']])->checkbox() ?> 
        <?= Html::a(Yii::t('user','LINK_RESET_PASSWORD'), ['/user/default/request-password-reset'],['class'=>'uk-text-small uk-float-right']) ?>
    </div>

    <?php if (Yii::$app->has('authClientCollection')): ?>
    <div class="uk-margin-top">    
        <?php $authAuthChoice = AuthChoice::begin([ 'baseAuthUrl' => ['/user/default/auth']]); ?>
        <div class="services uk-display-inline-block uk-subnav">
            <?php foreach ($authAuthChoice->getClients() as $client): ?>
                <?php $authAuthChoice->clientLink($client) ?>
            <?php endforeach; ?>
        </div>
        <?php AuthChoice::end(); ?>
    </div>  
    <?php endif ?>
       
    <hr>

    <div class="uk-text-center">
        <?= Html::a(Yii::t('user','NAV_SIGNUP'), ['/user/default/signup'],['class'=>'']) ?>
    </div>

<?php ActiveForm::end(); ?>
</div>