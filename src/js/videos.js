$(function() {
    $(this).on("scroll", function() {
        if ((this.documentElement.scrollTop + this.documentElement.clientHeight - this.documentElement.scrollHeight) > -100) {
            requestAjax();  //si on arrive en bas de page requete ajax pour get des nouveaux album
        }
    });
    requestAjax();
    
});
var from = 0;
function requestAjax() {
    console.log("Ajax request...");
    if (playlist == undefined )
        playlist = "PLfXkEVCWgVVPhmTX3wLc7QhR6gXmxTQUZ";

    $.ajax({
        url: "/src/html/ajax/request_yt_ajax.php",
        type: "GET",
        data: "from=" + from + "&playlist=" + playlist,   //a partir de ou il faut get les photos
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $(document).unbind("scroll");   //on desactive l'evenement pour pas que yen ai plusieurs en mm temos
            $(".ajax_status").show();   //on affiche le rond de chargement
        },
        complete: function(xhr, result) {
            console.log(result);
        },
        success: function(data) {
            $(".ajax_status").hide();   //on cache le rond
            if(data === "no data")
                $(document).unbind("scroll");   //si ya plus rien on desactive l'evenement
            else {
                $(".ajax_status").prev().append(data); //on affiche les albums
                $(".title_video").click(dispVideo);
                from += 4;  //on ajoute l'echelle a l'offset
                $(document).delay(2000).on("scroll", function() { //on attend avant de reactiver l'event pour pas que sa foire
                    if ((this.documentElement.scrollTop + this.documentElement.clientHeight - this.documentElement.scrollHeight) > -100) {
                        requestAjax();
                    }
                });
                $("#text > a").hover(
                    function() {    //effet sur les articles a ajouter apres
                        $(this).children().first().css("color", "whitesmoke");
                    },
                    function() {
                        $(this).children().first().removeAttr('style');
                    }
                )
            }
        }
    });
}
function dispVideo() {
    hideOthersVideos();
    console.log($(window).width());
    if ($(window).width() > "800") {
        $(this).parent().css("height", "600px");
    } else {
        $(this).parent().css("height", "435px");
    }
    $(this).siblings().css("opacity", 1);
}
function hideOthersVideos() {
    $(".disp_video").css("height", "71px");
    $(".video_frame").css("opacity", 0);
}