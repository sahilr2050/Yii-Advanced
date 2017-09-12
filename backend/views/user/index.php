<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php Pjax::begin(['clientOptions' => ['method' => 'POST']]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title pull-right">

                    </h3>
                    <p class="pull-right">
                        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                </div>
                <div class="box-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            //'id',
                            'username',
                            // 'auth_key',
                            // 'password_hash',
                            // 'password_reset_token',
                            'email:email',
                            [
                                'label'=>'Status',
                                'format'=>'raw',
                                'value' => function($model) { return $model->status == 10 ? '<span><small class="label bg-green">Active</small></span>' : '<span><small class="label bg-yellow">In active</small></span>';},
                                'filter' => ['Active' => 10, 'In active' => 0],
                            ],
                            [
                                'attribute' => 'created_at',
                                'header' => 'Registration Date',
                                'format' => ['date', 'php:d/m/Y h:i A'],
                                'filter' => false,
                                'enableSorting' => true,
                                'contentOptions'=>[
                                    //'style'=>'width: 130px;',
                                ]
                            ],
                            //'created_at',
                            // 'updated_at',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Actions',
                                'template' => '{view}{update}{delete}',
                                'buttons' => [
                                    'view' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                            'title' => Yii::t('app', 'view'),
                                            'class' => "btn btn-social-icon btn-flat btn-sm"
                                        ]);
                                    },

                                    'update' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                            'title' => Yii::t('app', 'update'),
                                            'class' => "btn btn-social-icon btn-flat btn-sm"
                                        ]);
                                    },
                                    'delete' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                            'title' => Yii::t('app', 'delete'),
                                            'class' => "btn btn-social-icon btn-flat btn-sm"
                                        ]);
                                    }
                                ],
                                'urlCreator' => function ($action, $model, $key, $index) {
                                    if ($action === 'view') {
                                        $url ='user/view?id='.$model->id;
                                        return $url;
                                    }

                                    if ($action === 'update') {
                                        $url ='user/update?id='.$model->id;
                                        return $url;
                                    }
                                    if ($action === 'delete') {
                                        $url ='user/delete?id='.$model->id;
                                        return $url;
                                    }
                                }
                            ],
                        ],
                    ]); ?>
                </div>
                <div class="box-footer clearfix">
                    <!-- <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="#">«</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">»</a></li>
                    </ul> -->
                </div>
            </div>

        </div>
        <!-- /.col -->
    </div>
    <?php Pjax::end(); ?>
</div>