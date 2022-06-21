<?php
/*variables in session
    $_SESSION["LoggedUserid"] //user's username
    $_SESSION["LoggedidNum"] //id of user in database used for verification checks
    $_SESSION["cartJSON"] //data stored in the cart as a json file
    */
    session_start();
    if(!isset($_SESSION["LoggedUserid"])) $_SESSION["LoggedUserid"] = "";
    //Include Google Configuration File
    include "phpcontrollerFiles/googleconfig.php";
 
    if(!isset($_SESSION['access_token'])){
        //Create a URL to obtain user authorization
        $login_signup_btn = '<nav class="other-sign-in-methods">'
   .'<a href="'.$google_client->createAuthUrl().'">'
   .'<nav class="googlesignup">'
   .'<img src="companylogo/Google_2015_logo.svg" alt="google-signup" id="googlesignupID">'
   .'</nav>'
   .'</a>'
   .'</nav>';
    }
    else if(isset($_SESSION['access_token'])) {
        header("Location: phpcontrollerFiles/setUpGoogle.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="svgfolder/layers-outline-logo.svg">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>waverle  |   welcome</title>
</head>
<body>
    <nav class="landingpage" id="landing-page">
        <nav class="header-section">
            <nav class="logo-section" onclick="scrollToSection('landing-page')">
                <nav class="image-class-layer-logo">
                    <img src="svgfolder/layers-outline-logo.svg" alt="layerlogo" id="layerlogoID">
                </nav>
            </nav>
            <h1 onclick="scrollToSection('landing-page')">waverle</h1>
            <h2 onclick="window.location.assign('store/store.php');">store</h2>
            <h3 onclick="scrollToSection('about-contact-container')">about us</h3>
            <h3 onclick="scrollToSection('about-contact-container')">contact us</h3><?php 
            $acfunction ="scrollToSection('signup-login-section')";
            $onclickFunc = "onclick=".$acfunction;
            if($_SESSION["LoggedUserid"] == "") echo "<h3 ".$onclickFunc.">login/signup</h3>"; 
            else if($_SESSION["LoggedUserid"] != "") echo "<h4>".$_SESSION["LoggedUserid"]."</h4>";
        ?></nav>
        <nav class="introText">
            <h1 data-aos="zoom-in-up"
                data-aos-delay="0"
                data-aos-duration="3000">your all in one store for everything...</h1>
        </nav>
        <nav class="takeToShop">
            <nav class="clickable" onclick="scrollToSection('store-section')">
                <h1>see what we offer</h1>
            </nav>
        </nav>
    </nav>
    <nav class="store-section" id="store-section">
        <nav class="store-features-one">
            <nav class="invisible-element">

            </nav>
            <nav onclick="window.location.assign('store/product.php?search?q=gpu');" class="tileOne tile" data-aos="fade-right"
            data-aos-offset="300"
            data-aos-delay="0"
            data-aos-duration="1000"
            data-aos-easing="ease-in-sine"
            data-aos-anchor-placement="bottom-bottom">
                <nav class="products-part">
                    <nav class="single-product"> 
                        <img src="products/gpu.jpg" alt> 
			            <figcaption>see our gpu offerings...</figcaption>
                    </nav>
                    <nav class="single-product"> 
                        <img src="products/cpu.jpg" alt>
			            <figcaption>cpu's</figcaption>
                    </nav>
                </nav>
            </nav>
            <nav onclick="window.location.assign('store/product.php?search?q=appliance');" class="tileTwo tile" data-aos="zoom-out-right"
            data-aos-easing="ease-in-sine"
            data-aos-delay="1500"
            data-aos-duration="2000"
            data-aos-anchor-placement="center-bottom">
                <figcaption>see what appliances we have</figcaption>
            </nav>
            <nav class="invisible-element">

            </nav>
        </nav>
        <nav class="navigation">
            <nav class="navigation-header">
                <h2 onclick="scrollToSection('about-contact-section')">about us</h2>
                <h2 onclick="scrollToSection('about-contact-section')">contact us</h2>
                <h2 onclick="scrollToSection('signup-login-section')"><?php 
                $acfunction ="scrollToSection('signup-login-section')";
                $onclickFunc = "onclick=".$acfunction;
                if($_SESSION["LoggedUserid"] == "") echo "<h2 ".$onclickFunc.">login/signup</h2>"; 
                else if($_SESSION["LoggedUserid"] != "") echo "<h3>".$_SESSION["LoggedUserid"]."</h3>";
            ?></nav>
            <nav class="nav-logo-section">
                <nav class="navigation-logo" onclick="scrollToSection('landing-page')">
                    <nav class="navigation-layer-logo">
                        <img src="svgfolder/layers-outline-logo.svg" alt="layerlogo" id="layerlogoID">
                    </nav>
                </nav>
                <h1 onclick="scrollToSection('landing-page')">waverle</h1>
            </nav>
            <nav class="scroll-below">
                <nav class="clickable" onclick="scrollToSection('about-contact-container')">
                    <h1>continue</h1>
                </nav>
            </nav>
        </nav>
        <nav class="store-features-two">
            <nav class="invisible-element">

            </nav>
            <nav onclick="window.location.assign('store/product.php?search?q=console');" class="tileThree tile"data-aos="fade-left"
            data-aos-offset="300"
            data-aos-delay="0"
            data-aos-duration="1500"
            data-aos-easing="ease-in-sine"
            data-aos-anchor-placement="bottom-bottom">
                <figcaption>see what consoles we have</figcaption>
            </nav>
            <nav onclick="window.location.assign('store/product.php?search?q=shoe');" class="tileFour tile" data-aos="zoom-out-left"
            data-aos-easing="ease-in-sine"
            data-aos-delay="1500"
            data-aos-duration="2500"
            data-aos-anchor-placement="center-bottom">
            <nav class="products-part">
                <nav class="single-product"> 
                    <img src="products/wearingshoes.jpg" alt> 
                    <figcaption>see what shoes we have...</figcaption>
                </nav>
                <nav class="single-product"> 
                    <img src="products/shoes.jpg" alt>
                    <figcaption>branded shoes</figcaption>
                </nav>
            </nav>
            </nav>
            <nav class="invisible-element">

            </nav>
        </nav>
    </nav>
    <nav class="about-contact-section" id="about-contact-section">
        <nav class="about-contact-container" id="about-contact-container">
            <nav class="about-us-section">
                <nav class="details-about-us" id="details-about-us">
                    <h1 onclick="scrollToSection('landing-page')">waverle</h1>
                    <nav class="text-section">
                        <p>sounds like </p>
                        <h2>way·ferl</h2>
                    </nav>
                    <nav class="description-section">
                        <p>we are company that sells and resells consumer goods in almost all categories<br>
                            such as tech, clothing, beauty products, furniture and so on</p>
                    </nav>
    
                    <nav class="description-section">
                        <p>we are company that sells and resells consumer goods in almost all categories<br>
                            such as tech, clothing, beauty products, furniture and so on</p>
                    </nav>
    
                    <nav class="description-section">
                        <p>we are company that sells and resells consumer goods in almost all categories<br>
                            such as tech, clothing, beauty products, furniture and so on</p>
                    </nav>
    
                    <nav class="description-section">
                        <p>we are company that sells and resells consumer goods in almost all categories<br>
                            such as tech, clothing, beauty products, furniture and so on</p>
                    </nav>
    
                    <nav class="description-section">
                        <p>we are company that sells and resells consumer goods in almost all categories<br>
                            such as tech, clothing, beauty products, furniture and so on</p>
                    </nav>
                    <nav class="scrollForMore">
                        <nav class="clickable-about" onclick="scrollToPlace('details-about-us')">
                            <h3>see more about us</h3>
                        </nav>
                    </nav>
                </nav>
                <nav class="timeline-about-us" id="timeline-about-us">
                    <nav class="scrollBackUP">
                        <nav class="clickable-about" onclick="scrollToPlace('timeline-about-us')">
                            <h3>scroll back up</h3>
                        </nav>
                    </nav>
                </nav>
            </nav>
            <nav class="contact-us-section"
                data-aos="zoom-in-left"
                data-aos-duration="750">
                <h1>contact us on: </h1>
                <a href="https://discord.com" target="_blank" class="platform">
                    <nav class="logo-image">
                        <img src="companylogo/logo-discord-gray.svg" alt="none" id="discordlogoID">
                    </nav>
                    <nav class="platform-link">
                        <h2>discord server</h2>
                    </nav>
                </a>  
                <a href="https://www.google.com/" target="_blank" class="platform">
                    <nav class="logo-image">
                        <img src="companylogo/logo-google-gray.svg" alt="none" id="googlelogoID">
                    </nav>
                    <nav class="platform-link">
                        <h2>email</h2>
                    </nav>
                </a>  
                <a href="https://www.instagram.com/" target="_blank" class="platform">
                    <nav class="logo-image">
                        <img src="companylogo/logo-instagram-gray.svg" alt="none" id="instagramlogoID">
                    </nav>
                    <nav class="platform-link">
                        <h2>instagram</h2>
                    </nav>
                </a>  
                <a href="https://www.reddit.com/" target="_blank" class="platform">
                    <nav class="logo-image">
                        <img src="companylogo/logo-reddit-gray.svg" alt="none" id="redditlogoID">
                    </nav>
                    <nav class="platform-link">
                        <h2>reddit forum</h2>
                    </nav>
                </a> 
                <a href="https://www.tiktok.com/" target="_blank" class="platform">
                    <nav class="logo-image">
                        <img src="companylogo/logo-tiktok-gray.svg" alt="none" id="tiktoklogoID">
                    </nav>
                    <nav class="platform-link">
                        <h2>tiktok</h2>
                    </nav>
                </a>  
                <a href="https://twitter.com/" target="_blank" class="platform">
                    <nav class="logo-image">
                        <img src="companylogo/logo-twitter-gray.svg" alt="none" id="twitterlogoID">
                    </nav>
                    <nav class="platform-link">
                        <h2>twitter</h2>
                    </nav>
                </a>

                <nav class="scroll-to-below-section">
                    <nav class="clickable" onclick="scrollToSection('signup-login-section')">
                        <h3>continue to signup</h3>
                    </nav>
                </nav>
            </nav>
        </nav>
    </nav>
    <nav class="signup-login-section" id="signup-login-section">
        <nav class="sign-up-login">
            <nav class="sign-up-login-container">
                <nav class="login" id="login">
                    <h1>Hello Again!</h1>
                    <h2>sign in to continue shopping</h2>
                    <form method="post" action="phploginsignupFiles/loginFile.php" onsubmit="return validateLogin()">
                        <input type="text" id="greycolor1" name="loginUsernm" placeholder="username less than 9 letters">
                        <br>
                        <input type="password" id="greycolor2" name="loginUserpwd" placeholder="password">
                        <br>
                        <button type="submit" name="submit" id="formLoginSubmitButton">Login</button>
                    </form>
                    <?php if(isset($login_signup_btn)) echo $login_signup_btn;?>
                    <h3 onclick="scrollToPlace('login')">dont have an account? click here</h3>
                </nav>
                <nav class="signup" id="signup">
                    <h1>Welcome!</h1>
                    <h2>sign up to start shopping</h2>
                    <form method="post" action="phploginsignupFiles/signupFile.php" onsubmit="return validateSignUp()">
                        <input type="text" id="greycolor3" name="Username" placeholder="name">
                        <br>
                        <input type="text" id="greycolor4" name="Usernm" placeholder="username less than 9 letters">
                        <br>
                        <input type="text" id="greycolor5" name="Usereml" placeholder="email">
                        <br>
                        <input type="password" id="greycolor6" name="Userpwd" placeholder="password">
                        <br>
                        <button type="submit" name="submit" id="formSignUpSubmitButton">Sign Up</button>
                    </form>
                    <?php if(isset($login_signup_btn)) echo $login_signup_btn;?>
                    <h3 onclick="scrollToPlace('signup')">have an account? click here</h3>
                </nav>
            </nav>
        </nav>
        <nav class="navigation-menu">
            <nav class="nav-menu-container">
                <nav class="navigation-menu-logo" onclick="scrollToSection('landing-page')">
                    <nav class="navigation-menu-layer-logo">
                        <img src="svgfolder/layers-outline-logo.svg" alt="layerlogo" id="layerlogoID">
                    </nav>
                </nav>
                <h3 onclick="scrollToSection('landing-page')">waverle</h3>
                <h2 onclick="scrollToSection('about-contact-container')">about us</h2>
                <h2 onclick="scrollToSection('about-contact-container')">contact us</h2>
                <nav class="nav-scroll-below">
                    <nav class="clickable" onclick="scrollToSection('footer-container')">
                        <h1>continue scrolling</h1>
                    </nav>
                </nav>
            </nav>
        </nav>
    </nav>
    <nav class="footer-section" id="footer-section">
        <nav class="footer-container" id="footer-container">
            <nav class="company-logo">
                <nav class="footer-logo-section" onclick="scrollToSection('landing-page')">
                    <nav class="footer-class-layer-logo">
                        <img src="svgfolder/layers-outline-logo.svg" alt="layerlogo" id="layerlogoID">
                    </nav>
                </nav>
                <h1 onclick="scrollToSection('landing-page')">waverle</h1>
            </nav>
            <nav class="footer-part">
                <nav class="footer-links">
                    <h2 onclick="scrollToSection('landing-page')">scroll back up top</h2>
                    <h2 onclick="window.location.assign('store/store.php');">shopping store</h2>
                    <h2 onclick="scrollToSection('about-contact-container')">about us</h2>
                    <h2 onclick="scrollToSection('about-contact-container')">contact us</h2>
                    <h2 onclick="scrollToSection('signup-login-section')">login</h2>
                    <h2 onclick="scrollToSection('signup-login-section')">signup</h2>
                    <h3>©2022 waverle. All rights reserved</h3>
                </nav>
                <nav class="sponsor-section">
                    <a href="https://www.apple.com/" target="_blank" class="sponser">
                        <nav class="company-logo-image">
                            <img src="companylogo/Apple_Pay-gray.svg" alt="none" id="applePaylogoID">
                        </nav>
                    </a> 
                    <a href="https://www.mastercard.co.za" target="_blank" class="sponser">
                        <nav class="company-logo-image">
                            <img src="companylogo/mastercard-gray.svg" alt="none" id="mastercardlogoID">
                        </nav>
                    </a>  
                    <a href="https://www.paypal.com" target="_blank" class="sponser">
                        <nav class="company-logo-image">
                            <img src="companylogo/paypal-gray.svg" alt="none" id="paypallogoID">
                        </nav>
                    </a>  
                    <a href="https://www.visa.co.za" target="_blank" class="sponser">
                        <nav class="company-logo-image">
                            <img src="companylogo/visa-gray.svg" alt="none" id="visalogoID">
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
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="javascript/welcomepage.js"></script>
</html>