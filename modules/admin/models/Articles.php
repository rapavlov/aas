<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property string $id
 * @property string $alt
 * @property string $img_url
 * @property integer $category_id
 * @property string $category_name_url
 * @property string $title
 * @property string $text
 * @property string $meta_desc
 * @property string $h1
 * @property string $meta_keywords
 * @property integer $page_wallpaper
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc	 
     */
	public $image;
	public $gallery;
	
    public static function tableName()
    {
        return 'articles';
    }
	
	public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'alt', 'img_url', 'category_id', 'category_name_url', 'title', 'meta_desc', 'h1', 'meta_keywords', 'page_wallpaper'], 'required'],
            [['id', 'category_id', 'page_wallpaper'], 'integer'],
            [['text'], 'string'],
            [['alt', 'img_url', 'title', 'meta_desc', 'h1', 'meta_keywords'], 'string', 'max' => 255],
            [['category_name_url'], 'string', 'max' => 100],
			//[['image'], 'file', 'extension' => 'png,jpg'],
			[['image'], 'file',  'extensions' => 'png, jpg'],
			//[['gallery'], 'file', 'extension' => 'png,jpg', 'maxFiles' => 4],
			
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alt' => 'Alt',
            'img_url' => 'Img Url',
            'image' => 'Image',
            'category_id' => 'Category ID',
            'category_name_url' => 'Category Name Url',
            'title' => 'Title',
            'text' => 'Text',
            'meta_desc' => 'Meta Desc',
            'h1' => 'H1',
            'meta_keywords' => 'Meta Keywords',
            'page_wallpaper' => 'Page Wallpaper',
        ];
    }
	public function upload()
    {
        if ($this->validate()) {
            $this->image->saveAs('upload/store/' . $this->image->baseName . '.' . $this->image->extension);
            return true;
        } else {
            return false;
        }
    }
}
