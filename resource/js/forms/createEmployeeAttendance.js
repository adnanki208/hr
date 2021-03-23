$(document).ready(function () {
    $('#id').select2();
    $('#id2').select2();
    $(document).on('submit','#add', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var id = $('#id').val();
            var time = $('#time').val();
            $.ajax({
                url: 'request/createEmployeeAttendance.php',
                type: 'Post',
                data: {
                    action: 'login',
                    id: id,
                    time:time,
                },
                success: function (response) {
                    $("#submit").button('reset');
                    if (response.code == "1") {
                        notification(response.msg, 'success');
                        setTimeout(function () {
                            //
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
    $(document).on('submit','#add2', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var id2 = $('#id2').val();
            var time2 = $('#time2').val();
            $.ajax({
                url: 'request/createEmployeeAttendance.php',
                type: 'Post',
                data: {
                    action: 'logout',
                    id: id2,
                    time:time2,
                },
                success: function (response) {
                    $("#submit").button('reset');
                    if (response.code == "1") {
                        notification(response.msg, 'success');
                        setTimeout(function () {
                            //
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
