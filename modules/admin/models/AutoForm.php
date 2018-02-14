<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class AutoForm extends Model
{
    public $text;
    public $title;
    public $user;
    public $textbyurl;
    public $dropurl;
    public $beginparsurl;
    public $suffiksurl;
    public $begindiapazon;
    public $enddiapazon;
    public $format;

   // public $remember = true;

   // private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            ///[['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            //['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            //['password', 'validatePassword'],
			/*[ ['title'], 'filter', 'filter' => 'trim'],
			[ ['text'], 'filter', 'filter' => 'trim'],  */
			[ ['user'], 'filter', 'filter' => 'trim'],

            ['textbyurl', 'boolean'],
            [ ['beginparsurl'], 'filter', 'filter' => 'trim'],
            [ ['begindiapazon'], 'filter', 'filter' => 'number'],
            [ ['enddiapazon'], 'filter', 'filter' => 'number'],
            [ ['suffiksurl'], 'filter', 'filter' => 'trim'],
            [ ['dropurl'], 'filter', 'filter' => 'trim'],
            [ ['format'], 'filter', 'filter' => 'trim'],
        ];
    }

	public function attributeLabels(){
		return [
			/*'title' => 'Заголовок',
			'text' => 'Текст',*/
			'user' => 'Пользователь',
			'beginparsurl' => 'Базовая часть url для парсинга',
			'begindiapazon' => 'Начало диапазона парсинга',
			'enddiapazon' => 'Конец диапазона парсинга',
			'suffiksurl' => 'Суффикс url для парсинга',
			'dropurl' => 'Выбор url для создания ссылки',
			'format' => 'Формат диапазона',
			/*'password' => 'Пароль',
			'rememberMe' => 'Запомнить меня',*/
		];
	}
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
   /* public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверный логин иди пароль');
            }
        }
    }*/

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     *//*
    public function login()
    {
        if ($this->validate()) {
			if ($this->rememberMe) 
			{
				$u = $this->getUser();
				$u->generateAuthKey();
				$u->save();
			}
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }
	
	public function loginAdmin()
	{
		if ($this->validate() && User::isUserAdmin($this->username)) {
			if ($this->rememberMe) 
			{
				$u = $this->getUser();
				$u->generateAuthKey();
				$u->save();
			}
			return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
		} else {
			return false;
		}
	}*/

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
	 /*
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }*/
}
