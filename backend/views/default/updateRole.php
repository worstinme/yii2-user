<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('user', 'Редактирование роли: ') . ' ' . $role->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Управление ролями'), 'url' => ['role']];
$this->params['breadcrumbs'][] = Yii::t('user', 'Редактирование');
?>
<div class="uk-grid">
    <div class="uk-width-medium-1-5">
        <?=$this->render('_nav')?>
    </div>
    <div class="uk-width-medium-4-5">

    <h1><?= Html::encode($this->title) ?></h1>

    <hr>
    
    <div class="links-form">

        <?php
        if (!empty($error)) {
            ?>
            <div class="error-summary">
                <?php
                echo implode('<br>', $error);
                ?>
            </div>
        <?php
        }
        ?>

        <?php $form = ActiveForm::begin(['options'=>['class'=>'uk-form uk-form-stacked']]); ?>

        <div class="uk-form-row form-group">
            <?= Html::label(Yii::t('user', 'Название роли'),'',['class'=>'uk-form-label']); ?>
            <div class="uk-form-controls">
            <?= Html::textInput('name', $role->name,['class'=>'uk-form-large uk-form-width-large']); ?>
            </div>
        </div>

        <div class="uk-form-row form-group">
            <?= Html::label(Yii::t('user', 'Текстовое описание'),'',['class'=>'uk-form-label']); ?>
            <div class="uk-form-controls">
            <?= Html::textInput('description', $role->description,['class'=>'uk-form-large uk-form-width-large']); ?>
            </div>
        </div>
        <?php if (count($permissions)): ?>
        <div class="uk-form-row form-group">
            <?= Html::label(Yii::t('user', 'Разрешенные доступы'),'',['class'=>'uk-form-label']); ?>
            <div class="uk-form-controls">
            <?= Html::checkboxList('permissions', $role_permit, $permissions, ['separator' => '<br>']); ?>
            </div>            
        </div>
        <?php endif ?>

        <div class="uk-form-row form-group">
            <div class="uk-form-controls">
            <?= Html::submitButton(Yii::t('user', 'Сохранить'), ['class' => 'uk-button uk-button-large uk-button-success btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
</div>