<?php
    session_start();
    if(!isset($_SESSION["LoggedUserid"])) 
        $_SESSION["LoggedUserid"] = "";
    /*variables in session
    $_SESSION["LoggedUserid"] //user's username
    $_SESSION["LoggedidNum"] //id of user in database used for verification checks
    $_SESSION["cartJSON"] //data stored in the cart as a json file
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
    <link rel="stylesheet" href="css/storestyle.css">
    <title>waverle  |   store</title>
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
    <nav class="store-products">
        <nav class="top-deals">
            <nav class="deal top-gpu" onclick="findproducts('gpu')">
                <h2>find the best and newest gpu deals</h2>
            </nav>
            <nav class="deal top-phones" onclick="findproducts('iphone')">
                <h2>find your new dream iphone!</h2>
            </nav>
            <nav class="deal top-utensils" onclick="findproducts('kitchen')">
                <h2>enhance your kitchen with new utensils</h2>
            </nav>
        </nav>
        <h1>shop by categories</h1>
        <nav class="categories">
            <nav class="category arts-craft" onclick="goToCategory('arts')">
                <h2>arts & craft</h2>
            </nav>
            <nav class="category beauty" onclick="goToCategory('beauty')">
                <h2>beauty products</h2>
            </nav>
            <nav class="category books" onclick="goToCategory('books')">
                <h2>books</h2>
            </nav>
            <nav class="category computers" onclick="goToCategory('computers')">
                <h2>computers</h2>
            </nav>
            <nav class="category technology" onclick="goToCategory('electronics')">
                <h2>tech products</h2>
            </nav>


            <nav class="category kitchen-and-home" onclick="goToCategory('kitchen')">
                <h2>kitchen and home</h2>
            </nav>
            <nav class="category clothing" onclick="goToCategory('clothing')">
                <h2>clothing</h2>
            </nav>
            <nav class="category television" onclick="goToCategory('television')">
                <h2>television</h2>
            </nav>
            <nav class="category consoles" onclick="goToCategory('consoles')">
                <h2>consoles</h2>
            </nav>
            <nav class="category video-games" onclick="goToCategory('games')">
                <h2>video games</h2>
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
                    <h2 onclick="scrollToSection('nav-bar')">scroll to the top</h2>
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
</body>
<script src="javascript/store.js"></script>
</html>