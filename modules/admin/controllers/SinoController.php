<?php


namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\helpers\Url;
use Yii;
use app\components\bloggerapi\Bloggerapi;
use app\components\bloggerapi\Autopostingtobloggerapi;
use app\components\bloggerapi\CreateSinonimizingString;
use app\modules\admin\models\SinoForm;
use app\modules\admin\models\AutoForm;
use app\modules\admin\models\Viewbot;

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
    public function beforeAction($action)
    {
        //$ip = $this->_ip();
        $ip = Yii::$app->request->userIP;
        $bot = Viewbot::find()->where(['ipadress' => $ip])->one();
        if (!empty($bot)){
            $last_date = explode('/', $bot->datenum)[0];
            $last_requests = explode('/', $bot->datenum)[1];
            //$today = new \DateTime('now', new \DateTimeZone('UTC'));
            $today = time();
            if (($today-$last_date) < 60*60*24){
                $last_requests = $last_requests+1;
                $bot->datenum = (string) (time().'/'.$last_requests);
            } else {
                $bot->datenum = (string) (time().'/1');
            }
            $bot->save();
        }else{

            $bot = new Viewbot();
            $lastid = Viewbot::find()->orderBy(['id'=> SORT_DESC])->one();
            /*debug($lastid);
            die();*/
            $bot->id = $lastid->id+1;
            $bot->ipadress = (string) $ip;
            $bot->datenum = (string) (time().'/1');
            $bot->commentar = '--';

            if (!$bot->validate()) {
                foreach ($bot->getErrors() as $key => $value) {
                    echo $key . ': ' . $value[0];
                }
            }
            $bot->save();
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function _ip()
    {
        if(isset($HTTP_SERVER_VARS)) {
            if(isset($HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"])) {
                $realip = $HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"];
            }elseif(isset($HTTP_SERVER_VARS["HTTP_CLIENT_IP"])) {
                $realip = $HTTP_SERVER_VARS["HTTP_CLIENT_IP"];
            }else{
                $realip = $HTTP_SERVER_VARS["REMOTE_ADDR"];
            }
        }else{
            if(getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
                $realip = getenv( 'HTTP_X_FORWARDED_FOR' );
            }elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
                $realip = getenv( 'HTTP_CLIENT_IP' );
            }else {
                $realip = getenv( 'REMOTE_ADDR' );
            }
        }
        return $realip;
    }

    public function actionClear()
    {
		unset($_SESSION['get_data']);
		return $this->redirect('index');
	}

    /**
     * @return string|\yii\web\Response
     */
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
			if ( mb_strlen($prepare_string) > 2900) {
                $prepare_string = \yii\helpers\StringHelper::truncate($prepare_string, 2900, '...');
            }
            /* todo-dis delete comments*/
			$_SESSION['text'] = $prepare_string;
			$yaTranslate = CreateSinonimizingString::getInstance();
			$ready_text = $yaTranslate->createSinonimazing();		
			$_SESSION['text'] = $ready_text;
		}
		$test = '';		
		$model = new SinoForm();
        if ($model->load(Yii::$app->request->post())) 
		{	
			$_SESSION['get_data'] = 'yeas';
		}

        $autoform = new AutoForm();
        if ($autoform->load(Yii::$app->request->post()))
        {
            $autoposting = Autopostingtobloggerapi::getInstance();
            if ($autoposting->pack($autoform)) $_SESSION['get_data'] = 'autoposting-yeas';
            $_SESSION['autoform'] = $autoposting->autoform;
            $_SESSION['text_array'] = $autoposting->text_array_forposting;
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
					//$_SESSION['text'] = $_SESSION['text'].' Опубликовано по материалам сайта <a href="http://iron-systems.ru" title="Айрон-Системс" >Айрон-Системс</a>.';
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
		elseif ($_SESSION['get_data'] == 'autoposting-yeas')
        {
            $autoposting = Autopostingtobloggerapi::getInstance();
            $autoposting->autoform = $_SESSION['autoform'];
            $autoposting->text_array_forposting = $_SESSION['text_array'];
            $autoposting->redirect_uri = $autoposting->create_redirect_uri();
            try
            {
                if (isset($_GET['tokenrefrash'])) {
                    $autoposting->redirect_uri = 'https://accounts.google.com/o/oauth2/token';
                }elseif(isset($_GET['code'])){
                    $_SESSION['code'] = $_GET['code'];
                    //$_SESSION['text'] = $_SESSION['text'].' Опубликовано по материалам сайта <a href="http://iron-systems.ru" title="Айрон-Системс" >Айрон-Системс</a>.';
                    $result_posting = $autoposting->posting();
                    $_SESSION['result'] = 'Материал '.$_SESSION['title']. ' опубликован';
                    unset($_SESSION['autoform']);
                    unset($_SESSION['text_array']);
                    unset($_SESSION['title']);
                    unset($_SESSION['get_data']);
                    unset($_SESSION['code']);
                    unset($_SESSION['user']);
                    unset($_POST['AutoForm']);
                    return $this->redirect('sino/index');
                    exit(0);
                }else{
                    Yii::$app->getResponse()->redirect($autoposting->redirect_uri);
                }
            }
            catch (\Exception $ex)
            {
                echo $ex->getMessage();
            }
        }
		else
		{
			$result_posting = $_SESSION['result'];
			unset($_SESSION['result']);
			return $this->render('index', 
			[	
				'result_posting' => $result_posting,
				'model' => $model,
				'autoform' => $autoform,
				//'name' => $name,
				//'surname' => $surname
			]);
		}		
    }


}
