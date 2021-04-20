$(document).ready(function () {
    $('#id').select2();
    $('#id2').select2();
    $('#id3').select2();
    $(document).on('submit','#add', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var id = $('#id').val();
            var date = $('#date').val();
            var time = $('#time').val();
            $.ajax({
                url: 'request/createEmployeeAttendance.php',
                type: 'Post',
                data: {
                    action: 'login',
                    id: id,
                    time:time,
                    date:date,
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
            var date2 = $('#date2').val();
            $.ajax({
                url: 'request/createEmployeeAttendance.php',
                type: 'Post',
                data: {
                    action: 'logout',
                    id: id2,
                    time:time2,
                    date2:date2,
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
    $(document).on('submit','#add3', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var id3 = $('#id3').val();
            var date3 = $('#date3').val();
            $.ajax({
                url: 'request/createEmployeeAttendance.php',
                type: 'Post',
                data: {
                    action: 'vacation',
                    id: id3,
                    date3: date3,
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
