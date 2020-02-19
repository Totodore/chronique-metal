String.prototype.stripSlashes = function () {
    return this.replace(/\\(.)/mg, "$1");
};
function tiny_init() {
    tinymce.init({ //On initialise l'éditeur de texte
        selector:'.edit_text',
        plugins: "autoresize autolink autoresize image imagetools fullscreen textcolor colorpicker wordcount link lists code", //PLugins
        toolbar: "forecolor backcolor | link | bold italic underline | alignleft aligncenter alignright alignjustify | formatselect fontselect fontsizeselect | cut, copy, paste | bullist, numlist, | outdent, indent | image | fullscreen", //Ce qui est affiché dans la toolbar
        content_css: "https://chronique-metal.fr/src/css/editor.css",
        image_advtab: true, //On autorise les options avancées pour les images
        image_caption: true, //On autorise les legendes pour les images.
        images_upload_url: 'img_upload.php',
        convert_urls: false,
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', 'img_upload.php');

            xhr.onload = function () {
                var json;

                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.statusText);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                success(json.location);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        }
    });
}
function closeModal() {
    $("#modal_edit").hide();
    $("#modal_edit").children().first().remove();                    
    $("#modal_edit").removeAttr("style");
    $("#modal_edit").removeAttr("data-key");
    $("#modal_edit").off("click");
}
$(function() {
    $(".del").click(function() {
        $.get("./delete_file.php?id="+id+"&type="+type, function(data, textStatus) {
            $(".status").append(data);
            console.log(textStatus);
        });
    }); 
    $(".td").click(function() {
        var key = $(this).attr("data-key");
        console.log(key);
        if (key != "type" && key != "ID" && key != "image" && key != "photos_file" && key != "article_id") {
            if (key == "text") {
                $("#modal_edit").prepend('<div class="wrapper_editor"><textarea class="edit_text" name="content_text"></textarea></div><br />');
                $("#modal_edit").css("width", "95%").css("height", "95%");
                $("textarea").val(String(table[key]).stripSlashes());
                console.log(String(table[key]).stripSlashes());
                tiny_init();
            }
            else if (key == "date") {
                $("#modal_edit").prepend("<input type='date' value='" + table[key] +"'/><br />");
            }
            else if (key == "time_start" || key == "time_end") {
                $('#modal_edit').prepend("<input type='time' value='" + table[key] +"'/><br />");
            }
            else if (key == "email") {
                $('#modal_edit').prepend("<input type='email' value='" + table[key] + "'/><br />");
            }
            else if (key == "url" || key == "link") {
                $('#modal_edit').prepend("<input type='url' value='" + table[key] + "'/><br />");
            }
            else {
                $('#modal_edit').prepend("<input type='text' value='" + table[key] +"'/><br />");  
            }
            $("#modal_edit").attr("data-key", key);
            $("#modal_edit").show();
            $(".confirm").click(function() {
                var formData = new FormData();
                formData.append("type", type);
                formData.append("id", id);
                formData.append("attr", $("#modal_edit").attr("data-key"));
                if ($("#modal_edit").attr("data-key") == "text") {
                    formData.append("content_text", tinymce.activeEditor.getContent());
                    table['text'] = tinymce.activeEditor.getContent();
                    console.log(table['text']);
                }
                else {
                    formData.append("content_input", $("#modal_edit > input").val());
                    table[$("modal_edit").data("key")] = $("#modal_edit > input").val();
                }
                $.ajax({
                    type: 'POST',
                    url: './edit_file_ajax.php',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        $("td[data-key='"+$("#modal_edit").attr("data-key") + "']").html(data);
                        closeModal();
                    },
                    error: function () {
                        alert("Erreur lors de la sauvegarde des données XML");
                    }
                });
                
            });
            $(".cancel").click(function() {
                closeModal();
            });
        }
    });
});