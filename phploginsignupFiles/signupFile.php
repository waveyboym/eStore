<?php
/*variables in session
$_SESSION["LoggedUserid"] //user's username
$_SESSION["LoggedidNum"] //id of user in database used for verification checks
*/

if(isset($_POST["submit"]) == true){

    //getting user data from login form
    $Username = $_POST["Username"];
    $UseridName = $_POST["Usernm"];
    $Userpwd = $_POST["Userpwd"];
    $Useremail = $_POST["Usereml"];

    //instantiate signupcontr class
    include "../phpcontrollerFiles/signupController.php";

    $newSignUp = new signupcontroller($Username, $UseridName, $Userpwd, $Useremail);

    //running error handlers and user signup
    $newSignUp->signUpNewUser();
    $newIdValue = $newSignUp->getUserID();
    session_start();
    $_SESSION["LoggedUserid"] = $_POST["Usernm"];
    $_SESSION["LoggedidNum"] = $newIdValue;
    //going back to the homepage
    header("location: ../index.php?success=welcome%20".$UseridName);
}