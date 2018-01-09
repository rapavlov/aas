<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-index">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <p>
        <?php //echo Html::a('Create Articles', ['create'], ['class' => 'btn btn-success']) ?>
        <?php //echo '<br>'.$test ?>
        <?php //echo '<br>'.$model->title;?>
        <?php //echo '<br>'.$model->text;?>
    </p>
    <?php /* echo GridView::widget([
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
    ]); */?>
</div>
<div class="site-login">
    <h1><?= Html::encode('Автопостинг в блоггер') ?></h1>

    <p>
		<?php if (!empty($result_posting)){
				echo $result_posting;
			}else {
				echo 'Введите исходный текст:';
			}
		?>
	</p>
	
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-10\">{input}</div>\n<div class=\"col-lg-10\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?php echo $form->field($model, 'title')->textInput(['autofocus' => true]) ?>
        <?php echo $form->field($model, 'text')->textarea(['rows' => 12, 'cols' => 125]);?>
		<?php echo $form->field($model, 'user')->dropDownList([
													'1' => 'rihannafenti9@gmail.com',
													'2' => 'beyoncekrcarter@gmail.com',
													'3'=>'sergeyvorobey041269@gmail.com'
													]);
		?>
       
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-8">
                <?= Html::submitButton('Синонимизировать и опубликовать', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    
</div>
