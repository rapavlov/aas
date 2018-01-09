<?php

namespace app\components\menu_widget_models;

use Yii;

/**
 * This is the model class for table "articles_category".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $h1
 * @property string $meta_title
 * @property string $meta_desc
 * @property string $meta_key
 */
class ArticlesCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articles_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url', 'h1', 'meta_title', 'meta_desc', 'meta_key'], 'required'],
            [['name', 'url', 'h1', 'meta_title', 'meta_desc', 'meta_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'h1' => 'H1',
            'meta_title' => 'Meta Title',
            'meta_desc' => 'Meta Desc',
            'meta_key' => 'Meta Key',
        ];
    }
}
