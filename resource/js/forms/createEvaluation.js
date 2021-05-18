$(document).ready(function () {
    var date;
    $('#date').change( function (e) {
        date = $(this).val();
        $('.dateSelect').remove();
        $('#add').fadeIn();
        $('#month').append('<lable class="label label-info" style="font-size: 24px">'+date+'</lable>');
        $('#employeeId').select2();

    });


    $(document).on('change', '#employeeId', function (e) {
        e.preventDefault();
            $("#submit").button('loading');
            var employeeId = $('#employeeId').val();


            $.ajax({
                url: 'request/createEvaluation.php',
                type: 'Post',
                data: {
                    action: 'search',
                    employeeId: employeeId,
                    date:date
                },
                success: function (response) {

                    if (response.code == "1") {
                        $('#attendance').val(response.data['attendance']);
                        $("#submit").button('reset');
                    } else {
                        notification(response.msg, 'danger');
                    }
                }, error: function () {
                    notification(404, 'danger');
                }
            });

    });
    $(document).on('submit', '#add', function (e) {
        e.preventDefault();
        var attendance = parseFloat($('#attendance').val());
        var punctuality = parseFloat($('#punctuality').val());
        var communication = parseFloat($('#communication').val());
        var dress = parseFloat($('#dress').val());
        var productivity = parseFloat($('#productivity').val());

        var total=(attendance+punctuality+communication+dress+productivity)/5;
        $('#total').val(total);
        $('.total').html(''+total.toLocaleString(window.document.documentElement.lang)+'');
        $('.dateOut').html(date);
        $('.userName').html($( "#employeeId option:selected" ).text());
        $('#myModal').modal('show')


    });


    $(document).on('click', '.evBtn', function (e) {
        e.preventDefault();
        $(".evBtn").button('loading');
        var employeeId = $('#employeeId').val();
        var attendance = parseFloat($('#attendance').val());
        var punctuality = parseFloat($('#punctuality').val());
        var communication = parseFloat($('#communication').val());
        var dress = parseFloat($('#dress').val());
        var productivity = parseFloat($('#productivity').val());

        var total = parseFloat($('#total').val());

        $.ajax({
            url: 'request/createEvaluation.php',
            type: 'Post',
            data: {
                action: 'add',
                employeeId: employeeId,
                attendance:attendance,
                punctuality:punctuality,
                communication:communication,
                dress:dress,
                productivity:productivity,
                total:total,
                date:date
            },
            success: function (response) {
                $(".evBtn").button('reset');
                $('#myModal').modal('hide');
                if (response.code == "1") {
                    notification(response.msg, 'success')
                    setTimeout(function () {
                        window.location = "viewEvaluation";
                    }, 2000);

                } else {
                    notification(response.msg, 'danger');
                }
            }, error: function () {
                notification(404, 'danger');
            }
        });

    });
});
