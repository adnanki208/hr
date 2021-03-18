$(document).ready(function () {
    $(document).on('submit', '#loginForm', function (e) {
        e.preventDefault();
        $("#submit").button('loading');
        var name = $('#userName').val();
        var pass = $('#password').val();
        $.ajax({
            url: 'request/log.php',
            type: 'Post',
            data: {
                action: 'login',
                name: name,
                pass: pass
            },
            success: function (response) {
                $("#submit").button('reset');
                if (response.code == "1") {
                    setTimeout(function () {
                        window.location = "dashboard";
                    }, 0);

                } else {
                    $('.errorAlert').html('<div class="alert alert-danger fade in alert-dismissable">'+response.msg+'</div>');

                }
            }, error: function () {
                $("#submit").button('reset');
                $('.errorAlert').html('<div class="alert alert-danger fade in alert-dismissable">404</div>');
            }
        });

    });
});