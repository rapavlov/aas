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
    ]);

         echo $form->field($model, 'title')->textInput(['autofocus' => true]);
         echo $form->field($model, 'text')->textarea(['rows' => 12, 'cols' => 125]);
		 echo $form->field($model, 'user')->dropDownList([
													'1' => 'rihannafenti9@gmail.com',
													'2' => 'beyoncekrcarter@gmail.com',
													'3'=>'sergeyvorobey041269@gmail.com',
													'4'=>'rblackwood966@gmail.com'
													],
                                                    [
                                                        'prompt' => 'Выбор автора блога',
                                                        'id' => 'test',
                                                        'options' => [
                                                            '4' => ['Selected' => true]
                                                        ]
                                                    ]
                                                );
		?>
       
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-8">
                <?= Html::submitButton('Синонимизировать и опубликовать', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end();
     $form = ActiveForm::begin([
        'id' => 'auto-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-10\">{input}</div>\n<div class=\"col-lg-10\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]);
    echo $form->field($autoform, 'user')->dropDownList([
        '1' => 'rihannafenti9@gmail.com',
        '2' => 'beyoncekrcarter@gmail.com',
        '3'=>'sergeyvorobey041269@gmail.com',
        '4'=>'rblackwood966@gmail.com'
    ],
        [
            'prompt' => 'Выбор автора блога',

            'options' => [
                '4' => ['Selected' => true]
            ]
        ]
    );
    echo $form->field($autoform, 'textbyurl')->checkbox([
        'label' => 'Получить текст автоматически по URL',
        'labelOptions' => [
            'style' => 'padding-left:20px;'
        ],
        'disabled' => false
    ]);
    echo $form->field($autoform, 'beginparsurl')->dropDownList([
        'sinref.ru/000_uchebniki/05300_transport/021_neftebazi_i_azs_korshak_2006/'
        => 'sinref.ru/000_uchebniki/05300_transport/021_neftebazi_i_azs_korshak_2006/',
    ],
        [
            'prompt' => 'Базовая часть url для парсинга',

            'options' => [
                '1' => ['Selected' => true]
            ]
        ]
    );
    echo $form->field($autoform, 'begindiapazon')->textInput();
    echo $form->field($autoform, 'format')->dropDownList([
        "1" => "%'.03d\n",
    ],
        [
            'prompt' => 'Формат диапазона',
            'options' => [
                '1' => ['Selected' => true]
            ]
        ]
    );
    echo $form->field($autoform, 'enddiapazon')->textInput();
    echo $form->field($autoform, 'suffiksurl')->dropDownList([
        '.htm' => '.htm',
        '.html' => '.html',
        '.php' => '.php',
        '/' => '/',
    ],
        [
            'prompt' => 'Суффикс url для парсинга',

            'options' => [
                '1' => ['Selected' => true]
            ]
        ]
    );
    echo $form->field($autoform, 'dropurl')->dropDownList([
        'livenka.ru/index.php/biznes/produktsiya/toplivorazdatochnye-kolonki' => 'livenka.ru/index.php/biznes/produktsiya/toplivorazdatochnye-kolonki',
        'www.azs-info.ru/toplivorazdatochnye-kolonki_2.html' => 'www.azs-info.ru/toplivorazdatochnye-kolonki_2.html',
        'www.vengo-trade.ru/catalog/oborudovanie-dlya-azs/toplivorazdatochnye-kolonki/'=>'www.vengo-trade.ru/catalog/oborudovanie-dlya-azs/toplivorazdatochnye-kolonki/',
        'www.a-3-c.ru/0/0/3/1/18/18A13/trk-azs-40-v421.html'=>'www.a-3-c.ru/0/0/3/1/18/18A13/trk-azs-40-v421.html'
    ],
        [
            'prompt' => 'Выбор url для создания ссылки',

            'options' => [
                '1' => ['Selected' => true]
            ]
        ]
    );
    ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-8">
            <?= Html::submitButton('Синонимизировать и опубликовать в АВТО-режиме', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>
