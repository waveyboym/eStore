<?php
include "../phpcontrollerFiles/maindatabase.php";
class saveCart extends maindatabase{
    private $cartJsonObjArr;
    private $size;

    public function __construct($objARR){
        $this->cartJsonObjArr = $objARR;
        $this->size = count($this->cartJsonObjArr);
        $this->saveUserCart();
    }

    private function saveUserCart(){
        $databaseAccess = $this->connect()->prepare('DELETE FROM cart WHERE CART_UserID = ?;');

        if(!($databaseAccess->execute(array($_SESSION["LoggedidNum"])))){
            $databaseAccess = null;
            header("location: ../index.php?problem=something%20went%20wrong%20on%20our%20side");
            exit();
        }
        $databaseAccess = null;

        for($i = 0; $i < $this->size; ++$i){
            $databaseAccess = $this->connect()->prepare('INSERT INTO cart (product_name, product_url, product_id, product_img_url, product_price, product_rating, product_availability, CART_UserID) VALUES (?, ?, ?, ?, ?, ?, ?, ?);');

            if(!$databaseAccess->execute(array($this->cartJsonObjArr[$i]->name, $this->cartJsonObjArr[$i]->Produrl, $this->cartJsonObjArr[$i]->ID, $this->cartJsonObjArr[$i]->imageURL, $this->cartJsonObjArr[$i]->price, $this->cartJsonObjArr[$i]->rating, $this->cartJsonObjArr[$i]->availability, $_SESSION["LoggedidNum"]))){
                $databaseAccess = null;
                header("location: ../index.php?problem=could%20not%20update%20database");
                exit();
            }
            $databaseAccess = null;
        }
    }
}

/*variables in session
    $_SESSION["LoggedUserid"] //user's username
    $_SESSION["LoggedidNum"] //id of user in database used for verification checks
    $_SESSION["cartJSON"] //data stored in the cart as a json file
    $_SESSION["googleLogged"] // f/t indicates if the user logged is a google account
    */
session_start();

if(isset($_SESSION["cartJSON"])){
    $cartJsonObjArr = json_decode($_SESSION["cartJSON"]);
    $newSave = new saveCart($cartJsonObjArr);
}

if(isset($_SESSION["googleLogged"]) && $_SESSION["googleLogged"] = true){
    include "../phpcontrollerFiles/googleconfig.php";
    //Reset OAuth access token
    $google_client->revokeToken();
}

session_unset();
session_destroy();

//going back to front page
header("location: ../index.php?goodbye");
