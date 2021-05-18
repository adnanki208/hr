$(document).ready(function () {
    $(document).on('submit', '#edit', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var title = $('#title').val();
            var id = $('#id').val();
            $.ajax({
                url: '../request/createBranch.php',
                type: 'Post',
                data: {
                    action: 'update',
                    title: title,
                    id: id
                },
                success: function (response) {
                  $("#submit").button('reset');
                    if (response.code == "1") {
                        notification(response.msg, 'success')
                        setTimeout(function () {
                            window.location = "../viewBranch";
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