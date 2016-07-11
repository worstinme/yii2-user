<?php
use yii\helpers\Html;
use worstinme\uikit\ActiveForm;
use worstinme\uikit\Captcha;
use worstinme\user\AuthChoice;

$this->title = Yii::t('user', 'TITLE_SIGNUP');

?>
<div class="user-default-signup">

<p><?= Yii::t('user', 'PLEASE_FILL_FOR_SIGNUP') ?></p>

<?php $form = ActiveForm::begin(['layout'=>'stacked','field_width'=>'large','field_size'=>'large','fieldConfig'=>['template'=>'{input}{error}']]); ?>

    <?= $form->field($model, 'email')->textInput(['autocomplete'=>'off','placeholder' => Yii::t('user','USER_EMAIL')]) ?>

    <?= $form->field($model, 'username')->textInput(['autocomplete'=>'off','placeholder' => Yii::t('user','USER_USERNAME')])?>

    <?= $form->field($model, 'password')->textInput(['autocomplete'=>'off','placeholder'=>Yii::t('user','USER_PASSWORD')]) ?>

    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
        'captchaAction' => '/user/default/captcha',
        'options'=>['class'=>'uk-form-large uk-width-1-1','placeholder' => Yii::t('user','USER_CAPTCHA')]
        ]) ?>

    <div class="uk-form-row">
        <?= Html::submitButton(Yii::t('user', 'USER_BUTTON_REG'), ['class' => 'uk-button-large uk-button uk-button-primary uk-width-1-1']) ?>
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
        <?= Html::a(Yii::t('user','NAV_LOGIN'), ['/user/default/login']) ?>
    </div>

<?php ActiveForm::end(); ?>
</div>