var grupo = function() {
    return {
        init: function() {
            grupo.click();
        },
        click: function() {
            $("#bt-editar-grupo").on("click", function() {
                var fd = new FormData();
                fd.append("idGrupo", $("#idGrupo").val());
                fd.append("titulo", $("#titulo").val());
                fd.append("tipo", $(this).attr("data-type"));
                grupo.ajaxContent(fd);
            });

            $("#bt-cadastrar-grupo").on("click", function() {
                var fd = new FormData();
                fd.append("titulo", $("#titulo").val());
                fd.append("tipo", $(this).attr("data-type"));
                grupo.ajaxContent(fd);
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

