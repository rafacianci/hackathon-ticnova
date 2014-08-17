var aula = function() {
    return {
        init: function() {
            aula.click();
        },
        click: function() {
            $("#bt-editar-aula").on("click", function() {
        var fd = new FormData();
        fd.append("idAula", $("#idAula").val());
        fd.append("data", $("#data").val());
        fd.append("titulo", $("#titulo").val());
                fd.append("tipo", $(this).attr("data-type"));
                aula.ajaxContent(fd);
            });

            $("#bt-cadastrar-aula").on("click", function() {
                var fd = new FormData();
                fd.append("data", $("#data").val());
                fd.append("titulo", $("#titulo").val());
                fd.append("tipo", $(this).attr("data-type"));
                aula.ajaxContent(fd);
            });



        },
        ajaxContent: function(fd) {
        $.ajax({
            url: "/queryAjax.php",
            data: fd,
            type: "POST",
            processData: false, // tell jQuery not to process the data
            contentType: false   // tell jQuery not to set contentType
        }).success(function(msg) {
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

