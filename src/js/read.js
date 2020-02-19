$(function () {
    $(this).on("scroll", function () {
        if ((this.documentElement.scrollTop + this.documentElement.clientHeight - this.documentElement.scrollHeight) > -100) {
            requestAjax(); //si on arrive en bas de page requete ajax pour get des nouveaux album
        }
    });
    requestAjax();
    $(".form_comment").submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        data.append("article_id", article_id);
        data.append("article_type", article_type);
        data.append("class", $("#disp_comments").children().first().attr("class"));
        console.log("Ajax request...");
        $.ajax({
            url: "/src/html/ajax/add_comment_ajax.php",
            type: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $(".form_content").fadeOut(100)
                $(".ajax_status_form").fadeIn(100); //on affiche le rond de chargement
            },
            complete: function (xhr, result) {
                console.log(result);
            },
            success: function (data) {
                $(".ajax_status_form").fadeOut(100); //on cache le rond
                $(".form_comment")[0].reset(); //On clean le formulaire
                closeModal();   //On ferme la fenêtre modale
                $(".form_comment").show();  //On raffiche le formulaire
                $("#disp_comments").prepend(data);
            }
        });
    });

});
var from = 0;

function requestAjax() {
    console.log("Ajax request...");
    $.ajax({
        url: "/src/html/ajax/get_comment_ajax.php",
        type: "GET",
        data: "from=" + from + "&article_id=" + article_id + "&type=" + article_type, //a partir de ou il faut get les comments
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $(document).unbind("scroll"); //on desactive l'evenement pour pas que yen ai plusieurs en mm temos
            $(".ajax_status").show(); //on affiche le rond de chargement
        },
        complete: function (xhr, result) {
            console.log(result);
        },
        success: function (data) {
            $(".ajax_status").hide(); //on cache le rond
            if (data === "no data")
                $(document).unbind("scroll"); //si ya plus rien on desactive l'evenement
            else {
                $("#disp_comments").append(data); //on affiche les albums
                from += 10; //on ajoute l'echelle a l'offset
                $(document).delay(2000).on("scroll", function () { //on attend avant de reactiver l'event pour pas que sa foire
                    if ((this.documentElement.scrollTop + this.documentElement.clientHeight - this.documentElement.scrollHeight) > -100) {
                        requestAjax();
                    }
                });
                //Penser a ajouter les effets sur les nouveaux coms
            }
        }
    });
}
function openModal() {
    $("#overlay").css("z-index", 500); //overlay entre les deux couches
    $("#overlay").css("background-color", "rgba(0,0,0, 0.3)"); //legerement plus sombre
    $("#wrapper_comment").css("z-index", 1000);
    $("#wrapper_comment").css("top", "50%"); //on fait remonter la fenetre modale
    $("#overlay").click(function () { //si on clique ailleur ca ferme
        closeModal();
    });
}

function closeModal() {
    $("#overlay").removeAttr("style"); //on degage tout ce qu'on a cree precedemment
    $("#wrapper_comment").removeAttr("style");
}