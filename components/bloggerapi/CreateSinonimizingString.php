<?php
namespace app\components\bloggerapi;

class CreateSinonimizingString
{    
    public $baseUrlToTranslate = 'https://translate.yandex.net/api/v1.5/tr.json/translate?';
    public $apiKeyToTranslate = ['trnsl.1.1.20171122T142623Z.9558c36974a38cb3.37670022b7d7f571376d9fbbb376016a9aa45174',
								'trnsl.1.1.20171228T080658Z.ad99886008047246.d2f021e9af52f0af5d8203c5f4e569c92fad4d81', //7802		
								'trnsl.1.1.20171228T080905Z.807a6e9e00412159.318a15979a96e8a929e1cdf79a222c183180df10', //78031		
								'trnsl.1.1.20171228T081020Z.b91e657150566432.94af508f13f6992e5bf0310a010dda0ea711f4ec', //78041		
								'trnsl.1.1.20171228T081129Z.f310915620b08411.38f6573929c132303b09aa03b015beee4b39fcd0' //78051		
								];// Получить тут: https://tech.yandex.ru/keys/get/?service=trnsl
	public $langString = [];	
    private static $_instance = null;
    public $array_lang = [
        'ar',
        'hy',
        'az',
        'be',
        'cs',
        'da',
        'nl',
        'en',
        'fi',
        'fr',
        'ka',
        'de',
        'el',
        'is',
        'ga',
        'kk',
        'es',
        'sv'        
    ];

    private $settings = array();
		
	public function __construct() {
		
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

    public function createSinonimazingForAutoposting($innerText){

        $innerLang = 'ru';
        $innerLang = $this->prepareLangString($innerLang);
        $key = $this->apiKeyToTranslate[array_rand($this->apiKeyToTranslate)];
        foreach ($this->langString as $lang){
            $text = urlencode($innerText);
            $url = $this->baseUrlToTranslate.'key='.$key.'&text='.$text.'&lang='.$lang.'&format=plain'.'&options=1';
            $result = file_get_contents($url); // получаем данные в JSON: {"code":200,"lang":"ru-en","text":["Sneakers basketball"]}
            $result = json_decode($result, true); // Преобразуем в массив
            //print_r($result);
            $innerText = $result['text'][0]; // Sneakers basketball
        }
        return $innerText;
    }

	public function createSinonimazing(){
		$innerText = $_SESSION['text'];
		$innerLang = 'ru';
        /*if(is_null(self::$_instance))
        {
			self::$_instance = new self();
		}*/
		$innerLang = $this->prepareLangString($innerLang);
		$key = $this->apiKeyToTranslate[array_rand($this->apiKeyToTranslate)];
		foreach ($this->langString as $lang){
			$text = urlencode($innerText);
			$url = $this->baseUrlToTranslate.'key='.$key.'&text='.$text.'&lang='.$lang.'&format=plain'.'&options=1';
			$result = file_get_contents($url); // получаем данные в JSON: {"code":200,"lang":"ru-en","text":["Sneakers basketball"]}
			$result = json_decode($result, true); // Преобразуем в массив
			//print_r($result);
			$innerText = $result['text'][0]; // Sneakers basketball
		}
		return $innerText;
	}
	public  function prepareLangString($innerLang){
		$firstLangString = $innerLang;
		for ($i=1; $i<=3; $i++){
			$this->delete_from_array($innerLang, $this->array_lang);
			$newLangString = $this->array_lang[array_rand($this->array_lang)];
			if ($i !== 3){
				$this->langString[] = $innerLang.'-'.$newLangString;
			}
			else {
				$this->langString[] = $innerLang.'-'.$firstLangString;
			}
			$innerLang = $newLangString;
		}
		return $this->langString;
		//print_r(self::$langString);
	}	
    /*$text = urlencode('Кроссовки замечательные, баскетбольные, хорошие, новые, прикольные');
	$url = 'https://translate.yandex.net/api/v1.5/tr.json/translate?' .
        'key=trnsl.1.1.20171122T142623Z.9558c36974a38cb3.37670022b7d7f571376d9fbbb376016a9aa45174' .
        '&text=' .$text.
        '&lang=ru-en' .
        '&format=plain' .
        '&options=1';*/
	
	public static function delete_from_array($needle, &$array, $all = true){
        if(!$all){
            if(FALSE !== $key = array_search($needle,$array)) unset($array[$key]);
            return;
        }
        foreach(array_keys($array,$needle) as $key){
            unset($array[$key]);
        }
	}
	
    public  function createDescription($data){        
        if(is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        $random = rand(1, 100);
        if($random >= 90) {
            self::$metaString = self::$array_meta_string[array_rand(self::$array_meta_string)].$data;
        }
        elseif($random >= 80) {
            self::$metaString = self::$array_meta_string[array_rand(self::$array_meta_string)].$data. ' База изображений, картинок';
        }
        elseif ($random >= 70){
            self::$metaString = $data.' | Сайт аватарок, заставок и картинок | '.self::$array_meta_string[array_rand(self::$array_meta_string)];
        }
        elseif ($random >= 60){
            self::$metaString = $data. ' | База изображений | '.self::$array_meta_string[array_rand(self::$array_meta_string)];
        }
        elseif ($random >= 50){
            self::$metaString = $data.self::$array_meta_string[array_rand(self::$array_meta_string)];
        }
        elseif ($random >= 40){
            self::$metaString = self::$array_meta_string[array_rand(self::$array_meta_string)].' | Сайт аватарок, заставок и картинок | '. $data. ' | База изображений';
        }
        elseif ($random >= 30){
            self::$metaString = self::$array_meta_string[array_rand(self::$array_meta_string)].' | Сайт аватарок, заставок и картинок | '. $data;
        }
        elseif($random >= 20) {
            self::$metaString = self::$array_meta_string[array_rand(self::$array_meta_string)].$data.' | Сайт аватарок, заставок и картинок | '.self::$array_meta_string[array_rand(self::$array_meta_string)];
        }
        elseif($random >= 10) {
            self::$metaString = self::$array_meta_string[array_rand(self::$array_meta_string)].' | Сайт аватарок, заставок и картинок | '.$data. ' | База изображений | '.self::$array_meta_string[array_rand(self::$array_meta_string)];
        }
        else {
            self::$metaString = self::$array_meta_string[array_rand(self::$array_meta_string)].$data.' | База изображений, картинок | '.self::$array_meta_string[array_rand(self::$array_meta_string)];
        }
        return self::$metaString;
    }
}
//$text = CreateSinonimizingString::createSinonimazing('Кроссовки замечательные, баскетбольные, хорошие, новые, прикольные','ru');
//echo $text;
// Официальная документация - https://tech.yandex.ru/translate/
/* или через форматирование строки:
$yt_link = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=%s&text=%s&lang=%s";
$yt_link = sprintf($yt_link, $yt_api_key, $yt_text, $yt_lang);
*/
/*
$result = file_get_contents($yt_link); // получаем данные в JSON: {"code":200,"lang":"ru-en","text":["Sneakers basketball"]}
$result = json_decode($result, true); // Преобразуем в массив
$en_test = $result['text'][0]; // Sneakers basketball 
/* или через объект:
$result = json_decode(($result));
$en_test = $result->text{0}; // Sneakers basketball
*/

?>