<?php
namespace app\components\bloggerapi;

use Yii;
use yii\base\Model;
//require_once '@app\vendor\google\apiclient\src\Google\Client.php';
//use app\vendor\google\apiclient\src\Google;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Bloggerapi extends Model   ///http://spartanets.ru/post/197.html api settings and  add
{									// https://hotexamples.com/examples/-/Google_Service_Blogger_Post/setContent/php-google_service_blogger_post-setcontent-method-examples.html
    public $username;
    public $password;
    public $rememberMe = true;
    public $user_array = [
		'1' => 
			[
				'user_email' => 'rihannafenti9@gmail.com',
				'ClientId' =>'681565577024-0m0fvc1q8ioumrilju84cuqu8uiptphp.apps.googleusercontent.com', 				
				'ClientSecret' =>'FFzl61pTuSVZJK2KETlRuQWJ',				
				'AccessToken' =>'ya29.GlwPBU2uqp5o3P7Hm4f7RNB-mtuoss39Hm3AuV2lKexR-aGXCjRbgo4sdfYTyls-KhSsHTs9KS3O4G7wD_A87zhXSOrnQlmQxEuhycrH7hiJzb690NH0pWUl_6ykpQ',
				//ya29.GlwPBU2uqp5o3P7Hm4f7RNB-mtuoss39Hm3AuV2lKexR-aGXCjRbgo4sdfYTyls-KhSsHTs9KS3O4G7wD_A87zhXSOrnQlmQxEuhycrH7hiJzb690NH0pWUl_6ykpQ
				'user_password' =>'231004ar',
				'BlogID' =>'7306600015304466383',		
				'scopes' =>'https://www.googleapis.com/auth/blogger',	
				'BlogUrl' =>'https://beyoncekcarter.blogspot.ru/',
			],//blogID=8086328714252272603
		'2' => 
			[
				'user_email' => 'beyoncekrcarter@gmail.com',
				'ClientId' =>'681565577024-0m0fvc1q8ioumrilju84cuqu8uiptphp.apps.googleusercontent.com', 				
				'ClientSecret' =>'FFzl61pTuSVZJK2KETlRuQWJ',				
				'AccessToken' =>'ya29.GlwPBU2uqp5o3P7Hm4f7RNB-mtuoss39Hm3AuV2lKexR-aGXCjRbgo4sdfYTyls-KhSsHTs9KS3O4G7wD_A87zhXSOrnQlmQxEuhycrH7hiJzb690NH0pWUl_6ykpQ',
				//ya29.GlwPBU2uqp5o3P7Hm4f7RNB-mtuoss39Hm3AuV2lKexR-aGXCjRbgo4sdfYTyls-KhSsHTs9KS3O4G7wD_A87zhXSOrnQlmQxEuhycrH7hiJzb690NH0pWUl_6ykpQ
				'user_password' =>'231004ar',
				'BlogID' =>'8086328714252272603',		
				'scopes' =>'https://www.googleapis.com/auth/blogger',
                'BlogUrl' =>'https://beyoncekcarter.blogspot.ru/',
            ],
		'3' => 
			[
				'user_email' => 'sergeyvorobey041269@gmail.com',
				'ClientId' =>'681565577024-0m0fvc1q8ioumrilju84cuqu8uiptphp.apps.googleusercontent.com', 				
				'ClientSecret' =>'FFzl61pTuSVZJK2KETlRuQWJ',				
				'AccessToken' =>'ya29.GlwPBU2uqp5o3P7Hm4f7RNB-mtuoss39Hm3AuV2lKexR-aGXCjRbgo4sdfYTyls-KhSsHTs9KS3O4G7wD_A87zhXSOrnQlmQxEuhycrH7hiJzb690NH0pWUl_6ykpQ',
				//ya29.GlwPBU2uqp5o3P7Hm4f7RNB-mtuoss39Hm3AuV2lKexR-aGXCjRbgo4sdfYTyls-KhSsHTs9KS3O4G7wD_A87zhXSOrnQlmQxEuhycrH7hiJzb690NH0pWUl_6ykpQ
				'user_password' =>'231004ar',
				'BlogID' =>'2538160879893028716',		
				'scopes' =>'https://www.googleapis.com/auth/blogger',
                'BlogUrl' =>'https://beyoncekcarter.blogspot.ru/',
            ],
        '4' =>
            [
                'user_email' => 'rblackwood966@gmail.com',// При добавлении нового пользователя изменить поле
                'user_password' =>'231004ar',// При добавлении нового пользователя изменить поле
                'BlogID' =>'3820422997338294477',// При добавлении нового пользователя изменить поле
                'BlogUrl' =>'https://webblackside.blogspot.ru/',// При добавлении нового пользователя изменить поле

                'ClientId' =>'681565577024-0m0fvc1q8ioumrilju84cuqu8uiptphp.apps.googleusercontent.com',
                'ClientSecret' =>'FFzl61pTuSVZJK2KETlRuQWJ',
                'AccessToken' =>'ya29.GlwPBU2uqp5o3P7Hm4f7RNB-mtuoss39Hm3AuV2lKexR-aGXCjRbgo4sdfYTyls-KhSsHTs9KS3O4G7wD_A87zhXSOrnQlmQxEuhycrH7hiJzb690NH0pWUl_6ykpQ',
                //ya29.GlwPBU2uqp5o3P7Hm4f7RNB-mtuoss39Hm3AuV2lKexR-aGXCjRbgo4sdfYTyls-KhSsHTs9KS3O4G7wD_A87zhXSOrnQlmQxEuhycrH7hiJzb690NH0pWUl_6ykpQ

                'scopes' =>'https://www.googleapis.com/auth/blogger',

            ],
	];

    private $_user = false;	
	private $settings = array();	
	private static $_instance = null;
	
	public function __construct() {
		// приватный конструктор ограничивает реализацию getInstance ()
		//require_once __DIR__ .'/vendor/autoload.php';
		//require_once __DIR__ .'/createsinonimizingstring.php';
	}
	
	public function __clone() {
		// ограничивает клонирование объекта
	}
	static public function getInstance() {
		if(is_null(self::$_instance))
			{
				self::$_instance = new self();
			}
		return self::$_instance;
	}
	public function import() {
		// ...
	}
	public function get() {
		// ...
	}
	
	//define('SYSPATH', 'C:/OpenServer/domains/bloggerapi1.ru/');
	public function posting() {
		//debug($text);
		//debug($params);	
		//debug($title);		
		//die(0);				
		$result = false;
		$params = array(
			'client_id'     => $this->user_array[$_SESSION['user']]['ClientId'], //1
			'client_secret' => $this->user_array[$_SESSION['user']]['ClientSecret'],//1
			//'redirect_uri'  => "http://bloggerapi1.ru",
			'redirect_uri'  => "http://aas.ru/admin/sino",
			'grant_type'    => 'authorization_code',
			'code'          => $_GET['code']
			);		
				
		//debug($params);	
		//debug($title);	
		//debug($_SESSION);	
		//debug($_POST);
		//die(0);
					
					
				$client = new \Google_Client();
				$client->setClientId($this->user_array[$_SESSION['user']]['ClientId']);///1
				$client->setClientSecret($this->user_array[$_SESSION['user']]['ClientSecret']);///1
				$client -> setAuthConfig('client_secrets.json' );
				$client -> setAccessType('offline'); // автономный доступ 
				$client -> setIncludeGrantedScopes(true); // incremental auth 
				$client -> addScope($this->user_array[$_SESSION['user']]['scopes']);///1
				
				/*debug($params);
				debug($_SESSION);
				debug($_POST);
				die(0);*/
					
				$client->authenticate($_GET['code']);
				//$client->authenticate($_SESSION['code']);
				$access_token = $client->getAccessToken();
				$client->setAccessToken($access_token);
				
				
				$service = new \Google_Service_Blogger($client);
				$blog      = $service->blogs->getByUrl($this->user_array[$_SESSION['user']]['BlogUrl']);
				$blogId = $blog->getId();
				$post = $service->posts->listPosts($blogId);				
				foreach ($post['items'] as $post){
					$url[]= $post[url];
					//debug($post[url]);
				}
				$url = $url[array_rand($url)];
				$array_words = explode(' ',$_SESSION['text']);
				$random_index = array_rand($array_words);
				$array_words[$random_index] = "<a href='$url'>{$array_words[$random_index]}</a>";
				$_SESSION['text'] = implode(' ', $array_words);
				
				/*debug($_SESSION['text']);
				die(0);*/
				//debug($post['items']);
				/*			
				$blogName  = $blog->getName();
				$blogUrl   = $blog->getURL();
				$postsObj  = $blog->getPosts();
				$postCount = $postsObj->getTotalItems();
				$posts     = $postsObj->getItems();
				*/								
				$postData = new \Google_Service_Blogger_Post();
				$postData->setTitle($_SESSION['title']);
				$postData->setContent($_SESSION['text']);
                /*debug($_SESSION);
                debug($_POST);
                debug($params);
                debug($title);
                debug($new);
                die(0);*/
				$service = new \Google_Service_Blogger($client);
				$new = $service->posts->insert($this->user_array[$_SESSION['user']]['BlogID'], $postData);//1
				
				/*debug($_SESSION);
				debug($_POST);
				debug($params);
				debug($title);
				debug($new);
				die(0);*/
				
				if ($new) {
					$response['status'] = true;					
				}else {
					$response['status'] = false;
				}
				if ($response[status] == 1) //echo "blog '$title' is posting";
				{
				return $_SESSION['title'];
				}
	}
	
	
}