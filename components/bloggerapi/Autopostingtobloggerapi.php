<?php
namespace app\components\bloggerapi;

use Yii;
use yii\base\Model;
use app\modules\admin\models\AutoForm;
use app\components\bloggerapi\CreateSinonimizingString;
//require_once '@app\vendor\google\apiclient\src\Google\Client.php';
//use app\vendor\google\apiclient\src\Google;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Autopostingtobloggerapi extends Model   ///http://spartanets.ru/post/197.html api settings and  add
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
    public $autoform;
    private $page_link_array;
    private $format_array =[
       "1" => "%'.03d",
    ];
    public $text_array_forposting;
    public $redirect_uri;
    //public $tag_for_delete='a,br,head,script,noscript,meta,style,!-,body,div,font,span,table,tr,td,object,b,pre';
    public $tag_for_delete='a,br,head,script,noscript,meta,style,!-,object,img,font,body,span,pre,tr,td';

    public function create_redirect_uri()
    {
        $redirect_uri = http_build_query(["redirect_uri" => "http://aas.ru/admin/sino"]);
        $url = 'https://accounts.google.com/o/oauth2/v2/auth' .
            '?scope=https://www.googleapis.com/auth/blogger' .
            '&access_type=offline' .
            '&include_granted_scopes=true&' .
            $redirect_uri .
            '&response_type=code' .
            '&client_id=' . $this->user_array[$this->autoform->user]['ClientId'];
        return $url;
    }

    public function pack(AutoForm $autoform){
        $this->autoform = $autoform;
        $this->page_link_array = $this->create_page_link_array();
        $this->text_array_forposting =[];
        $this->text_array_forposting = $this->create_text_array_forposting();
        return true;
    }

    private function create_text_array_forposting(){
        $array_forposting_infn = [];
        if ($this->page_link_array !== null){
            foreach ($this->page_link_array as $page_link_infn){
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$page_link_infn); // set url to post to
                curl_setopt($ch, CURLOPT_FAILONERROR, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
                curl_setopt($ch, CURLOPT_TIMEOUT, 3); // times out after 4s
                 $text_infn = curl_exec($ch); // run the whole process
                curl_close($ch);
                $text_infn = mb_convert_encoding($text_infn, "utf-8", "windows-1251");
                $title = $this->get_title_from_html($text_infn);
                $text_infn = $this->delete_tags($text_infn, $this->tag_for_delete);

                $text_infn = $this->explode_text_by_tag_p($text_infn);
                $array_forposting_infn[] = [$text_infn,$title];
                /*debug($array_forposting_infn);
                die();*/
            }
        }
        return $array_forposting_infn;
    }

    private function get_title_from_html($text_infn){
        $title = substr($text_infn, strpos($text_infn, '<title>' )+7,
            strpos($text_infn, '</title>' )-strpos($text_infn, '<title>' )+7);
        return $title;
    }

    private function delete_tags($text_infn, $tag) {
        $tags = explode(',', $tag);
        do {
            $tag = array_shift($tags);
            $text_infn=preg_replace("/&nbsp;/",' ', $text_infn);
            $text_infn=preg_replace("~<($tag)[^>]*>|(?:</(?1)>)|<$tag\s?/?>~x",'', $text_infn);
        } while (!empty($tags));
        return $text_infn;
    }

    private function add_link_to_end_text($text_infn) {
       // $text_infn = $text_infn." Данный материал получен с сайта <a href='".$this->autoform->dropurl."' title='компания'>компании</a>";
        $text_infn = $text_infn.' Опубликовано по материалам сайта <a href=' . '"'. $this->autoform->dropurl . '"' . '>компании</a>';
        return $text_infn;
    }

    private function explode_text_by_tag_p($text_infn){
        $result_text = '';
        $array_tag_p_infn = explode('</p>', $text_infn);
        $array_tag_p_infn[0] ='';
        $array_tag_p_infn[count($array_tag_p_infn)] ='';

        foreach ($array_tag_p_infn as $text_after_tag_p){
            $text_after_tag_p = substr($text_after_tag_p, strpos($text_after_tag_p, '<p' )+2,
                mb_strlen ($text_after_tag_p)-strpos($text_after_tag_p, '<p' )+2);
            $text_after_tag_p = substr($text_after_tag_p, strpos($text_after_tag_p, '>' )+1,
                mb_strlen ($text_after_tag_p)-strpos($text_after_tag_p, '>' )+1);
            if (strlen($text_after_tag_p) < 30) $text_after_tag_p ='';
            $result_text = $result_text . ' ' . $text_after_tag_p . ' ';
        }
        return $result_text;
    }

    private function create_page_link_array(){
        $page_array_infn = [];
        if (is_numeric($this->autoform->begindiapazon)) {
            $begindiapazon_infn = $this->autoform->begindiapazon;
        }else {
            $begindiapazon_infn = 1;
        }
        if (is_numeric($this->autoform->enddiapazon)) {
            $enddiapazon_infn = $this->autoform->enddiapazon;
        }else {
            $enddiapazon_infn = $begindiapazon_infn + 20;
        }
        for ($i = $begindiapazon_infn; $i <= $enddiapazon_infn; $i++) {
            //$format = "%'.03d\n";
            $format = $this->format_array[$this->autoform->format];
            $diapazon = sprintf($format, $i);
            $page_array_infn[] = $this->autoform->beginparsurl.$diapazon.$this->autoform->suffiksurl;
        }
        return $page_array_infn;
    }
	
	//define('SYSPATH', 'C:/OpenServer/domains/bloggerapi1.ru/');
	public function posting() {
		$result = false;
        $title = 'Пост про топливораздаточные колонки';
		$params = array(
			'client_id'     => $this->user_array[$this->autoform->user]['ClientId'], //1
			'client_secret' => $this->user_array[$this->autoform->user]['ClientSecret'],//1
			//'redirect_uri'  => "http://bloggerapi1.ru",
			'redirect_uri'  => "http://aas.ru/admin/sino",
			'grant_type'    => 'authorization_code',
			'code'          => $_GET['code']
			);
		/*debug($params);
		debug($title);
		debug($_SESSION);
		debug($this);
		die(0);*/
        $client = new \Google_Client();
        $client->setClientId($this->user_array[$this->autoform->user]['ClientId']);///1
        $client->setClientSecret($this->user_array[$this->autoform->user]['ClientSecret']);///1
        $client -> setAuthConfig('client_secrets.json' );
        $client -> setAccessType('offline'); // автономный доступ
        $client -> setIncludeGrantedScopes(true); // incremental auth
        $client -> addScope($this->user_array[$this->autoform->user]['scopes']);///1

        /*debug($params);
        debug($_SESSION);
        debug($_POST);
        die(0);*/
					
        $client->authenticate($_GET['code']);
        //$client->authenticate($_SESSION['code']);
        $access_token = $client->getAccessToken();
        $client->setAccessToken($access_token);
				
        $service = new \Google_Service_Blogger($client);
        $blog      = $service->blogs->getByUrl($this->user_array[$this->autoform->user]['BlogUrl']);
        $blogId = $blog->getId();
        $post = $service->posts->listPosts($blogId);
        foreach ($post['items'] as $post){
            $url[]= $post[url];
            //debug($post[url]);
        }
        /*$url = $url[array_rand($url)];// вставка ссылок
        $array_words = explode(' ',$_SESSION['text']);
        $random_index = array_rand($array_words);
        $array_words[$random_index] = "<a href='$url'>{$array_words[$random_index]}</a>";
        $_SESSION['text'] = implode(' ', $array_words);*/
				

        //debug($post['items']);
        /*
        $blogName  = $blog->getName();
        $blogUrl   = $blog->getURL();
        $postsObj  = $blog->getPosts();
        $postCount = $postsObj->getTotalItems();
        $posts     = $postsObj->getItems();
        */
        //$service = new \Google_Service_Blogger($client);
        /*debug($this->text_array_forposting);
        die(0);*/
        foreach ($this->text_array_forposting as $text_p){
            $text = $text_p[0];
            $title = $text_p[1];

            $text = preg_replace("/\s{2,}/", "", $text);
            $text = preg_replace("/\s{2,}/", "", $text);
            $text = \yii\helpers\StringHelper::truncateWords($text, 350, '...');
            if ( mb_strlen($text) > 2900) {
                $text = \yii\helpers\StringHelper::truncate($text, 2900, '...');
            }
            $yaTranslate = CreateSinonimizingString::getInstance();
            $text = $yaTranslate->createSinonimazingForAutoposting($text);
            $text = $this->add_link_to_end_text($text);
            $postData = new \Google_Service_Blogger_Post();
            //$postData->setTitle($_SESSION['title']);
            $postData->setTitle(strip_tags($title));
            $postData->setContent($text);

            /*debug($_SESSION);
            debug($_POST);
            debug($params);
            debug($title);
            debug($new);
            die(0);*/
            $new = $service->posts->insert($this->user_array[$this->autoform->user]['BlogID'], $postData);//1
            sleep(240);
        }
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
}