$(document).ready(function () {
    $(document).on('submit', '#editRole', function (e) {

        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var id=$('#roleid').val();
            var title = $('#title').val();
            var code = $('#code').val();
            var role = [];
            $.each($("input[name='role']:checked"), function(){
                role.push($(this).val());
            });

            $.ajax({
                url: '../request/createRole.php',
                type: 'Post',
                data: {
                    action: 'update',
                    id:id,
                    title: title,
                    code: code,
                    role:role

                },
                success: function (response) {
                    $("#submit").button('reset');
                    if (response.code == "1") {
                        notification(response.msg, 'success');
                        setTimeout(function () {
                            window.location = "../viewRole";
                        }, 2000);

                    } else {
                        $("#submit").button('reset');
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