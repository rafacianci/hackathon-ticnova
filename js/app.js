$(function() {
    links.init();

});

var links = function() {
    return {
        ajaxConfirm: function(link) {
            var req = links.getUrl(link);
            $.ajax({
                url: req.url,
                data: req.params
            }).success(function(data) {
                try {
                    data = JSON.parse(data);
                    if (data.error) {
                        alert(data.error);
                    } else {
                        alert(data.msg);
                        window.location.reload();
                    }
                } catch (e) {
                    alert("Erro: " + data);
                }
            }).error(function(data) {
                console.log('error', data);
            });
        },
        click: function() {
            $(".ajax").unbind('click').on('click', function() {
                var file = $(this).attr('href');
                var req = links.getUrl(file);
                links.getPage(req.url, req.params, req.script);
            });

            $(".ajax-confirm").unbind('click').on('click', function(e) {
                e.preventDefault();
                var file = $(this).attr('href');
                var msg = $(this).data('msg');

                if (confirm(msg)) {
                    links.ajaxConfirm(file);
                }
            });
        },
        init: function() {
            links.click();
            links.load();
        },
        load: function() {
            var link = window.location.hash.split('#')[1];
            var req = links.getUrl(link);
            links.getPage(req.url, req.params, req.script);
        },
        getPage: function(file, data, script) {
            $.ajax({
                url: file,
                data: data,
            }).success(function(data) {
                $("#content").html(data);
                links.click();
                console.log(script);
                window[script].init();
            }).error(function(data) {
                console.log('error');
            });
        },
        getUrl: function(link) {
            if (link == "#") {
                $("#content").html("");
                return;
            }
            link = link.split('/');
            url = "pages/" + link[1] + "/" + link[2] + ".php";

            var k, v, params = {};

            for (var i = 3; i < link.length; i++) {
                k = link[i];
                i++;
                if (link[i] == undefined) {
                    continue;
                }
                v = link[i];
                params[k] = v;
            }

            return {url: url, params: params, script: link[1]};
        }
    };
}();
