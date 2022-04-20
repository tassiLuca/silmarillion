const UPLOAD_DIR_PRODUCTS = "./upload/products/";

$(document).ready(function(){

    var pressedBtn = false;

    /* Menu button clicked */
    $("body > header > nav > ul > li:first-of-type > button").click(function(){
        toggleNavbar($(this), $("body > header > nav > div#navMenu"));
    });

    /* Cart button clicked */
    $("body > header > nav > ul > li:last-of-type > button").click(function(){
        toggleNavbar($(this), $("body > header > nav > div#navCart"));
    });

    /* Login button clicked */
    $("body > header > nav > ul > li:nth-last-of-type(2) > button").click(function(){
        toggleNavbar($(this), $("body > header > nav > div#navLogin"));
    });

    /* Search button clicked */
    $("body > header > nav > ul > li:nth-last-of-type(3) > button").click(function(){
        toggleNavbar($(this), $("body > header > nav > div#navSearch"));
    });

    $("html > body > main").click(function(){
        closePopupOpen();
        //$("main").css("opacity", "1.0");
    });

    refreshCartNavbar();

});

function closePopupOpen(){
    /* if a popup was already opened, close it */
    $("body > header > nav > ul > li > button.navActive").removeClass("navActive");
    $("body > header > nav > div.active").slideUp();
    $("main").css("opacity", "1.0");
}

/**
 * Toggle one element of navbar
 * @param {*} btnPressed the navbar button which has been pressed
 * @param {*} elementToSlide the section of page to show
 */
function toggleNavbar(btnPressed, elementToSlide){
    if (!btnPressed.hasClass("navActive")) {
        closePopupOpen();
        /* add the class navActive in order to color the button pressed */
        btnPressed.addClass("navActive");
        elementToSlide.addClass("active");
        elementToSlide.slideDown();
        /* add opacity to the main page */
        $("main").css("opacity", "0.2");
    } else {
        btnPressed.removeClass("navActive");
        elementToSlide.removeClass("active");
        elementToSlide.slideUp();
        /* restore the opacity of the main page */
        $("main").css("opacity", "1.0");
    }
}

function refreshCartNavbar(){
    let htmlNavBarCart = "";
    let amountProds = 2;
    $("#navCart > ul > p").remove();
    $("#navCart > ul > li").remove();

    $.post("./engines/process-cart.php?request=getCart", function (data) {
        //console.log(data);
        cart = JSON.parse(data);

        if(cart.length > 0){
            for(let i = cart.length-1; i >= 0 && i > cart.length-amountProds-1;i--){
                let prod = cart[i];

                price = prod['DiscountedPrice'] !==null ? prod['DiscountedPrice'] : prod['Price'];
                htmlNavBarCart += `
                    <li>
                        <img src="`+UPLOAD_DIR_PRODUCTS+prod['CoverImg']+`" alt="">
                        <div>
                            <p>`+prod['Title']+`</p>
                            <div>
                                <p>`+price+` €</p>
                                <p>x`+prod["Quantity"]+`</p>
                            </div>
                        </div>
                    </li>`;
            }
        }
        else{
            htmlNavBarCart += "<li>Carrello vuoto</li>";
        }
        
        $("#navCart > ul").append(htmlNavBarCart);
    });

   
    
}