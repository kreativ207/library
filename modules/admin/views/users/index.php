<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
//var_dump(Yii::$app->user->identity->id);
?>

<div class="arize-user-index">

    <p>
        <?/*= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) */?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            'email:email',
            //'password_hash',
            'open_pass',
            'tell',
            'address',
            // 'auth_key',
            // 'confirmed_at',
            // 'unconfirmed_email:email',
            // 'blocked_at',
            // 'registration_ip',
            /*[
                'label' => 'Created At',
                'format' => 'html',
                'value' => function ($data) {
                    if($data['created_at']){
                        return date("Y-m-d H:i:s",$data['created_at']);
                    }
                }

            ],
            [
                'label' => 'Update At',
                'format' => 'html',
                'value' => function ($data) {
                    if($data['updated_at']){
                        return date("Y-m-d H:i:s",$data['updated_at']);
                    }
                }

            ],*/
            'created_at:datetime',
            'updated_at:datetime',
            // 'flags',
            'role',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],

        ],
    ]); ?>
    <?= Html::a('Export in CVS', ['#'], ['class' => 'btn btn-success']) ?>
</div>
