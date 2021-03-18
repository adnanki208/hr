$(document).ready(function () {
    $(document).on('submit', '#editSkill', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var name = $('#skillName').val();
            var id = $('#idSkill').val();
            $.ajax({
                url: '../request/createSkill.php',
                type: 'Post',
                data: {
                    action: 'update',
                    name: name,
                    id: id
                },
                success: function (response) {
                    $("#submit").button('rest');
                    if (response.code == "1") {
                        notification(response.msg, 'success');
                        setTimeout(function () {
                            window.location = "../viewSkill";
                        }, 2000);

                    } else {
                        notification(response.msg, 'danger');
                    }
                }, error: function () {
                    $("#submit").button('rest');
                    notification(404, 'danger');
                }
            });
        }
    });
});