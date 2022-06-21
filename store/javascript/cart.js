window.onload = function(){
    let data = window.sessionStorage.getItem("getSessiondarkModeLightMode");
    if(data == "dark" || data == "light"){
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
        document.querySelector(".trolley").style.boxShadow = "35px 35px 70px #272727,-35px -35px 70px #353535";
        document.querySelector(".trolley").style.background = "#2e2e2e";
        document.querySelector(".checkout").style.boxShadow = "35px 35px 70px #272727,-35px -35px 70px #353535";

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
        document.querySelector(".trolley").style.boxShadow = "35px 35px 70px #c9c9c9,-35px -35px 70px #ffffff";
        document.querySelector(".trolley").style.background = "#ededed";
        document.querySelector(".checkout").style.boxShadow = "35px 35px 70px #c9c9c9,-35px -35px 70px #ffffff";

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

let cartPriceTotal = 0;
let cartItemsJson;

let collectCartJsonData = function(phpCartJson){
    /*imageURL: productsJSON.images[0], name: productsJSON.name, Produrl: productURL
        , ID: productsJSON.product_information.ASIN, rating: productsJSON.average_rating
        , price: productsJSON.pricing, availability: storeAvailability(productsJSON.availability_status*/
    cartItemsJson = phpCartJson;
    console.log(cartItemsJson);
    let cartItems = document.querySelector(".items");
    for(let i = 0; i < cartItemsJson.length; ++i){
        let product_ID = "'"+ cartItemsJson[i].ID +"'";
        cartItems.innerHTML = cartItems.innerHTML 
        +'<nav class="item '+ cartItemsJson[i].ID +'">'
            +'<nav class="item-description">'
                +'<nav class="product-img">'
                    +'<div class="img-class">'
                        +'<img src="'+ cartItemsJson[i].imageURL +'" class="product-image-image">'
                    +'</div>'
                +'</nav>'
                +'<nav class="product-desc">'
                    +'<h2 onclick="setURL('+ product_ID +')">'+ cartItemsJson[i].name +'</h2>'
                    +'<h3>product id: '+ cartItemsJson[i].ID +'<br>'
                        +'rating: '+ cartItemsJson[i].rating +'⭐<br>'
                        +'availability: '+ cartItemsJson[i].availability +'<br>'
                    +'</h3>'
                +'</nav>'
            +'</nav>'
            +'<nav class="item-price">' 
                +'<h2>'+ cartItemsJson[i].price +'</h2>'
            +'</nav>'
            +'<nav class="delete-item">'
                +'<nav class="item-logo" onclick=deleteItem('+ product_ID +')>'
                    +'<img src="../svgfolder/trash-outline.svg" alt="deletelogo" id="deleteID">'
                +'</nav>'
            +'</nav>'
        +'</nav>';
        cartPriceTotal += getIntPrice(cartItemsJson[i].price);
    }
    updateSummarySection();
}

let getIntPrice = function(stringD){
    stringD = stringD.replace("$", "");
    stringD = stringD.replace(",", "");
    return parseFloat(stringD);
}

let updateSummarySection = function(){
    let taxTotal = 0.2*cartPriceTotal;
    let overallTotal = cartPriceTotal + taxTotal;
    document.querySelector(".checkout h2").innerHTML = "cart total $" + cartPriceTotal;
    document.querySelector(".checkout h5").innerHTML = "shipping expense $" + taxTotal;
    document.querySelector(".checkout h3").innerHTML = "grand total $" + overallTotal;
}

let setURL = function(productID){
    let productURLL = "";
    for(let i = 0; i < cartItemsJson.length; ++i){
        if(cartItemsJson[i].ID == productID){
            productURLL = cartItemsJson[i].Produrl;
            break;
        }
    }
    if(productURLL == ""){
        alert("cannot find product url");
        deleteItem(productID);
        return;
    }

    let requestType = "setProductLink=" + productURLL;
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function (){
        window.location.assign('productDetails.php?search?q=' + productID);
    };

    xmlhttp.open("POST", "sessionVarMNGR.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(requestType);
}

let deleteItem = function(prodIdd){
    document.querySelector("." + prodIdd).remove();

    for(let i = 0; i < cartItemsJson.length; ++i){
        if(cartItemsJson[i].ID == prodIdd){
            cartItemsJson.splice(i, 1);
            break;
        }
    }

    cartItemsJson = JSON.stringify(cartItemsJson);
    let requestType = "replaceArray=" + cartItemsJson;
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function (){
        
    };
    
    xmlhttp.open("POST", "sessionVarMNGR.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(requestType);
}