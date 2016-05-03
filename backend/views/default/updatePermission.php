<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('user', 'Редактирование правила: ') . ' ' . $permit->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Правила доступа'), 'url' => ['permission']];
$this->params['breadcrumbs'][] = Yii::t('user', 'Редактирование правила');
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
            <?= Html::label(Yii::t('user', 'Текстовое описание'),'',['class'=>'uk-form-label']); ?>
            <div class="uk-form-controls">
            <?= Html::textInput('description', $permit->description,['class'=>'uk-form-large uk-form-width-large']); ?>
            </div>
        </div>

        <div class="uk-form-row form-group">
            <?= Html::label(Yii::t('user', 'Разрешенный доступ'),'',['class'=>'uk-form-label']); ?>
            <div class="uk-form-controls">
            <?= Html::textInput('name', $permit->name,['class'=>'uk-form-large uk-form-width-large']); ?>
            </div>
        </div>

        <div class="uk-form-row form-group">
            <?= Html::submitButton(Yii::t('user', 'Сохранить'), ['class' => 'uk-button uk-button-large uk-button-success btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
</div>