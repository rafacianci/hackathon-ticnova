var slides = function() {
    return {
        init: function() {
            slides.click();
        },
        click: function() {
            $("#bt-editar-slides").on("click", function() {
                var fd = new FormData();
                fd.append("idVideo", $("#idVideo").val());
                fd.append("titulo", $("#titulo").val());
                fd.append("url", $("#url").val());
                fd.append("tipo", $(this).attr("data-type"));
                slides.ajaxContent(fd);
            });

            $("#bt-cadastrar-slides").on("click", function() {
                var fd = new FormData();
                fd.append("titulo", $("#titulo").val());
                fd.append("tipo", $(this).attr("data-type"));
                slides.ajaxContent(fd);
            });
            
            $("#bt-cadastrar-imagens").on("click", function(){
                var fd = new FormData();
                fd.append("url", $("#url").val());
                fd.append("idSlide", $(this).attr("data-id"));
                fd.append("tipo", $(this).attr("data-type"));
//                console.log(fd);
                slides.ajaxContent(fd);
                
            })

        },
        ajaxContent: function(fd) {
            $.ajax({
                url: "/queryAjax.php",
                data: fd,
                type: "POST",
                processData: false, // tell jQuery not to process the data
                contentType: false   // tell jQuery not to set contentType
            }).success(function(msg) {
                console.log(msg);
                try {
                    data = JSON.parse(msg);
                    if (data.redirect) {
                        window.location.hash = data.redirect;
                        var link = links.getUrl(data.redirect);
                        links.getPage(link.url, link.params, link.script);
                    }
                } catch (e) {
                    alert("Erro: " + data);
                }
            }).error(function(e) {
                console.log("erro:" + e);
            });
        }
    };
}();

