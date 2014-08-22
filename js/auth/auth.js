var auth = function() {
    return {
        init: function() {
            $("#frmLogin").on("submit", function(e) {
                e.preventDefault();
                var fd = new FormData(this);
                fd.append('tipo', 'login');
                $.ajax({
                    url: '../queryAjax.php',
                    data: fd,
                    type: "post",
                    contentType: false,
                    processData: false
                }).success(function(data) {
                    data = JSON.parse(data);
                    window.location.hash = data.redirect;
                    var link = links.getUrl(data.redirect);
                    links.getPage(link.url, link.params, link.script);
                });
            });
        },
        login: function() {

        }
    };
}();