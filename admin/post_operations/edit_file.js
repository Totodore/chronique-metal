String.prototype.stripSlashes = function () {
    return this.replace(/\\(.)/mg, "$1");
};
$(function() {
    tinymce.init({ //On initialise l'éditeur de texte
        selector:'.edit_text',
        plugins: "autoresize autolink autoresize image imagetools fullscreen textcolor colorpicker wordcount link lists code", //PLugins
        toolbar: "forecolor backcolor | link | bold italic underline | alignleft aligncenter alignright alignjustify | formatselect fontselect fontsizeselect | cut, copy, paste | bullist, numlist, | outdent, indent | image | fullscreen", //Ce qui est affiché dans la toolbar
        content_css: "../../src/css/editor.css",
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
    $(attr).each(function() {
        $('.attr').append("<option>" + this + "</option>");
    });
    $(".choose_edit").submit(function(e) {
        e.preventDefault();
        var type = $(".attr").val();    //On recup l'attribut de la table
        $(this).fadeOut();  //On cache le premier form  
        $('.type').val(type);   //On attribue le type au nouveau form
        $(".edit_input").val(table[type]);
        $(".edit_title").html("Edition de la propriété : " + type);
        if (type == "text") {
            $(".edit_text").html(table[type]);  
            $(".wrapper_editor").css("display", "block");
            tinymce.activeEditor.setContent(table['text'].stripSlashes());
        }
        else
            $(".edit_input").show();
        $(".edit").fadeIn();
    });
    $('.edit').submit(function(e) {
        e.preventDefault();
        var dataForm = new FormData(this);
        dataForm.append("content_text", tinymce.activeEditor.getContent());
        console.log(tinymce.activeEditor.getContent());
        $.ajax({
            url: "edit_file_ajax.php",
            type: "POST",
            data: dataForm,
            dataType: 'text',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                console.log("Fichiers en cours d'envoi");
            },
            error: function (request, error) {
                console.log(request);
                alert(" Can't do because: " + error);
            },
            success: function(data) {
                // console.log(data);
                $(".edit").fadeOut();
                $(".status").html(data);
                $(".status").after("<p>Tu devrais être redirigé dans pas longtemps^^</p>");
                setTimeout(() => {
                   document.location.reload(); 
                }, 2000);
            }
        });
    });
});