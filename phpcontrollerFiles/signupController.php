<?php
include "maindatabase.php";

class signup extends maindatabase{

    //check if user already exists in database
    protected function checkifUserExists($Useridname, $Useremail){
        $databaseAccess = $this->connect()->prepare('SELECT USERS_UIDNM FROM storeusers WHERE USERS_UIDNM = ? OR USERS_EMAIL = ?;');

        if(!$databaseAccess->execute(array($Useridname, $Useremail))){
            $databaseAccess = null;
            header("location: ../index.php?error=something%20went%20wrong%20on%20our%20side");
            exit();
        }

        if($databaseAccess->rowCount() > 0) return true;
        else   return false;
    }

    protected function createNewUser($newUNM, $newPWD, $newUIDNM, $newEMAIL){
        $databaseAccess = $this->connect()->prepare('INSERT INTO storeusers (USERS_UNM, USERS_PWD, USERS_UIDNM, USERS_EMAIL) VALUES (?, ?, ?, ?);');

        $hashedPWD = password_hash($newPWD, PASSWORD_DEFAULT);
        $hashedPWD = password_hash($hashedPWD, PASSWORD_DEFAULT, array('cost' => 10));

        if(!$databaseAccess->execute(array($newUNM, $hashedPWD, $newUIDNM, $newEMAIL))){
            $databaseAccess = null;
            header("location: ../index.php?error=create%20new%20user%20failed");
            exit();
        }
        $databaseAccess = null;
    }

    protected function retrieveUserID($newUNM, $newEMAIL){
        $databaseAccess = $this->connect()->prepare('SELECT USER_ID, USERS_UIDNM, USERS_EMAIL FROM storeusers;');
        $databaseAccess->execute();
        
        if($databaseAccess->rowCount() > 0){
            $result = $databaseAccess->fetchAll();
            foreach($result as $valuesToOutput){
                if($valuesToOutput['USERS_UIDNM'] == $newUNM && $valuesToOutput['USERS_EMAIL'] == $newEMAIL){
                    $databaseAccess = null;
                    return $valuesToOutput['USER_ID'];
                }
            }
        }
        else{
            $databaseAccess = null;
            header("location: ../index.php?error=id%20Cannot%20Be%20Found");
            exit();
        }
    }
}

class googleSignUp extends maindatabase{
    private $userName;
    private $userEmail;

    public function __construct($Username, $Useremail){
        $this->userName = $Username;
        $this->userEmail = $Useremail;
    }

    public function runSignUp(){
        if($this->checkifUserExists()){
            return false;
        }
        $this->addUser();
        return true;
    }

    private function checkifUserExists(){
        $databaseAccess = $this->connect()->prepare('SELECT USERS_UIDNM FROM storeusers WHERE USERS_UIDNM = ? OR USERS_EMAIL = ?;');

        if(!$databaseAccess->execute(array($this->userName, $this->userEmail))){
            $databaseAccess = null;
            header("location: ../index.php?error=something%20went%20wrong%20on%20our%20side");
            exit();
        }

        if($databaseAccess->rowCount() > 0) return true;
        else   return false;
    }

    private function addUser(){
        $databaseAccess = $this->connect()->prepare('INSERT INTO storeusers (USERS_UNM, USERS_PWD, USERS_UIDNM, USERS_EMAIL) VALUES (?, ?, ?, ?);');
        $newPWD = $this->userEmail + $this->userEmail;
        $hashedPWD = password_hash($newPWD, PASSWORD_DEFAULT);
        $hashedPWD = password_hash($hashedPWD, PASSWORD_DEFAULT, array('cost' => 10));

        if(!$databaseAccess->execute(array($this->userName + "ggl", $hashedPWD, $this->userName, $this->userEmail))){
            $databaseAccess = null;
            header("location: ../index.php?error=create%20new%20user%20failed");
            exit();
        }
        $databaseAccess = null;
    }

    protected function retrieveUserID(){
        $databaseAccess = $this->connect()->prepare('SELECT USER_ID, USERS_UIDNM, USERS_EMAIL FROM storeusers;');
        $databaseAccess->execute();
        
        if($databaseAccess->rowCount() > 0){
            $result = $databaseAccess->fetchAll();
            foreach($result as $valuesToOutput){
                if($valuesToOutput['USERS_UIDNM'] == $this->userName && $valuesToOutput['USERS_EMAIL'] == $this->userEmail){
                    $databaseAccess = null;
                    session_start();
                    $_SESSION["LoggedidNum"] = $valuesToOutput['USER_ID'];
                    return;
                }
            }
        }
        else{
            $databaseAccess = null;
            header("location: ../index.php?error=id%20Cannot%20Be%20Found");
            exit();
        }
    }
}

class signupcontroller extends signup{
    private $newUNM;
    private $newPWD;
    private $newUIDNM;
    private $newEMAIL;

    public function __construct($Username, $UseridName, $Userpwd, $Useremail){
        $this->newUNM = $Username;
        $this->newUIDNM = $UseridName;
        $this->newPWD = $Userpwd;
        $this->newEMAIL = $Useremail;
    }

    public function signUpNewUser(){
        if($this->formFilledCheck()){
            header("location: ../index.php#signup-login-section?error=empty%20Input");
            exit();
        }
        if(!$this->checkUserNames($this->newUNM)){
            header("location: ../index.php#signup-login-section?error=invalid%20name");
            exit();
        }
        if(!$this->checkUserNames($this->newUIDNM)){
            header("location: ../index.php#signup-login-section?error=invalid%20UserIDname");
            exit();
        }
        if(!$this->invalidEmail()){
            header("location: ../index.php#signup-login-section?error=invalid%20Email");
            exit();
        }
        if($this->alreadyExists()){
            header("location: ../index.php?error=user%20already%20exists");
            exit();
        }

        $this->createNewUser($this->newUNM, $this->newPWD, $this->newUIDNM, $this->newEMAIL);
    }

    public function getUserID(){    return $this->retrieveUserID($this->newUNM, $this->newEMAIL);}

    private function formFilledCheck(){
        if(empty($this->newUNM) || empty($this->newPWD) || empty($this->newUIDNM) || empty($this->newEMAIL))  return true;
        else  return false;
    }

    private function checkUserNames($data){
        if(preg_match('/^(?=.*[a-z]).{2,9}$/', $data))return true;
        else return false;
    }

    private function invalidEmail(){
        if(filter_var($this->newEMAIL, FILTER_VALIDATE_EMAIL))return true;
        else  return false;
    }

    private function alreadyExists(){
        if($this->checkifUserExists($this->newUIDNM, $this->newEMAIL))return true;
        else   return false;
    }
}