$(document).ready(function () {
    $(document).on('submit', '#addDepartment', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var title = $('#title').val();
            var code = $('#code').val();
            $.ajax({
                url: 'request/createDepartment.php',
                type: 'Post',
                data: {
                    action: 'add',
                    title: title,
                    code: code,
                },
                success: function (response) {

                    $("#submit").button('reset');
                    $('.load').addClass('hidden');
                    if (response.code == "1") {
                        notification(response.msg, 'success')
                        setTimeout(function () {
                            window.location = "viewDepartment";
                        }, 2000);

                    } else {
                        notification(response.msg, 'danger');
                    }
                }, error: function () {
                    $("#submit").button('reset');
                    notification(404, 'danger');
                }
            });
        }
    });
});



