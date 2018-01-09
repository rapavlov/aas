<?php

namespace app\components;
use yii\base\Widget;
use app\modules\admin\models\Articles;
use app\components\menu_widget_models\ArticlesCategory;
use Yii;

class ArticlesMenuWidget extends Widget {
	
	public $tpl;
	public $data;
	public $tree;
	public $menuHtml;
	public $controller_id;
	
	public function init(){
		parent::init();
		if ($this->tpl === null){
			$this->tpl = 'menu';
		}
		$this->tpl .='.php';
	}
	
	public function run(){	
		// get cache
		//$menu = Yii::$app->cache->get('menu');
		//if ($menu) return $menu;
		
		//$this->data = ArticlesCategory::find()->indexBy('id')->asArray()->all();
		$this->data = Articles::find()->indexBy('id')->asArray()->all();
		//debug($this->controller_id);
		//debug($this->data);
		$this->tree = $this->data;
		  $this->menuHtml = $this->getMenuHtml($this->tree);
		
		// set cache
		//Yii::$app->cache->set('menu',$this-menuHtml, 60*60*24*7);
		return $this->menuHtml;
	}
	
	protected function getMenuHtml($tree){
		$str = '';
		foreach ($tree as $article){
			$str .=$this->catToTemplate($article);
		}
		return $str;
	}
	
	protected function catToTemplate($article){
		ob_start();
		include __DIR__.'/articlesmenu_tpl/'.$this->tpl;
		return ob_get_clean();
	}
}