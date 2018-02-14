<?php

namespace app\modules\admin\models;

use Yii;

class Viewbot extends \yii\db\ActiveRecord
{
    /*public $id;
    public $ipadress;
    public $datenum;
    public $commentar;*/
    /**
     * @inheritdoc	    */
	
    public static function tableName()
    {
        return 'view_bot';
    }

    public function rules()
    {
        return [
            [['id','ipadress', 'datenum', 'commentar'],  'required'],
            [['id'], 'integer'],
            [['ipadress', 'datenum', 'commentar'], 'string'],
            ];
    }
    /**
     * @inheritdoc
     */

}
