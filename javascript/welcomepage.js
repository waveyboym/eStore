window.onload = function(){
    decipherMessageFromLoginSignUp();
}

function scrollToSection(scrollToPart) {
    const element = document.getElementById(scrollToPart);
    element.scrollIntoView({behavior: 'smooth' });
}

function scrollToPlace(selectable){
    document.getElementById(selectable).className = selectable + ' ' + selectable +'-animate';
    if(selectable == "details-about-us"){
        document.getElementById("timeline-about-us").className = "timeline-about-us";
        document.getElementById("details-about-us").style.opacity = "0";
    }
    else if(selectable == "timeline-about-us"){
        document.getElementById("details-about-us").className = "details-about-us";
        setTimeout( function(){document.getElementById("details-about-us").style.opacity = "1";}, 2000);
    }
    else if(selectable == "login"){
        document.getElementById("login").style.opacity = "0";
        document.getElementById("signup").className = "signup";
    }
    else if(selectable == "signup"){
        document.getElementById("login").className = "login";
        setTimeout( function(){document.getElementById("login").style.opacity = "1";}, 1000);
    }
}
AOS.init();

/*
RegEx	Description
^	The password string will start this way
(?=.*[a-z])	The string must contain at least 1 lowercase alphabetical character
(?=.*[A-Z])	The string must contain at least 1 uppercase alphabetical character
(?=.*[0-9])	The string must contain at least 1 numeric character
(?=.*[!@#$%^&*])	The string must contain at least one special character, but we are escaping reserved RegEx characters to avoid conflict
(?=.{8,})	The string must be eight characters or longer
*/
let passWordReg = new RegExp("^((?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*]))");
let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
let nameReg = new RegExp("^((?=.{2,})(?=.*[a-z]))");
let UserNameReg = new RegExp("^((?=.{2,7})(?=.*[a-z]))");

let validateSignUp = function(){
    let getName = document.getElementsByName("Username")[0].value;
    let getUserName = document.getElementsByName("Usernm")[0].value;
    let getEmail = document.getElementsByName("Usereml")[0].value;
    let getPassword = document.getElementsByName("Userpwd")[0].value;

    if(getName == "" || getUserName == "" || getEmail == "" || getPassword == ""){
        document.querySelector(".signup h2").innerHTML = "please fill in the form";
        return false;
    }
    if(!nameReg.test(getName)){//name is not valid
        document.querySelector(".signup h2").innerHTML = "please fill in a valid name";
        if(document.getElementById("greycolor3") != null)document.getElementById("greycolor3").id = "redcolor3";
        document.getElementsByName("Username")[0].value = "";
        document.getElementsByName("Userpwd")[0].value = "";
        return false;
    }
    if(!UserNameReg.test(getUserName)){//username is not valid
        document.querySelector(".signup h2").innerHTML = "please fill in a valid username";
        if(document.getElementById("greycolor4") != null)document.getElementById("greycolor4").id = "redcolor4";
        document.getElementsByName("Usersnm")[0].value = "";
        document.getElementsByName("Userpwd")[0].value = "";
        return false;
    }
    if(!getEmail.match(regexEmail)){//email is not valid
        document.querySelector(".signup h2").innerHTML = "please fill in a valid email";
        if(document.getElementById("greycolor5") != null)document.getElementById("greycolor5").id = "redcolor5";
        document.getElementsByName("Usereml")[0].value = "";
        document.getElementsByName("Userpwd")[0].value = "";
        return false;
    }
    if(!passWordReg.test(getPassword)){//password is not valid
        document.querySelector(".signup h2").innerHTML = "password must be greater than 8 characters with<br>upper,lowercase letters and symbols";
        if(document.getElementById("greycolor6") != null)document.getElementById("greycolor6").id = "redcolor6";
        document.getElementsByName("Userpwd")[0].value = "";
        return false;
    }
    return true;
}

let validateLogin = function(){
    let getUserName = document.getElementsByName("loginUsernm")[0].value;
    let getPassword = document.getElementsByName("loginUserpwd")[0].value;

    if(getUserName == "" || getPassword == ""){
        document.querySelector(".login h2").innerHTML = "please fill in the form";
        return false;
    }
    if(!UserNameReg.test(getUserName)){//username is not valid
        document.querySelector(".login h2").innerHTML = "please fill in a valid username";
        if(document.getElementById("greycolor1") != null)document.getElementById("greycolor1").id = "redcolor1";
        document.getElementsByName("loginUsernm")[0].value = "";
        document.getElementsByName("loginUserpwd")[0].value = "";
        return false;
    }
    if(!passWordReg.test(getPassword)){//password is not valid
        document.querySelector(".login h2").innerHTML = "password must be greater than 8 characters with<br>upper,lowercase letters and symbols";
        if(document.getElementById("greycolor2") != null)document.getElementById("greycolor2").id = "redcolor2";
        document.getElementsByName("loginUserpwd")[0].value = "";
        return false;
    }
    return true;
}

let decipherMessageFromLoginSignUp = function(){
    let stringData = window.location.href;

    if(stringData.includes("error=")){
        let startIndex = stringData.indexOf("error=");
        stringData = stringData.substring(startIndex, stringData.length);
        let message = stringData.replace("error=", "");
        message = message.replace(/%20/g, " ");
        document.querySelector(".login h2").innerHTML = message;
        scrollToSection('signup-login-section');
    }
}