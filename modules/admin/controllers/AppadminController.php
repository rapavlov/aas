<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
/**
 * Default controller for the `admin` module
 */
class AppadminController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,  //разрешаем
                        //'actions' => ['login', 'signup'],
                        'roles' => ['@'],
                    ],
                    
                ],
            ],
			
        ];
    }
	
	
	
}
