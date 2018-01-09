<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Articles', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'alt',
            'img_url:url',
            'category_id',
            'category_name_url:url',
            // 'title',
            // 'text:ntext',
            // 'meta_desc',
            // 'h1',
            // 'meta_keywords',
            // 'page_wallpaper',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
