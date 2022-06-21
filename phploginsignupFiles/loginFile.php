<?php
/*variables in session
$_SESSION["LoggedUserid"] //user's username
$_SESSION["LoggedidNum"] //id of user in database used for verification checks
*/

if(isset($_POST["submit"]) == true){

    //getting user date from the website
    $UseridName = $_POST["loginUsernm"];
    $Userpwd = $_POST["loginUserpwd"];

    //instantiate logincontr class
    include "../phpcontrollerFiles/loginController.php";

    $newLogin = new loginController($UseridName, $Userpwd);

    //running error handlers and user signup
    $newIdValue = $newLogin->loginUser();
    session_start();
    $_SESSION["LoggedUserid"] = $_POST["loginUsernm"];
    $_SESSION["LoggedidNum"] = $newIdValue;
    //going to the home page
    header("location: ../index.php?success=hello%20again%20".$UseridName);
}