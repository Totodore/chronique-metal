$(function() {
    requestAjax();
    $(this).on("scroll", function() {
        if ((this.documentElement.scrollTop + this.documentElement.clientHeight - this.documentElement.scrollHeight) > -100) {
            requestAjax();  //si on arrive en bas de page requete ajax pour get des nouveaux album
        }
    });
});
var wrapperDisplayed = 0;
var slideIndex = 1; //index de la prochaine image
var displayed = undefined;  //index de l'image actuellement affiche
function requestAjax() {
    console.log("Ajax request...");
    $.ajax({
        url: "/src/html/ajax/photos_ajax.php",
        type: "GET",
        data: "from=" + wrapperDisplayed,   //a partir de ou il faut get les photos
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
            if(data === "no photos")
                $(document).unbind("scroll");   //si ya plus rien on desactive l'evenement
            else {
                $(".ajax_status").before(data); //on affiche les albums
                $("#wrapper_photos").ready(postAjax()); //si tout est pres on lance la fonction de gestion des albums
                wrapperDisplayed += 3;  //on ajoute 3 a l'offset
                $(document).delay(2000).on("scroll", function() { //on attend avant de reactiver l'event pour pas que sa foire
                    if ((this.documentElement.scrollTop + this.documentElement.clientHeight - this.documentElement.scrollHeight) > -100) {
                        requestAjax();
                    }
                });
            }
        }
    });
}
function postAjax() {
    $(".slider").each(function() {
        var total = $(this).find('img').length;
        $(this).find('img').each(function(index) {
            $(this).prev().html(String(index + 1) + " / " + String(total)); //Pour chaque image on donne un numero
        });
        var thumbnails = $(this).next().next().find('li');  //on recup les thumbnails
        if (thumbnails.length > 6) {    //si il y en a plus que 7
            for (var i = 0; i <= 6; i++) {  //on affiche seulement 7 thumnails
                $(thumbnails[i]).css("width", "14.7%");
            }
        }
    })
    $(".slider").hover(
        function() {
            $(this).find(".number_text").css("color", "red");  //indic d'image rouge
            $(this).next().find("a").css("color", "red");   //on recup les fleches de nav
            $(this).next().css("color", "red"); //on 
        },
        function() {
            $(this).find(".number_text").css("color", "");
            $(this).next().find("a").css("color", "");
            $(this).next().css("color", "");
        }
    );
}
function changeSlide(n, caller) {
    showSlides(slideIndex += n, caller);    //quand on change d'image avec les fleches
}
function currentSlide(n, caller) {
    showSlides(slideIndex = n, caller); //quand on change d'image avec les thumbnails
}
function showSlides(n, caller) {
    var slider = $(caller).parent().parent().find(".slider");   //on recup le slider de celui qui a appele la fonction
    var photos = slider.find("img");    //on trouve les images
    var indicators = slider.find(".number_text");   //on recup les indicateurs
    var thumbnails = slider.next().next().find("li");  //on recup toutes les miniatures
    var displayed_thumbnails = [];
    var to_disp_thumbnails = [];
    photos.each(function(index) {
        if ($(this).css("display") === "inline")    //on trouve l'image actuellement affiche
            displayed = index;
    });
    if (n > photos.length)  //si l'index depasse le nombre d'image on repart a la premiere
        slideIndex = 1;
    if (n < 1)
        slideIndex = photos.length;  //si l'index est plus petit que 1 on part a la derniere
    for (i = 0; i < 7; i++) {
        displayed_thumbnails.push(i + displayed);    //on recup toutes les anciennes miniatures affiches 
    }
    for (i = 0; i < 7; i++) {
        to_disp_thumbnails.push(i + slideIndex - 1);    //on prend la miniature qui va etre affiche et on en rajoute 6 autre
    }
    if (to_disp_thumbnails[6] < thumbnails.length) { //on s'arrange pour que si on arrive a la fin ca ne bouge plus les miniats
        displayed_thumbnails.forEach(element => {
            $(thumbnails[element]).css("width", "0"); //on desaffiche les anciennes
        });
        to_disp_thumbnails.forEach(element => {
            $(thumbnails[element]).css("width", "100%");  //et on affiche les nouvelles
        });
    }
    $(indicators[displayed]).fadeOut("200", function() { //on cache l'ancien indicateur
        $(indicators[slideIndex - 1]).fadeIn("200"); //on affiche le nouvel indicateur
    }); 
    $(photos[displayed]).fadeOut("200", function() { //on cache la photo precedement affichee
        $(photos[slideIndex - 1]).fadeIn("200"); //et on affiche celle de l'index
    });  
    $(thumbnails[displayed]).css("filter", "none"); //on cache l'ancienne miniature
    $(thumbnails[slideIndex - 1]).css("filter", "blur()");    //on affiche la nouvelle miniature
}

// !!! MODAL !!! //
function openModal(caller) {
    $("#viewer").fadeIn(300, function() {
        $("#overlay").css("z-index", 500);      //overlay entre les deux couches
        $("#overlay").css("background-color", "rgba(0,0,0, 0.3)");  //legerement plus sombre
        $("#viewer").css("z-index", 1000);  //modal par dessus toutes les couches
        var viewer = $(caller).parent().parent().clone(); //on clone le slider
        $("#viewer").append(viewer.children());    //pour l'inserer dans le viewer
        $("#viewer").find(".openModal").replaceWith('<i class="material-icons openModal" onclick="closeModal()">close</i>');    //on remplace l'icone ouvrir en plus grand par une croix
        $("#viewer").find(".indicators").css("color", "white"); //on le met en blanc
        $(".slider").hover(
            function() {
                $("#viewer").find(".slider").find("span").css("color", "red");
                $("#viewer").find(".indicators").css("color", "red");
                $("#viewer").find(".next").css("color", "red"); //on est oblige de faire precisement si on veut override le truc
                $("#viewer").find(".prev").css("color", "red");
            },
            function() {
                $("#viewer").find(".slider").find("span").css("color", "");
                $("#viewer").find(".indicators").css("color", "white");
                $("#viewer").find(".next").css("color", ""); //on est oblige de faire precisement si on veut override le truc
                $("#viewer").find(".prev").css("color", "");
            }
        );
        $($("#viewer").find(".row_thumbmails").find("img")).hover(
            function() {
                $(this).css("filter", "brightness(50%)"); //plus somnre quand on survol les thumbnails
            },
            function() {
                $(this).css("filter", "");
            }
        );    
        $("#overlay").click(function() {
            closeModal();
        });
    });
}
function closeModal() {
    $("#viewer").fadeOut(300, function() {
        $("#overlay").removeAttr("style");  //on degage tout ce qu'on a cree precedemment
        $("#viewer").removeAttr("style");
        $("#viewer").children().remove();   //et on degage le clone de slider
    })
}