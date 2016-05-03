<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\grid\DataColumn;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::t('user', 'Правила доступа');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uk-grid">

    <div class="uk-width-medium-1-5">
        <?=$this->render('_nav')?>
    </div>
    <div class="uk-width-medium-4-5">

    <h1><?= Html::encode($this->title) ?></h1>

    <hr>

    <?php
    $dataProvider = new ArrayDataProvider([
          'allModels' => Yii::$app->authManager->getPermissions(),
          'sort' => [
              'attributes' => ['name', 'description'],
          ],
          'pagination' => [
              'pageSize' => 10,
          ],
     ]);
    ?>

    <?=GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>false,
        'tableOptions'=>[
            'class'=>'uk-table uk-table-condensed uk-table-striped uk-table-hover',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class'     => DataColumn::className(),
                'attribute' => 'name',
                'label'     => Yii::t('user', 'Правило')
            ],
            [
                'class'     => DataColumn::className(),
                'attribute' => 'description',
                'label'     => Yii::t('user', 'Описание')
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'contentOptions'=>['class'=>'uk-text-right'],
                'buttons' =>
                    [
                        'update' => function ($url, $model) {
                                    return Html::a('<i class="uk-icon-pencil"></i>', Url::toRoute(['update-permission', 'name' => $model->name]), [
                                            'title' => Yii::t('yii', 'Update'),
                                            'data-pjax' => '0',
                                            'class'=>'uk-button uk-button-success uk-button-mini'
                                        ]); },
                        'delete' => function ($url, $model) {
                                    return Html::a('<i class="uk-icon-trash"></i>', Url::toRoute(['delete-permission','name' => $model->name]), [
                                            'title' => Yii::t('yii', 'Delete'),
                                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                            'data-method' => 'post',
                                            'data-pjax' => '0',
                                            'class'=>'uk-button uk-button-danger uk-button-mini'
                                        ]);
                            }
                    ]
            ],
            ]
        ]);
    ?>

    </div>
</div>