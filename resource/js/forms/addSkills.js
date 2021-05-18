$(document).ready(function () {
    $('#groupid').select2();
    $(document).on('submit', '#addSkill', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var name = $('#skillName').val();
            var groupid = $('#groupid').val();
            $.ajax({
                url: 'request/addSkills.php',
                type: 'Post',
                data: {
                    action: 'add',
                    name: name,
                    id:groupid
                },
                success: function (response) {
                    $("#submit").button('reset');
                    if (response.code == "1") {
                        notification(response.msg, 'success')
                        setTimeout(function () {
                            window.location = "showSkills";
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
