// !!! Global Var !!! //
var progressBar;
var wrapperData = Array();
var player;

// !!! On page load !!! //
$(function() {
    $.get("/src/html/ajax/radio_video_ajax.php", (data) => {
        $(".ajax_status").fadeOut(100);
        $("#disp_videos").append(data);
        $("#disp_videos").children().last().fadeIn(400);
    }).fail(() => {
        $(".ajax_status").fadeOut(100);
        $("#disp_videos").append("<div id=error_radio><span class=error_title>Une erreur est apparue lors de la récupération des vidéos</span></div>");
    });
});

// !!!! MODAL !!!!!!//
function openModal() {  
    
    $("#overlay").css("z-index", 500);      //overlay entre les deux couches
    $("#overlay").css("background-color", "rgba(0,0,0, 0.3)");  //legerement plus sombre
    
    $("#modal_discord").append('<iframe class="discord_embed" src="https://discordapp.com/widget?id=313283319330504706&theme=dark" allowtransparency="true" frameborder="0">');
    $("#modal_discord").css("z-index", 1000);
    $("#modal_discord").css("top", "50%"); //on fait remonter le viewer
    $("#overlay").click(function() {    //si on clique ailleur ca ferme
        closeModal();
    });
}
function closeModal() {
    $("#overlay").removeAttr("style");  //on degage tout ce qu'on a cree precedemment
    $("#modal_discord").removeAttr("style");
    $("#modal_discord").children().remove();   //et on degage le clone de slider
}