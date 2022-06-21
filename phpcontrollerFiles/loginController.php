<?php
include "maindatabase.php";
session_start();

class login extends maindatabase{

    protected function getUser($Userid, $Userpwd){
        $databaseAccess = $this->connect()->prepare('SELECT USER_ID, USERS_UIDNM, USERS_PWD FROM storeusers WHERE USERS_UIDNM = ?;');

        if(!($databaseAccess->execute(array($Userid)))){
            $databaseAccess = null;
            header("location: ../index.php?error=something%20went%20wrong%20on%20our%20side");
            exit();
        }

        if($databaseAccess->rowCount() == 0){
            $databaseAccess = null;
            header("location: ../index.php?error=user%20not%20found");
            exit();
        }
    
        $data = $databaseAccess->fetchAll();
        foreach($data as $dataToCrossCheck){
            if(password_verify($Userpwd, $dataToCrossCheck['USERS_PWD']) || $dataToCrossCheck['USERS_UIDNM'] == $Userid){
                $databaseAccess = null;
                return $dataToCrossCheck['USER_ID'];
            }
        }

        $databaseAccess = null;
        header("location: ../index.php?error=wrong%20password");
        exit(); 
    }

    protected function setUpUserCart($idNum){
        $databaseAccess = $this->connect()->prepare('SELECT product_name, product_url, product_id, product_img_url, product_price, product_rating, product_availability FROM cart WHERE CART_UserID = ?;');

        if(!$databaseAccess->execute(array($idNum))){
            $databaseAccess = null;
            header("location: ../index.php?error=something%20went%20wrong%20on%20our%20side");
            exit();
        }

        if($databaseAccess->rowCount() == 0)return;

        $cartJsonObjArr = array();
        $data = $databaseAccess->fetchAll();
        foreach($data as $dataToCrossCheck){
            $cartObject = new stdClass();

            $cartObject->name = $dataToCrossCheck['product_name'];
            $cartObject->Produrl = $dataToCrossCheck['product_url'];
            $cartObject->ID = $dataToCrossCheck['product_id'];
            $cartObject->imageURL = $dataToCrossCheck['product_img_url'];
            $cartObject->price = $dataToCrossCheck['product_price'];
            $cartObject->rating = $dataToCrossCheck['product_rating'];
            $cartObject->availability = $dataToCrossCheck['product_availability'];

            array_push($cartJsonObjArr, $cartObject);
        }
        session_start();
        $_SESSION["cartJSON"] = json_encode($cartJsonObjArr);
        $databaseAccess = null;
    }
}

class googleLogin extends maindatabase{
    private $userName;
    private $userEmail;

    public function __construct($Username, $Useremail){
        $this->userName = $Username;
        $this->userEmail = $Useremail;
        $this->getUser();
    }

    private function getUser(){
        $databaseAccess = $this->connect()->prepare('SELECT USER_ID, USERS_UIDNM, USERS_PWD FROM storeusers WHERE USERS_UIDNM = ?;');

        if(!($databaseAccess->execute(array($this->userName)))){
            $databaseAccess = null;
            header("location: ../index.php?error=something%20went%20wrong%20on%20our%20side");
            exit();
        }

        if($databaseAccess->rowCount() == 0){
            $databaseAccess = null;
            header("location: ../index.php?error=user%20not%20found");
            exit();
        }
    
        $newPWD = $this->userEmail + $this->userEmail;
        $data = $databaseAccess->fetchAll();
        foreach($data as $dataToCrossCheck){
            if(password_verify($newPWD, $dataToCrossCheck['USERS_PWD']) && $dataToCrossCheck['USERS_UIDNM'] == $this->userName){
                $databaseAccess = null;
                $_SESSION["LoggedidNum"] = $dataToCrossCheck['USER_ID'];
                $this->setUpUserCart($_SESSION["LoggedidNum"]);
                return;
            }
        }

        $databaseAccess = null;
        header("location: ../index.php?error=wrong%20password");
        exit(); 
    }

    private function setUpUserCart($idNum){
        $databaseAccess = $this->connect()->prepare('SELECT product_name, product_url, product_id, product_img_url, product_price, product_rating, product_availability FROM cart WHERE CART_UserID = ?;');

        if(!$databaseAccess->execute(array($idNum))){
            $databaseAccess = null;
            header("location: ../index.php?error=something%20went%20wrong%20on%20our%20side");
            exit();
        }

        if($databaseAccess->rowCount() == 0)return;

        $cartJsonObjArr = array();
        $data = $databaseAccess->fetchAll();
        foreach($data as $dataToCrossCheck){
            $cartObject = new stdClass();

            $cartObject->name = $dataToCrossCheck['product_name'];
            $cartObject->Produrl = $dataToCrossCheck['product_url'];
            $cartObject->ID = $dataToCrossCheck['product_id'];
            $cartObject->imageURL = $dataToCrossCheck['product_img_url'];
            $cartObject->price = $dataToCrossCheck['product_price'];
            $cartObject->rating = $dataToCrossCheck['product_rating'];
            $cartObject->availability = $dataToCrossCheck['product_availability'];

            array_push($cartJsonObjArr, $cartObject);
        }
        $_SESSION["cartJSON"] = json_encode($cartJsonObjArr);
        $databaseAccess = null;
    }
}

class loginController extends login{
    private $newUIDNM;
    private $newPWD;

    public function __construct($UseridName, $Userpwd){
        $this->newUIDNM = $UseridName;
        $this->newPWD = $Userpwd;
    }

    public function loginUser(){
        if($this->emptyInput()){
            header("location: ../index.php?error=empty%20input");
            exit();
        }
        if(!preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $this->newPWD)){
            header("location: ../index.php?error=invalid%20password");
            exit();
        }
        if(!preg_match('/^(?=.*[a-z]).{2,9}$/', $this->newUIDNM)){
            header("location: ../index.php?error=invalid%20username");
            exit();
        }
        $idNum = $this->getUser($this->newUIDNM, $this->newPWD);
        $this->setUpUserCart($idNum);
        return $idNum;
    }

    private function emptyInput(){
        if(empty($this->newUIDNM) || empty($this->newPWD))return true;
        else return false;
    }
}