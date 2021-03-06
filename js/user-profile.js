function hideDisable(element) {
    element
        .hide()
        .prop('disabled', true);
}

function showActivate(element) {
    element
        .show()
        .prop('disabled', false);
}

$(document).ready(function() {

    if ($('#modifyData').click(function () {
        hideDisable($('#modifyData'));
        showActivate($('#cancelData'));
        showActivate($('#submitData'));

        $('#nome').prop("disabled", false);
        $('#cognome').prop("disabled", false);
        $('#compleanno').prop("disabled", false);
    })) ;

    if ($('#cancelData').click(function () {
        hideDisable($('#cancelData'));
        hideDisable($('#submitData'));
        showActivate($('#modifyData'));

        $('#nome').prop("disabled", true);
        $('#cognome').prop("disabled", true);
        $('#compleanno').prop("disabled", true);
    })) ;


    // buttons login form
    if ($('#modifyLog').click(function () {
        hideDisable($('#modifyLog'));
        showActivate($('#cancelLog'));
        showActivate($('#submitLog'));

        $('#email').prop("disabled", false);
    })) ;

    if (!$('#cancelLog').click(function () {
        hideDisable($('#cancelLog'));
        hideDisable($('#submitLog'));
        showActivate($('#modifyLog'));

        $('#email').prop("disabled", true);
    })) {
        return;
    }




    let choice = document.querySelector("#choice");

    if(choice != null){
        choice.addEventListener("change", () => {
            let pay = document.querySelector("#paypal");
            let credit = document.querySelector("#creditCard");


            if(choice.value === "0") {
                pay.style.display = "block";
                credit.style.display = "none";
            }
            else {
                pay.style.display = "none";
                credit.style.display = "block";
            }
        });
    }

    // Popup

    if($('.request').click(function(){
        $('aside#requestForm').css("display", "block");
        $('aside#reviewForm').css("display", "none");
    }));

    if ($('button#closeRequest').click(function(){
        $('aside#requestForm').css("display", "none");
    }));


    if($('.review').click(function(){
        $('aside#reviewForm').css("display", "block");
        $('aside#requestForm').css("display", "none");
    }));

    if ($('button#closeReview').click(function(){
        $('aside#reviewForm').css("display", "none");
    }));




    $("#rating-1").click(function(){
        $(this).addClass("checked");
        $("#rating-2").removeClass("checked");
        $("#rating-3").removeClass("checked");
        $("#rating-4").removeClass("checked");
        $("#rating-5").removeClass("checked");
    });

    $("#rating-2").click(function(){
        $("#rating-1").addClass("checked");
        $(this).addClass("checked");
        $("#rating-3").removeClass("checked");
        $("#rating-4").removeClass("checked");
        $("#rating-5").removeClass("checked");
    });

    $("#rating-3").click(function(){
        $("#rating-1").addClass("checked");
        $("#rating-2").addClass("checked");
        $(this).addClass("checked");
        $("#rating-4").removeClass("checked");
        $("#rating-5").removeClass("checked");
    });

    $("#rating-4").click(function(){
        $("#rating-1").addClass("checked");
        $("#rating-2").addClass("checked");
        $("#rating-3").addClass("checked");
        $(this).addClass("checked");
        $("#rating-5").removeClass("checked");
    });

    $("#rating-5").click(function(){
        $("#rating-1").addClass("checked");
        $("#rating-2").addClass("checked");
        $("#rating-3").addClass("checked");
        $("#rating-4").addClass("checked");
        $(this).addClass("checked");
    });









        /* Pagina Messaggi*/


    $(".bin").click(function(){
        $(".inboxMail").hide();
        $(".binMail").show();
    });


    $(".inbox").click(function(){
        $(".binMail").css("display", "none");
        $(".inboxMail").show();
    });

});