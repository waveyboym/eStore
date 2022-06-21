window.onload = function(){
    let data = window.sessionStorage.getItem("getSessiondarkModeLightMode");
    if(data == "dark" || data== "light"){
        currentMode = data;
        darkModeLightMode();
    }    
}

function scrollToSection(scrollToPart) {
    const element = document.getElementById(scrollToPart);
    element.scrollIntoView({behavior: 'smooth' });
}

let currentMode = "light";
function darkModeLightMode(){
    if(currentMode == "light"){
        document.querySelector(".invisible-element h2").innerHTML = "turn on light mode";
        document.querySelector("body").style.backgroundColor = "#2e2e2e";
        document.querySelector("body").style.color = "white";
        document.querySelector(".nav-bar").style.boxShadow = "25px 25px 60px #272727, 0px 0px 0px #353535";
        let navLinks = document.querySelectorAll(".nav-bar a h3");
        for(let i = 0; i < navLinks.length; ++i){
            navLinks[i].style.color = "white";
        }
        document.querySelector(".nav-bar input").style.borderColor = "white";
        let dealNav = document.querySelectorAll(".deal");
        for(let i = 0; i < dealNav.length; ++i){
            dealNav[i].style.boxShadow = "32px 32px 63px #272727,-32px -32px 63px #353535";
        }
        let categoryNav = document.querySelectorAll(".category");
        for(let i = 0; i < categoryNav.length; ++i){
            categoryNav[i].style.boxShadow = "20px 20px 40px #272727,-20px -20px 40px #353535";
        }

        //svg images
        document.getElementById("layerlogoID").src = "../svgfolder/layers-outline-logo.svg";
        document.getElementById("searchID").src = "../svgfolder/search-outline.svg";
        if(document.getElementById("logoutID") != null) document.getElementById("logoutID").src = "../svgfolder/log-out-outline.svg";
        document.getElementById("cartID").src = "../svgfolder/cart-outline.svg";
        document.getElementById("footerlogoID").src = "../svgfolder/layers-outline-logo.svg";
        window.sessionStorage.setItem("getSessiondarkModeLightMode", "light");
        currentMode = "dark";
    }
    else if(currentMode == "dark"){
        document.querySelector(".invisible-element h2").innerHTML = "turn on dark mode";
        document.querySelector("body").style.backgroundColor = "#ededed";
        document.querySelector("body").style.color = "gray";
        document.querySelector(".nav-bar").style.boxShadow = "25px 25px 60px #bebebe, 0px 0px 0px #ffffff";
        document.querySelector(".nav-bar a h3").style.color = "gray";
        let navLinks = document.querySelectorAll(".nav-bar a h3");
        for(let i = 0; i < navLinks.length; ++i){
            navLinks[i].style.color = "gray";
        }
        document.querySelector(".nav-bar input").style.borderColor = "gray";
        let dealNav = document.querySelectorAll(".deal");
        for(let i = 0; i < dealNav.length; ++i){
            dealNav[i].style.boxShadow = "32px 32px 63px #c9c9c9,-32px -32px 63px #ffffff";
        }
        let categoryNav = document.querySelectorAll(".category");
        for(let i = 0; i < categoryNav.length; ++i){
            categoryNav[i].style.boxShadow = "20px 20px 40px #c9c9c9,-20px -20px 40px #ffffff";
        }

        //svg images
        document.getElementById("layerlogoID").src = "../svgfolder/layers-outline-gray.svg";
        document.getElementById("searchID").src = "../svgfolder/search-outline-gray.svg";
        if(document.getElementById("logoutID") != null) document.getElementById("logoutID").src = "../svgfolder/log-out-outline-gray.svg";
        document.getElementById("cartID").src = "../svgfolder/cart-outline-gray.svg";
        document.getElementById("footerlogoID").src = "../svgfolder/layers-outline-gray.svg";
        window.sessionStorage.setItem("getSessiondarkModeLightMode", "dark");
        currentMode = "light";
    }
}

let searchFor = function(){
    let getUserKeyWords = document.getElementById("searchbar").value;

    if(getUserKeyWords == ""){  document.getElementById("searchbar").placeholder = "search cannot be empty!";   return;}
    else{  
        getUserKeyWords = getUserKeyWords.replace(" ", "%20");
        window.location.assign('product.php?search?q=' + getUserKeyWords);
    }
}

let findproducts = function(productToFind){ window.location.assign('product.php?search?q=' + productToFind);}

let goToCategory = function(categoryToSearch){  window.location.assign('product.php?search?q=' + categoryToSearch);}
