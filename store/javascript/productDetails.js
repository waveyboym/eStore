window.onload = function(){
    searchForItem();
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
        if(document.querySelector(".products-displaytile") != null){
            document.querySelector(".products-displaytile").style.backgroundColor = "#2e2e2e";
            document.querySelector(".products-displaytile").style.boxShadow = "65px 65px 130px #272727, 45px 45px 90px #353535";
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
        if(document.querySelector(".products-displaytile") != null){ 
            document.querySelector(".products-displaytile").style.backgroundColor = "#ededed";
            document.querySelector(".products-displaytile").style.boxShadow = "65px 65px 130px #bebebe, 65px 65px 130px #ffffff";
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

function image(imageobject){
    let getMainImage = document.querySelector(".img-class img");
    let getSmallerImgClasses = document.querySelectorAll(".smaller-img-class img");
    let tempImgHolder = getMainImage.src;
    getMainImage.src = imageobject.src;
    imageobject.src = tempImgHolder;
}

let searchForItem = function(){
    let stringData = window.location.href;
    let startIndex = stringData.indexOf("search?q=");
    if(startIndex == -1) {  document.querySelector(".search-heading h1").innerHTML = "no available product info";    return;}
    switchOnLoader();
    stringData = stringData.substring(startIndex, stringData.length);
    let productID = stringData.replace("search?q=", "");
    document.querySelector(".search-heading h1").innerHTML = "product info";

    const data = null;

    const xhr = new XMLHttpRequest();
    xhr.withCredentials = true;

    xhr.addEventListener("readystatechange", function () {
	    if (this.readyState === this.DONE) {
            displayProducts(this.responseText);
	    }
    });

    xhr.open("GET", "https://real-store.p.rapidapi.com/products/"+ productID +"?apiKey=b43e91fb824752147e573249b55d477a");
    xhr.setRequestHeader("X-RapidAPI-Host", "real-store.p.rapidapi.com");
    xhr.setRequestHeader("X-RapidAPI-Key", "377078ab02msh13cd1b50f7068b8p1a7679jsne0b317e8e061");
    xhr.send(data);
}

let productsJSON;
let productURL;
let addedToCart = false;

let displayProducts = function(object){
    productsJSON = JSON.parse(object);
    console.log(productsJSON);
    switchOffLoader();
    let productsDisplay = document.querySelector(".products-display");
    productsDisplay.innerHTML = "";

    productsDisplay.innerHTML = productsDisplay.innerHTML + 
    '<nav class="products-displaytile">'
        +'<nav class="image-tile">'
            +'<nav class="product-multiple-images">'
                +'<nav class="product-img">'
                    +'<div class="img-class">'
                        +'<img src="'+ productsJSON.images[0] +'" class="product-image-image">'
                    +'</div>'
                +'</nav>'
                +'<nav class="smaller-images">'
                    +'<div class="smaller-img-class">'
                        +'<img src="'+ productsJSON.images[1] +'" class="smaller-product-image-image" onclick="image(this)">'
                    +'</div>'
                    +'<div class="smaller-img-class">'
                        +'<img src="'+ productsJSON.images[2] +'" class="smaller-product-image-image" onclick="image(this)">'
                    +'</div>'
                    +'<div class="smaller-img-class">'
                        +'<img src="'+ productsJSON.images[3] +'" class="smaller-product-image-image" onclick="image(this)">'
                    +'</div>'
                +'</nav>'
            +'</nav>'
            +'<h1>'+ productsJSON.name + '</h2>'
        +'</nav>'
        +'<nav class="details-and-add-to-cart">'
            +'<nav class="manufacturer">'
                +'<h2>Manufacturer: '+ productsJSON.product_information.Manufacturer +'</h2>'
                +'<h2>id: '+ productsJSON.product_information.ASIN +'</h2>'
            +'</nav>'
            +'<nav class="about">'
                +'<h3>About this product:<br>'+ cutData(productsJSON.small_description)+'</h3>'
            +'</nav>'
            +'<nav class="star-rating">'
                +'<h4>rating : '+ productsJSON.average_rating +'⭐</h4>'
            +'</nav>'
            +'<nav class="price">'
                +'<h4>price : '+ productsJSON.pricing +'</h4>'
            +'</nav>'
            +'<nav class="stock-availability">'
                +'<h5>'+ storeAvailability(productsJSON.availability_status)+'</h5>'
            +'</nav>'
            +'<a href="'+ productURL +'" class="link-to-product" target="_blank">'
                +'<nav class="link-container">'
                    +'<h6>amazon product link</h6>'
                +'</nav>'
            +'</a>'
            +'<nav class="add-to-cart" onclick="addtoCart()">'
                +'<h6>add to cart</h6>'
            +'</nav>'
        +'</nav>'
    +'</nav>';

    if(document.querySelector(".stock-availability h5") != null){
        if(document.querySelector(".stock-availability h5").innerHTML == "In stock")   document.querySelector(".stock-availability h5").style.color = "rgb(55, 150, 55)";
        else {document.querySelector(".stock-availability h5").style.color = "rgb(150, 55, 55)"};
    }
}

let cutData = function(description){    return description = description.replace("About this item", "");}

let storeAvailability = function(availability){
    if (availability.includes("In stock"))return "In stock";
    else return "Out of stock";
}

let searchFor = function(){
    let getUserKeyWords = document.getElementById("searchbar").value;

    if(getUserKeyWords == ""){  document.getElementById("searchbar").placeholder = "search cannot be empty!";   return;}
    else{  
        getUserKeyWords = getUserKeyWords.replace(" ", "%20");
        window.location.assign('product.php?search?q=' + getUserKeyWords);
    }
}

let getURL = function(newproductURL){   productURL = newproductURL;}

let getProductID = function(productLink){
    //"https://www.amazon.com/Purina-Friskies-Food-Poultry-Seafood/dp/B07NRC3B7K/ref=sr_1_3?keywords=pet+supplies&qid=1643114373&sr=8-3"
    let startIndex = productLink.indexOf("/dp/");
    let stopIndex = productLink.indexOf("/ref=sr_");
    if(startIndex == -1 || stopIndex == -1) return "";
    let pid = productLink.substring(startIndex, stopIndex);
    pid = pid.replace("/dp/", "");
    return pid;
}

let addtoCart = function(){
    if(addedToCart == true)return;
    //use async javascript to add to cart session in php
    let cartObj = {imageURL: productsJSON.images[0], name: productsJSON.name, Produrl: productURL
        , ID: getProductID(productURL), rating: productsJSON.average_rating
        , price: productsJSON.pricing, availability: storeAvailability(productsJSON.availability_status)};

    cartObj = JSON.stringify(cartObj);
    let requestType = "productObject=" + cartObj;
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function (){
        specifyAddedToCart();
        addedToCart = true;
    };
    
    xmlhttp.open("POST", "sessionVarMNGR.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(requestType);
}

let specifyAddedToCart = function(){    
    document.querySelector(".add-to-cart h6").innerHTML = "added to cart ☑️";
    document.querySelector(".add-to-cart").className = "checked-add-to-cart";
}