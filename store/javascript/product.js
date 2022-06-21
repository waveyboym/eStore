window.onload = function(){ 
    searchForItems();
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
        document.querySelector(".nav-bar").style.boxShadow = "25px 25px 60px #272727, 25px 25px 60px #353535";
        let navLinks = document.querySelectorAll(".nav-bar a h3");
        for(let i = 0; i < navLinks.length; ++i){
            navLinks[i].style.color = "white";
        }
        document.querySelector(".nav-bar input").style.borderColor = "white";
        let productTiles = document.querySelectorAll(".product-tile");
        let productTilesh2 = document.querySelectorAll(".product-tile h2");
        let productTilesh3 = document.querySelectorAll(".details-section h3");
        let productTilesh4 = document.querySelectorAll(".details-section h4");
        for(let i = 0; i < productTiles.length; ++i){
            productTiles[i].style.background = "#2e2e2e";
            productTiles[i].style.boxShadow = "35px 35px 70px #272727,-35px -35px 70px #353535";
            productTilesh2[i].style.color = "white";
            productTilesh3[i].style.color = "white";
            productTilesh4[i].style.color = "white";
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
        document.querySelector(".nav-bar").style.boxShadow = "25px 25px 60px #bebebe, 25px 25px 60px #ffffff";
        document.querySelector(".nav-bar a h3").style.color = "gray";
        let navLinks = document.querySelectorAll(".nav-bar a h3");
        for(let i = 0; i < navLinks.length; ++i){
            navLinks[i].style.color = "gray";
        }
        document.querySelector(".nav-bar input").style.borderColor = "gray";

        let productTiles = document.querySelectorAll(".product-tile");
        let productTilesh2 = document.querySelectorAll(".product-tile h2");
        let productTilesh3 = document.querySelectorAll(".details-section h3");
        let productTilesh4 = document.querySelectorAll(".details-section h4");
        for(let i = 0; i < productTiles.length; ++i){
            productTiles[i].style.background = "#ededed";
            productTiles[i].style.boxShadow = "35px 35px 70px #bebebe,-35px -35px 70px #ffffff";
            productTilesh2[i].style.color = "gray";
            productTilesh3[i].style.color = "gray";
            productTilesh4[i].style.color = "gray";
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

function switchOffLoader(){     document.querySelector(".loader-container").remove();}

function switchOnLoader(){
    document.querySelector(".products-display").innerHTML = '<nav class="loader-container">'
                                                                +'<nav class="loader">Loading...</nav>'
                                                            +'</nav>';
}

let searchForItems = function(){
    let stringData = window.location.href;
    let startIndex = stringData.indexOf("search?q=");
    if(startIndex == -1) {  document.querySelector(".search-heading h1").innerHTML = "no results found"; return;}
    switchOnLoader();
    stringData = stringData.substring(startIndex, stringData.length);
    let productToSearch = stringData.replace("search?q=", "");
    activateAPIcall(productToSearch);
}

let activateAPIcall = function(keywordToSearch){
    let textdisplay =  keywordToSearch.replace("%20", " ");
    document.querySelector(".search-heading h1").innerHTML = "showing results for all " + textdisplay + "s";
    const data = null;
    const xhr = new XMLHttpRequest();
    xhr.withCredentials = true;

    xhr.addEventListener("readystatechange", function () {
	    if (this.readyState === this.DONE) {
		    displayProducts(this.responseText);
	    }
    });

    xhr.open("GET", "https://real-store.p.rapidapi.com/search/"+ keywordToSearch);
    xhr.setRequestHeader("X-RapidAPI-Host", "real-store.p.rapidapi.com");
    xhr.setRequestHeader("X-RapidAPI-Key", "377078ab02msh13cd1b50f7068b8p1a7679jsne0b317e8e061");

    xhr.send(data);
}

let searchFor = function(){
    let getUserKeyWords = document.getElementById("searchbar").value;

    if(getUserKeyWords == ""){  document.getElementById("searchbar").placeholder = "search cannot be empty!";   return;}
    else{  
        getUserKeyWords = getUserKeyWords.replace(" ", "%20");
        switchOnLoader();    
        activateAPIcall(getUserKeyWords);
    }

}

let displayProducts = function(object){
    let productsJSON = JSON.parse(object);
    console.log(productsJSON);
    switchOffLoader();
    let productsDisplay = document.querySelector(".products-display");
    productsDisplay.innerHTML = "";
    let length = productsJSON.results.length;
    if(length == 0){  document.querySelector(".search-heading h1").innerHTML = "no results found"; return;}

    for(let i = 0; i < length && i < 30; ++i){
        let productsID = getProductID(productsJSON.results[i].url);
        let productURL = productsJSON.results[i].url;

        if(productsID != ""){
            productsID = "'"+ productsID + "'";
            productURL = "'" + productURL + "'";
            productsDisplay.innerHTML = productsDisplay.innerHTML 
            +'<nav class="product-tile" onclick="openProduct('+ productsID +','+ productURL +')">'
                + '<nav class="product-img">'
                    +'<div class="img-class">'
                        +'<img src="'+ productsJSON.results[i].image +'" class="product-image-image">'
                    +'</div>'
                +'</nav>'
                +'<h2>'+ productsJSON.results[i].name +'</h2>'
                +'<nav class="details-section">'
                    +'<h3>$'+ productsJSON.results[i].price +'</h3>'
                    +'<h4>'+    productsJSON.results[i].stars +'⭐</h4>'
                +'</nav>'
            +'</nav>';
        }
        else continue;
    }
}

let openProduct = function(productID, amazonProductURL){
    let requestType = "setProductLink=" + amazonProductURL;
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function (){
        window.location.assign('productDetails.php?search?q=' + productID);
    };

    xmlhttp.open("POST", "sessionVarMNGR.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(requestType);
}

let getProductID = function(productLink){
    //"https://www.amazon.com/Purina-Friskies-Food-Poultry-Seafood/dp/B07NRC3B7K/ref=sr_1_3?keywords=pet+supplies&qid=1643114373&sr=8-3"
    let startIndex = productLink.indexOf("/dp/");
    let stopIndex = productLink.indexOf("/ref=sr_");
    if(startIndex == -1 || stopIndex == -1) return "";
    let pid = productLink.substring(startIndex, stopIndex);
    pid = pid.replace("/dp/", "");
    return pid;
}