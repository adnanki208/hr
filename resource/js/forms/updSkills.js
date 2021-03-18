$(document).ready(function () {
    $(document).on('submit', '#edit', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var name = $('#skillName').val();
            var id = $('#idSkill').val();
            var groupid = $('#groupid').val();
            $.ajax({
                url: '../request/addSkills.php',
                type: 'Post',
                data: {
                    action: 'update',
                    name: name,
                    id: id,
                    groupid: groupid
                },
                success: function (response) {
                    $("#submit").button('reset');
                    if (response.code == "1") {
                        notification(response.msg, 'success');
                        setTimeout(function () {
                            window.location = "../showSkills";
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