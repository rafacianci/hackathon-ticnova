var quiz = function() {
    return {
        init: function() {
            quiz.click();
        },
        click: function() {
            $("#bt-editar-quiz").on("click", function() {
                var fd = new FormData();
                fd.append("idQuiz", $("#idQuiz").val());
                fd.append("titulo", $("#titulo").val());
                fd.append("tipoQuiz", $("#tipoQuiz").val());
                fd.append("tempo", $("#tempo").val());
                fd.append("tipo", $(this).attr("data-type"));
                quiz.ajaxContent(fd);
            });

            $("#bt-cadastrar-quiz").on("click", function() {
                var fd = new FormData();
                fd.append("titulo", $("#titulo").val());
                fd.append("tipoQuiz", $("#tipoQuiz").val());
                fd.append("tempo", $("#tempo").val());
                fd.append("tipo", $(this).attr("data-type"));
                quiz.ajaxContent(fd);
            });

            $("#bt-cadastrar-questionario").on("click", function() {
                var fd = new FormData();
                fd.append("titulo", $("#titulo").val());
                fd.append("correta", [$("#alternativa-correta").attr('data-id'), $("#alternativa-correta").val()]);
                fd.append("incorreta1", [$("#alternativa-incorreta1").attr('data-id'), $("#alternativa-incorreta1").val()]);
                fd.append("incorreta2", [$("#alternativa-incorreta2").attr('data-id'), $("#alternativa-incorreta2").val()]);
                fd.append("tipo", $(this).attr("data-type"));
                quiz.ajaxContent(fd);
            });

            $("#cadQuestaoquiz").on("submit", function(e) {
                e.preventDefault();
                var fd = new FormData($(this)[0]);
                fd.append("tipo", "cadastrarQuestaquiz");
                quiz.ajaxContent(fd);
            });

            $("#bt-editar-questaoquiz").on("click", function() {
                var fd = new FormData();
                fd.append("idQuestaoquiz", $("#idQuestaoquiz").val());
                fd.append("idQuiz", $("#idQuiz").val());
                fd.append("titulo", $("#titulo").val());
                fd.append($("#alternativa1").attr("data-id"), $("#alternativa1").val());
                fd.append($("#alternativa2").attr("data-id"), $("#alternativa2").val());
                fd.append($("#alternativa3").attr("data-id"), $("#alternativa3").val());
                fd.append("correta", $("#correta:checked").val());
                fd.append("tipo", $(this).attr("data-type"));
                quiz.ajaxContent(fd);
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
                    alert("Erro: " + e);
                }
            }).error(function(e) {
                console.log("erro:" + e);
            });
        }
    };
}();

