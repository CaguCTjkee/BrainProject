<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/19/17
 * Time: 16:30
 */

namespace Modules\Users\Model;

class User
{
    static $is_login = false;
    protected $user_id;
    protected $login;
    protected $pass;
    protected $mail;
    protected $date_register;
    protected $date_last;
    protected $salt;
    protected $activate;
    protected $is_admin;
    // $_instance
    protected static $_instance;

    public function __construct($user)
    {
        $this->setUser($user);
        self::$is_login = true;
    }

    static function getInstance($user = null)
    {
        if( self::$_instance === null )
            self::$_instance = new self($user);

        return self::$_instance;
    }

    private function setUser($user)
    {
        $this->user_id = $user->user_id;
        $this->login = $user->login;
        $this->pass = $user->pass;
        $this->mail = $user->mail;
        $this->date_register = $user->date_register;
        $this->date_last = $user->date_last;
        $this->salt = $user->salt;
        $this->activate = $user->activate;
        $this->is_admin = $user->is_admin;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getActivate()
    {
        return $this->activate;
    }

    /**
     * @return mixed
     */
    public function getDateLast()
    {
        return $this->date_last;
    }

    /**
     * @return mixed
     */
    public function getDateRegister()
    {
        return $this->date_register;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @return mixed
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @return mixed
     */
    public function getisAdmin()
    {
        return $this->is_admin;
    }
}