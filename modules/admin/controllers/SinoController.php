<?php


namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\helpers\Url;
use Yii;
use app\components\bloggerapi\Bloggerapi;
use app\components\bloggerapi\CreateSinonimizingString;
use app\modules\admin\models\SinoForm;

/**
 * Default controller for the `admin` module
 */
class SinoController extends AppadminController
{
	public $layout = '@app/modules/admin/views/layouts/mainadmin.php';
    /**
     * Renders the index view for the module
     * @return string
     */
	 public function actionClear()
    {
		unset($_SESSION['get_data']);
		return $this->redirect('index');
	}
    public function actionIndex()
    {
		 if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }			
		session_start();
		
		if (isset($_POST['SinoForm']))  {
			$_SESSION['title'] = $_POST['SinoForm']['title'];			
			$_SESSION['user'] = $_POST['SinoForm']['user'];			
			$prepare_string = $_POST['SinoForm']['text'];
			$prepare_string = preg_replace("/\s{2,}/", "", $prepare_string);
			$prepare_string = preg_replace("/\s{2,}/", "", $prepare_string);
			$prepare_string = \yii\helpers\StringHelper::truncateWords($prepare_string, 350, '...');
			//debug($prepare_string );
			//debug($_SESSION['user'] );
			//debug($_SESSION);
			//die(0);
			
			$_SESSION['text'] = $prepare_string;
			$yaTranslate = CreateSinonimizingString::getInstance();
			//debug($yaTranslate);	
			$ready_text = $yaTranslate->createSinonimazing();		
			//debug($ready_text);
			//die(0);
			//$ready_text = $ready_text.' Опубликовано по материалам сайта <a href="iron-systems.ru" title="Айрон-Системс" >Айрон-Системс</a>.';
			$_SESSION['text'] = $ready_text;
			//debug($_SESSION);	
			//debug($_POST);	
			//die(0);
		} 
		
		$test = '';		
		$model = new SinoForm();
        if ($model->load(Yii::$app->request->post())) 
		{	
			$_SESSION['get_data'] = 'yeas';
		}
				
		if ($_SESSION['get_data'] == 'yeas') 
		{		
			$blog = Bloggerapi::getInstance();
			$redirect_uri =  http_build_query(["redirect_uri" => "http://aas.ru/admin/sino"]); 
			$url = 'https://accounts.google.com/o/oauth2/v2/auth'.
				'?scope=https://www.googleapis.com/auth/blogger'.
				'&access_type=offline'.
				'&include_granted_scopes=true&'.
				$redirect_uri.
				'&response_type=code'.
				'&client_id='.$blog->user_array[$_SESSION['user']]['ClientId'];		//1	
			try 
			{
				//putenv('GOOGLE_APPLICATION_CREDENTIALS='. __DIR__ . '/blogger.dat');
				if (isset($_GET['tokenrefrash'])) {    
					$url = 'https://accounts.google.com/o/oauth2/token';				
				}elseif(isset($_GET['code'])){					
					$_SESSION['code'] = $_GET['code'];
					$_SESSION['text'] = $_SESSION['text'].' Опубликовано по материалам сайта <a href="iron-systems.ru" title="Айрон-Системс" >Айрон-Системс</a>.';
					$result_posting = $blog->posting();
					$_SESSION['result'] = 'Материал '.$_SESSION['title']. ' опубликован';
					unset($_SESSION['text']);
					unset($_SESSION['title']);
					unset($_SESSION['get_data']);
					unset($_SESSION['code']);
					unset($_SESSION['user']);
					unset($_POST['SinoForm']);
					//Yii::$app->getResponse()->redirect(\yii\helpers\Url::current([], true));
					return $this->redirect('sino/index');
					exit(0);
					//debug($result_posting);	yii\helpers\Url::current([], true)
					//debug($_SESSION);	   https://www.blogger.com/blogger.g?blogID=7306600015304466383#editor/target=post;postID=121456618835122271;onPublishedMenu=allposts;onClosedMenu=allposts;postNum=4;src=postname
					//debug($_POST);	
					//echo 'IN ELSEIF AFTER POSTING '.$result_posting;
					//die(0);
				}else{
					//header("Location: $url"); 
					Yii::$app->getResponse()->redirect($url);					
				}				
			} 
			catch (\Exception $ex)
			{
				echo $ex->getMessage();
			}	
		}
		else
		{			
			/*return $this->render('index', 
			[	
				'result' => $result_posting,				
				'model' => $model,
			]);*/
			//$name = 'John';
			//$surname = 'Doe';
			$result_posting = $_SESSION['result'];
			unset($_SESSION['result']);
			return $this->render('index', 
			[	
				'result_posting' => $result_posting,
				'model' => $model,
				//'name' => $name,
				//'surname' => $surname
			]);
		}		
    }
}
