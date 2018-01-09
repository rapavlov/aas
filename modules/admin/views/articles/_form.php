<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Articles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articles-form">
	<?php //echo Yii::$app->security->generatePasswordHash('mehanik'); ?>
	
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img_url')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'image')->fileInput()  ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'category_name_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(),[            
		'editorOptions' => ElFinder::ckeditorOptions('elfinder',
				[/* Some CKEditor Options */
					'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
					'inline' => false, //по умолчанию false				
				]),   
	])?>

    <?= $form->field($model, 'meta_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'page_wallpaper')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
