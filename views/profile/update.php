<?php

use worstinme\uikit\ActiveForm;
use yii\helpers\Html;
use worstinme\user\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = Module::t('app', 'TITLE_UPDATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'TITLE_PROFILE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

        <?php $form = ActiveForm::begin(['layout'=>'stacked','field_width'=>'medium','field_size'=>'large']); ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <div class="uk-form-row">
            <?= Html::submitButton(Module::t('app', 'BUTTON_SAVE'), ['class' => 'uk-button uk-button-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
