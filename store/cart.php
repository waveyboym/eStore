<?php
    session_start();
    if(!isset($_SESSION["LoggedUserid"])) 
        $_SESSION["LoggedUserid"] = "";
    /*variables in session
    $_SESSION["LoggedUserid"] //user's username
    $_SESSION["LoggedidNum"] //id of user in database used for verification checks
    $_SESSION["cartJSON"] //data stored in the cart as a json file
    $_SESSION["ProductURL"]//url of product open on productdetails.php
    */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../svgfolder/layers-outline-logo.svg">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/headerAndFooter.css">
    <link rel="stylesheet" href="css/cartstyle.css">
    <title>waverle  |   cart</title>
</head>
<body>
    <nav class="nav-bar" id="nav-bar">
        <nav class="logo-section" onclick="window.location.assign('../index.php#landing-page');">
            <nav class="image-class-layer-logo">
                <img src="../svgfolder/layers-outline-gray.svg" alt="layerlogo" id="layerlogoID">
            </nav>
        </nav>
        <h1 onclick="window.location.assign('../index.php#landing-page');">waverle</h1>
        <input type="text" id="searchbar" placeholder="search for">
        <nav class="logo-section">
            <nav class="utilities-logo" onclick="searchFor()">
                <img src="../svgfolder/search-outline-gray.svg" alt="layerlogo" id="searchID">
            </nav>
        </nav>
        <nav class="invisible-element">
            <h2 onclick="darkModeLightMode()">turn on dark mode</h2>
        </nav>
        <a class="first-part" href="#"><h3>select region</h3></a>
        <a href="../index.php#about-contact-container"><h3>about us</h3></a>
        <a href="../index.php#about-contact-container"><h3>contact us</h3></a>
        <?php 
        $logOutLocation = "'../phploginsignupFiles/logoutFile.php'";
        if($_SESSION["LoggedUserid"] == ""){
            echo "<h3>login/signup</h3>";
        } 
        else if($_SESSION["LoggedUserid"] != "") {
            echo '<h4>'.$_SESSION["LoggedUserid"].'</h4>'
                .'<nav class="logo-section">'
                    .'<nav onclick="window.location.assign('.$logOutLocation.');" class="php-utilities-logo">'
                        .'<img src="../svgfolder/log-out-outline-gray.svg" alt="layerlogo" id="logoutID">'
                    .'</nav>'
                .'</nav>';
        }?> 
        <nav class="logo-section">
            <nav onclick="window.location.assign('cart.php');" class="php-utilities-logo">
                <img src="../svgfolder/cart-outline-gray.svg" alt="layerlogo" id="cartID">
            </nav>
        </nav>
    </nav>
    <nav class="cart-section">
        <nav class="trolley">
            <h1>Trolley</h1>
            <nav class="item-header">
                <h2>product</h2>
                <h3>price</h3>
                <h4>delete</h4>
            </nav>
            <nav class="items">

            </nav>
        </nav>
        <nav class="checkout">
            <h1>Summary</h1>
            <h2></h2>
            <h5></h5>
            <h3></h3>
            <nav class="checkout-button">
                <h4>proceed to checkout</h4>
            </nav>
            <nav class="paypal-checkout">
                <nav class="paypal-logo">
                    <img src="../companylogo/paypal.svg" alt="none" id="paypallogoID">
                </nav>
            </nav>
        </nav>
    </nav>
    <nav class="footer-section" id="footer-section">
        <nav class="footer-container" id="footer-container">
            <nav class="company-logo">
                <nav class="footer-logo-section" onclick="scrollToSection('landing-page')">
                    <nav class="footer-class-layer-logo">
                        <img src="../svgfolder/layers-outline-gray.svg" alt="layerlogo" id="footerlogoID">
                    </nav>
                </nav>
                <h1 onclick="scrollToSection('nav-bar')">waverle</h1>
            </nav>
            <nav class="footer-part">
                <nav class="footer-links">
                    <h2 onclick="window.location.assign('../index.php');">home</h2>
                    <h2 onclick="window.location.assign('store.php');">go to store home page</h2>
                    <h2 onclick="window.location.assign('../index.php#about-contact-container')">about us</h2>
                    <h2 onclick="window.location.assign('../index.php#about-contact-container')">contact us</h2>
                    <h2 onclick="window.location.assign('../index.php#signup-login-section')">login</h2>
                    <h2 onclick="window.location.assign('../index.php#signup-login-section')">signup</h2>
                    <h3>©2022 waverle. All rights reserved</h3>
                </nav>
                <nav class="sponsor-section">
                    <a href="https://www.apple.com/" target="_blank" class="sponser">
                        <nav class="company-logo-image">
                            <img src="../companylogo/Apple_Pay-gray.svg" alt="none" id="applePaylogoID">
                        </nav>
                    </a> 
                    <a href="https://www.mastercard.co.za" target="_blank" class="sponser">
                        <nav class="company-logo-image">
                            <img src="../companylogo/mastercard-gray.svg" alt="none" id="mastercardlogoID">
                        </nav>
                    </a>  
                    <a href="https://www.paypal.com" target="_blank" class="sponser">
                        <nav class="company-logo-image">
                            <img src="../companylogo/paypal-gray.svg" alt="none" id="paypallogoID">
                        </nav>
                    </a>  
                    <a href="https://www.visa.co.za" target="_blank" class="sponser">
                        <nav class="company-logo-image">
                            <img src="../companylogo/visa-gray.svg" alt="none" id="visalogoID">
                        </nav>
                    </a>  
                </nav>
                <nav class="send-a-letter">
                    <h1>send us a letter</h1>
                    <input type="text" id="myNoteTitle" placeholder="your name and surname">
                    <nav class="text-box">
                        <textarea  id="myNoteActualText" name="actual-notes">say something here...
                        </textarea>
                    </nav>
                    <h2>*you can only send messages if you are logged in</h2>
                    <nav class="send-message-section">
                        <nav class="clickable" onclick="sendNewMessage()">
                            <h3>send message</h3>
                        </nav>
                    </nav>
                </nav>
            </nav>
        </nav>
    </nav>
<script src="javascript/cart.js"></script>
<?php 
    if(isset($_SESSION["cartJSON"])){ ?>
        <script> collectCartJsonData(<?php echo $_SESSION["cartJSON"];?>); </script> <?php
    }
?>
</body>
</html>