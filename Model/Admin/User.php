<?php

class Model_Admin_User{

    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $is_active;
    public $skills;
    public $role_id;
    public $year;
    public $photo;

    public static function getAll(){
        $dbuser = new Model_Db_Table_Admin_User();
        $userData = !empty($dbuser->getAll())? $dbuser->getAll() : '';
        if(!empty($userData)) {

            return $userData;
        }
        else {
            throw new Exception('Users not found', /*System_Exception::NOT_FOUND*/23);
        }
    }

}