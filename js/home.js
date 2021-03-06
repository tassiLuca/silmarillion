/* jquery che nasconde tutti i banner  tranne il primo*/

$(document).ready(function () {
    $("main > section:first-child > div.banner").hide();
    $("main > section:first-child > div.banner:first-child").show();

    updateAll(0);
    showSlide(infoidx);
    
    $(window).resize(function () { 
        updateAll(0);
    });

    var sizeInfoBanner = $("main > aside > div:first-child > div.infoBanner").length;
    autoSlide();
    function autoSlide(){
        infoidx++;
        if(infoidx > sizeInfoBanner){
        infoidx = 1;
        }
        showSlide(infoidx);
        setTimeout(autoSlide, 5000);
    }

});

function updateAll(n){
    var sections = ['newArrival','manga','hero','funko'];
    sections.forEach(element => {
        updateComic(element,0);
    });
    updatePartner(0);
    updateReview(0);
}

var slideIndex = 1;

function updateBanner(n) {
  showDivs(slideIndex += n,"main > section:first-child > div",1);
}

function updatePartner(n) {
  showDivs(slideIndex += n,"main > section:last-child > div > div > a",checkScreenSize(200,0.01));
}

function updateReview(n) {
  showDivs(slideIndex += n,"main > section.review > div > article",checkScreenSize(420,0.05));
}

function updateComic(category,n){
  showDivs(slideIndex += n,"main > section."+category+" > div > article",checkScreenSize(240,0.04));
}

function checkScreenSize(elemWidth,percMargin){
    var w = window.innerWidth;
    var quantity = Math.floor((w-(0.20*w))/(elemWidth+(w*percMargin*2)));
    return quantity <= 0 ? 1 : quantity;
}

function showDivs(n,slider,slideToShow) {
    var x = $(slider);
    var maxIdxBlock = x.length/slideToShow; //max index of slides group
    
    if(n > maxIdxBlock){
        slideIndex=maxIdxBlock;
    }
    if(n < 1){
        slideIndex=1;
    }
    
    x.hide();
    
    var start=(slideIndex*slideToShow)-slideToShow;
    if(start < 0){
        start=0;
    }
    for(k=start;k<x.length && k < slideIndex*slideToShow ; k++){
        x[Math.round(k)].style.display = "inline-block";
    }
}

var infoidx = 1;
/* Aside banner */
function showSlide(n){
    infoidx = n;
    $("main > aside > div:first-child > div.infoBanner").hide();
    $("main > aside > div:first-child > div.infoBanner:nth-child("+n+")").show();

    /*dot indicator */
    $("main > aside > div:last-child > div").removeClass("current");
    $("main > aside > div:last-child > div:nth-child("+n+")").addClass("current");
}