<?php

session_start();
if(isset($_POST["setProductLink"]) && $_POST["setProductLink"] != ""){
    $_SESSION["ProductURL"] = $_POST["setProductLink"];
}
else if(isset($_POST["productObject"]) && $_POST["productObject"] != ""){
    $productObject = json_decode($_POST["productObject"]);
    if(isset($_SESSION["cartJSON"])){
        $cart = json_decode($_SESSION["cartJSON"]);
        array_push($cart, $productObject);
        $_SESSION["cartJSON"] = json_encode($cart);
    }
    else{
        $cartArray = array($productObject);
        $_SESSION["cartJSON"] = json_encode($cartArray);
    }
}
else if(isset($_POST["replaceArray"]) && $_POST["replaceArray"]){
    $_SESSION["cartJSON"] = $_POST["replaceArray"];
}