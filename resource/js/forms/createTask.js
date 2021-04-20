$(document).ready(function () {
    $('#employee').select2();
    $(document).on('submit', '#add', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var employee = $('#employee').val();
            var description = $('#description').val();
            $.ajax({
                url: 'request/createTask.php',
                type: 'Post',
                data: {
                    action: 'add',
                    employee: employee,
                    description:description
                },
                success: function (response) {
                    $("#submit").button('reset');
                    if (response.code == "1") {
                        notification(response.msg, 'success');
                        setTimeout(function () {
                            window.location = "viewTask";
                        }, 2000);

                    } else {
                        notification(response.msg, 'danger');
                    }
                }, error: function () {
                    $("#submit").button('reset');
                    $('.load').addClass('hidden');
                    notification(404, 'danger');
                }
            });
        }
    });
});
