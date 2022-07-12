<?php

class addressbook
{
    // table fields
    public $id;
    public $name;
    public $firstname;
    public $email;
    public $street;
    public $zip_code;
    public $city;

    // message string
    public $id_msg;
    public $name_msg;
    public $firstname_msg;
    public $email_msg;
    public $street_msg;
    public $zip_code_msg;
    public $city_msg;
    // constructor set default value
    function __construct()
    {
        $id=0;$name=$firstname=$email=$street=$zip_code=$city="";
        $id_msg=$name_msg=$firstname_msg=$email_msg=$street_msg=$zip_code_msg=$city_msg="";
    }
}

?>