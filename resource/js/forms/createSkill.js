$(document).ready(function () {
    $(document).on('submit', '#addSkill', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var name = $('#skillName').val();
            $.ajax({
                url: 'request/createSkill.php',
                type: 'Post',
                data: {
                    action: 'add',
                    name: name
                },
                success: function (response) {
                    $("#submit").button('reset');
                    if (response.code == "1") {
                        notification(response.msg, 'success');
                        setTimeout(function () {
                            window.location = "viewSkill";
                        }, 2000);

                    } else {
                        $("#submit").button('reset');
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



