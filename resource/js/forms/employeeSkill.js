$(document).ready(function () {
    $('#employeeName').select2();
    $('#skillName').select2();
    $(document).on('submit', '#addSkill', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var employeeId = $('#employeeName').val();
            var skillName = $('#skillName').val();

            $.ajax({
                url: 'request/employeeSkill.php',
                type: 'Post',
                data: {
                    action: 'add',
                    employeeId: employeeId,
                    skillName:skillName,
                },
                success: function (response) {
                    $("#submit").button('reset');
                    if (response.code == "1") {
                        notification(response.msg, 'success');
                        setTimeout(function () {
                            // window.location = "../viewAlert";
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
