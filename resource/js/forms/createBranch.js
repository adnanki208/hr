$(document).ready(function () {
    $(document).on('submit', '#addBranch', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var title = $('#title').val();
            $.ajax({
                url: 'request/createBranch.php',
                type: 'Post',
                data: {
                    action: 'add',
                    title: title
                },
                success: function (response) {

                    $("#submit").button('reset');
                    $('.load').addClass('hidden');
                    if (response.code == "1") {
                        notification(response.msg, 'success');
                        setTimeout(function () {
                            window.location = "viewBranch";
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



