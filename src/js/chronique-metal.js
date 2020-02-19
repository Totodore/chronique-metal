$(function() {
    $("#overlay").click(function() {    //si on clique ailleur ca ferme
        closeModal();
    });
    $(".unsub").click(function() {
        console.log("tets");
        refuseNotif($(".mail_unsub").get(0).value);
    });
    $(".notif_form").submit(function(event) {
        event.preventDefault();
        console.log("Sending Form...");
        $.ajax({
            url: "/src/html/ajax/notif_ajax.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
            },
            success: function(data) {
                if (data == "false_email")
                    $('.return_data').html("Oups ! Il semblerait que cette adresse mail ait déjà été indiqué, veuillez en rentrer une autre pour pouvoir vous inscrire...");
                else {
                    $(".return_data").html(data);
                    setTimeout(function() {window.location.href = "/fr/"}, 5000);
                }
            }
        });
    });
    $(".news_el").hover(function() {
        $(this).find(".news_title").css("border-color", "#dd0322");
        $(this).find("i").css("color", "#dd0322");
    },
    function() {
        $(this).find(".news_title").removeAttr("style");
        $(this).find("i").removeAttr("style");
    });
    $("#display_partners a img").hover(function() {
        $("#display_partners a img").not(this).css("filter", "blur(1px)").css("box-shadow", "none");
    },
    function() {
        $("#display_partners a img").not(this).removeAttr("style");
    });
});
// !!!! NOTIF !!!!!!//
function openNotif() {  
    $("#ask_notif").css("transform", "translate(-50%, -100%)"); //on fait remonter le viewer
}
function openModalNotif() {
    $("#overlay").css("z-index", 500);      //overlay entre les deux couches
    $("#overlay").css("background-color", "rgba(0,0,0, 0.3)");  //legerement plus sombre
    $("#cred_modal").css("top", "50%"); //on fait remonter le viewer
}
function openUnsubModal() {
    $("#overlay").css("z-index", 500);      //overlay entre les deux couches
    $("#overlay").css("background-color", "rgba(0,0,0, 0.3)");  //legerement plus sombre
    $("#unsub_modal").css("top", "50%"); //on fait remonter le viewer
} 
function refuseNotif(unsuscribe) {
    if (unsuscribe == false) {
        $(document).load("/src/html/ajax/notif_ajax.php?accept=false");
        closeModal();
    }
    else {
        $(document).load("/src/html/ajax/notif_ajax.php?accept=false&email=" + unsuscribe, function(data) {
            console.log(data);
            if (data == "false_email")
                    $('.return_data').html("Oups ! Il semblerait que cette adresse mail ne soit pas enregistrée dans la base de donnée...");
                else {
                    $(".return_data").html(data);
                    setTimeout(function() {window.location.href = "/fr/"}, 5000);
                }
        });
    }
}
function closeModal() {
    $("#overlay").removeAttr("style");  //on degage tout ce qu'on a cree precedemment
    $("#cred_modal").removeAttr("style");
    $("#ask_notif").removeAttr("style");
    $("#unsub_modal").removeAttr("style");
}