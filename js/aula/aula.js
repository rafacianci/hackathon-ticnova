$(function() {
    $("#bt-editar-aula").on("click", function(e) {
        var fd = new FormData();
        fd.append("idAula", $("#idAula").attr('value'));
        fd.append("data", $("#data").attr('value'));
        fd.append("titulo", $("#titulo").attr("value"));
        $.ajax({
            url: "/queryAjax.php",
            data: fd,
            type: "POST",
            processData: false, // tell jQuery not to process the data
            contentType: false   // tell jQuery not to set contentType
        }).success(function(msg) {
            console.log(msg);
        }).error(function(e) {
            console.log("erro:" + e);
        })
    })
});
