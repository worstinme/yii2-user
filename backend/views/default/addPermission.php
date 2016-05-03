<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Links */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('user', 'Новое правило');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Правила доступа'), 'url' => ['permission']];
$this->params['breadcrumbs'][] = Yii::t('user', 'Новое правило');
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
            <?= Html::textInput('description','',['class'=>'uk-form-large uk-form-width-large']); ?>
            </div>
        </div>

        <div class="uk-form-row form-group">
            <?= Html::label(Yii::t('user', 'Разрешенный доступ'),'',['class'=>'uk-form-label']); ?>
            <div class="uk-form-controls">
            <?= Html::textInput('name','',['placeholder'=>'module/controller/action','class'=>'uk-form-large uk-form-width-large']); ?>
            </div>            
        </div>

        <p><?=Yii::t('user', '
            * Формат <em>module/controller/action</em><br>
            <em>site/article</em> - доступ к странице site/article<br>
            <em>site</em> - доступ к любым action контроллера site');?></p>

        <div class="uk-form-row form-group">
            <?= Html::submitButton(Yii::t('user', 'Сохранить'), ['class' => 'uk-button uk-button-large uk-button-success btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
</div>