<?php
require 'model/addressbookModel.php';
require 'model/addressbook.php';
require 'model/allcities.php';
require_once 'config.php';

session_status() === PHP_SESSION_ACTIVE ? true : session_start();

class addressbookController
{


    function __construct()
    {
        $this->objconfig = new config();
        $this->objsm = new addressbookModel($this->objconfig);
    }


    // mvc handler request
    public function mvcHandler()
    {
        $act = isset($_GET['act']) ? $_GET['act'] : null;
        switch ($act) {
            case 'add':
                $this->insert();
                break;
            case 'addNewItem':
                $this->addingAnotherItem();
                break;
            case 'exportToJson':
                $this->exportDataToJson();
                break;
            case 'exportToXML':
                $this->exportDataToXml();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete':
                $this->delete();
                break;
            case 'inserted':
                $this->selectcities();
                break;
            default:
             $this->list();
            
        }
    }


    // page redirection
    public function pageRedirect($url)
    {
        header('Location:' . $url);
    }


    // check validation
    public function checkValidation($details)
    {
        $noerror = true;
        // Validate firstname
        if (empty($details->firstname)) {
            $details->firstname_msg = 'Field is empty.';
            $noerror = false;
        } elseif (
            !filter_var($details->firstname, FILTER_VALIDATE_REGEXP, [
                'options' => ['regexp' => '/^[a-zA-Z\s]+$/'],
            ])
        ) {
            $details->firstname_msg = 'Invalid entry.';
            $noerror = false;
        } else {
            $details->firstname_msg = '';
        }


        // Validate name
        if (empty($details->name)) {
            $details->name_msg = 'Field is empty.';
            $noerror = false;
        } elseif (
            !filter_var($details->name, FILTER_VALIDATE_REGEXP, [
                'options' => ['regexp' => '/^[a-zA-Z\s]+$/'],
            ])
        ) {
            $details->name_msg = 'Invalid entry.';
            $noerror = false;
        } else {
            $details->name_msg = '';
        }
        



    // Validate street
        if (empty($details->street)) {
            $details->street_msg = 'Field is empty.';
            $noerror = false;
        } elseif (
            !filter_var($details->street, FILTER_VALIDATE_REGEXP, [
                'options' => ['regexp' => '/^[a-zA-Z\s]+$/'],
            ])
        ) {
            $details->street_msg = 'Invalid entry.';
            $noerror = false;
        } else {
            $details->street_msg = '';
        } 



    // Validate zip_code
        if (empty($details->zip_code)) {
            $details->zip_code_msg = 'Field is empty.';
            $noerror = false;
        }
        else {
            $details->zip_code_msg = '';
        }


        // Validate street
        if (empty($details->city)) {
            $details->city_msg = 'Field is empty.';
            $noerror = false;
        } elseif (
            !filter_var($details->city, FILTER_VALIDATE_REGEXP, [
                'options' => ['regexp' => '/^[a-zA-Z\s]+$/'],
            ])
        ) {
            $details->city_msg = 'Invalid entry.';
            $noerror = false;
        } else {
            $details->city_msg = '';
        } 


        return $noerror;
    }

 //Function that loads form for adding new item
    public function addingAnotherItem()  
    {
        $sporttbYK = new allCities();
        
        $res = $this->objsm->getCities();
       
            $myarray =array();
            while($data= mysqli_fetch_array($res)){
               
                array_push($myarray,$data["city_name"]);
            }
            $sporttbYK->citis = $myarray;
            $_SESSION['serialization'] = serialize($sporttbYK->citis);
             $this->pageRedirect('view/dataRetrieve.php');
    }

    //Function that exports data to  xml format
    public function exportDataToXml()  
    {
        $exported = '0';
        $res = $this->objsm->getXML();
        if($res){
            $exported = '3';
        }else{
            $exported = '4';
        }
        $result = $this->objsm->selectRecord(0);
        include 'view/list.php';
            
    }

    //Function that exports data to json format
    public function exportDataToJson()  
    {
        $exported = '0';
        $res = $this->objsm->getJSON();
        if($res){
            $exported = '1';
        }else{
            $exported = '2';
        }
        $result = $this->objsm->selectRecord(0);
        include 'view/list.php';  
            
    }
 
    // add new record
    public function insert()
    {
        try {
            $details = new addressbook();
            if (isset($_POST['addbtn'])) {
                // read form value
                $details->name = trim($_POST['name']);
                $details->firstname= trim($_POST['firstname']);
                $details->email= trim($_POST['email']);
                $details->street = trim($_POST['street']);
                $details->zip_code = trim($_POST['zip_code']);
                $details->city = trim($_POST['city']);
  

                //call validation
                $chk = $this->checkValidation($details);
               
                if ($chk) {
 
                    //call insert record function in addressbook model
                    $pid = $this->objsm->insertRecord($details);
                   
                    if ($pid > 0) {
                        $this->list();
                    } else {
                        echo 'Somthing is wrong..., try again.';
                    }
                } else {
                echo 'Check errors and correct....';
                $sporttbYK = new allCities();
                $sporttb = new addressbook();
                $res = $this->objsm->getCities();
                $myarray =array();
                while($data= mysqli_fetch_array($res)){
                    array_push($myarray,$data["city_name"]);
                }
                    $_SESSION['spotbCities'] = serialize($sporttbYK->citis);
                    $this->addingAnotherItem();
                    
                }
            }
        } catch (Exception $e) {
            $this->close_db();
            throw $e;
        }
    }  


    // update record
    public function update()
    {
        try {
            if (isset($_POST['updatebtn'])) {
                $details = unserialize($_SESSION['serialization']);
                $details->id = trim($_POST['id']);
                $details->name = trim($_POST['name']);
                $details->firstname = trim($_POST['firstname']);
                $details->email = trim($_POST['email']);
                $details->street = trim($_POST['street']);
                $details->zip_code = trim($_POST['zip_code']);
                $details->city = trim($_POST['city']);


                // check validation
                $chk = $this->checkValidation($details);
                if ($chk) {
                    $res = $this->objsm->updateRecord($details);
                    if ($res) {
                        $this->list();
                    } else {
                        echo 'Somthing is wrong..., try again.';
                    }
                } else {
                    $_SESSION['serialization'] = serialize($details);
                    $this->pageRedirect('view/update.php');
                }
            } elseif (isset($_GET['id']) && !empty(trim($_GET['id']))) {
                $id = $_GET['id'];
                $result = $this->objsm->selectRecord($id);
                $row = mysqli_fetch_array($result);
                $sporttbYK = new allCities();
                $sporttb = new addressbook();
                $res = $this->objsm->getCities();
                $myarray =array();
                while($data= mysqli_fetch_array($res)){
                    array_push($myarray,$data["city_name"]);
                }
                $sporttbYK->citis = $myarray;
            
                $details->id = $row['id'];
                $details->name = $row['name'];
                $details->firstname = $row['firstname'];
                $details->email = $row['email'];
                $details->street = $row['street'];
                $details->zip_code = $row['zip_code'];
                $details->city = $row['city'];
                $_SESSION['serialization'] = serialize($details);
                $_SESSION['spotbCities'] = serialize($sporttbYK->citis);
                $this->pageRedirect('view/update.php');
            } else {
                echo 'Invalid operation.';
            }
        } catch (Exception $e) {
            $this->close_db();
            throw $e;
        }
    }




    // delete record
    public function delete()
    {
        try {
             $deleted = '0';
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $res = $this->objsm->deleteRecord($id);
                if ($res) {
                     $deleted = '6';
                    $this->pageRedirect('index.php');
                    $result = $this->objsm->selectRecord(0);
                    include 'view/list.php';
                } else {
                    $deleted = '7';
                    $result = $this->objsm->selectRecord(0);
                    include 'view/list.php';
                    // echo 'Somthing is wrong..., try again.';
                }
            } else {
                $deleted = '7';
                $result = $this->objsm->selectRecord(0);
                include 'view/list.php';
                echo 'Invalid operation.';
            }
        } catch (Exception $e) {
            $this->close_db();
            throw $e;
        }
    }


    public function list()
    {  
        $exported = '0';
        $deleted = '0';
        $result = $this->objsm->selectRecord(0);
        include 'view/list.php';  
    }
 
  
}

?>
