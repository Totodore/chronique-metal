$(function() {
    tinymce.init({ //On initialise l'éditeur de texte
        selector:'.text',
        plugins: "autoresize autolink autoresize image imagetools fullscreen textcolor colorpicker wordcount link lists code", //PLugins
        toolbar: "forecolor backcolor | link | bold italic underline | alignleft aligncenter alignright alignjustify | formatselect fontselect fontsizeselect | cut, copy, paste | bullist, numlist, | outdent, indent | image | fullscreen", //Ce qui est affiché dans la toolbar
        content_css: "https://chronique-metal.fr/src/css/editor.css",
        image_advtab: true, //On autorise les options avancées pour les images
        image_caption: true, //On autorise les legendes pour les images.
        images_upload_url: 'img_upload.php',
        convert_urls: false,
        images_upload_handler: function(blobInfo, success, failure) {
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
    $(".form_edit").submit(function(e) {
        e.preventDefault();
        console.log("Sending Form...");
        $.ajax({
            url: "add_file_ajax.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            xhr: function(){
                // get the native XmlHttpRequest object
                var xhr = $.ajaxSettings.xhr() ;
                // set the onprogress event handler
                xhr.upload.onprogress = function(evt) { 
                    $("progress").show();
                    console.log('progress', evt.loaded/evt.total*100) 
                    $("progress").val(evt.loaded/evt.total*100);
                    if (evt.loaded/evt.total*100 == 100)
                        $(".status").html("Décompresion des donnees...");
                };
                // return the customized object
                xhr.onreadystatechange = function(event) {
                    if (this.readyState === XMLHttpRequest.DONE) {
                        if (this.status === 200) {
                            console.log("Réponse reçue: %s", this.responseText);
                            $(".status").html(this.responseText);
                        } else {
                            console.log("Status de la réponse: %d (%s)", this.status, this.statusText);
                            $(".status").html("Erreur lors de la requête au serveur : " + this.status + this,statusText);
                        }
                    }
                    $("progress").hide();
                    $("form").get(0).reset();
                }
                return xhr ;
            }
        })
    })
});