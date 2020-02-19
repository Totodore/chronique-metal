$(function() {
    console.log(path);
    $.ajax({
        url: "https://chronique-metal.fr/",
        type: "GET",
        contentType: false,
        cache: false,
        processData: false,
        xhr: function () {
            // get the native XmlHttpRequest object
            var xhr = $.ajaxSettings.xhr();
            // set the onprogress event handler
            xhr.upload.onprogress = function (evt) {
                console.log('progress', evt.loaded / evt.total * 100);
                $("progress").val(evt.loaded / evt.total * 100);
                $(".text").text(evt.loaded / evt.total * 100 + "%");
            };
            // return the customized object
            xhr.onreadystatechange = function (event) {
                if (this.readyState === XMLHttpRequest.DONE) {
                    if (this.status === 200) {
                        console.log("Réponse reçue: %s", this.responseText);
                    } else {
                        console.log("Status de la réponse: %d (%s)", this.status, this.statusText);
                    }
                }
            };
            return xhr;
        }
    });
});