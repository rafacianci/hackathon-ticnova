$(function() {
    $("#bt-editar-aula").on("click", function(e) {
        var fd = new FormData();
        fd.append("idAula", $("#idAula").val());
        fd.append("data", $("#data").val());
        fd.append("titulo", $("#titulo").val());
        fd.append("tipo", "editarAula");
//        console.log(fd);
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
                if (data.error) {
//                    alert(data.error);
                } else {
                    window.location.hash = data.redirect;
                    var link = links.getUrl(data.redirect);
                    links.getPage(link.url, link.params);
                }
            } catch (e) {
                alert("Erro: " + data);
            }
        }).error(function(e) {
            console.log("erro:" + e);
        })
    })
});
