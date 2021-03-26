$(document).ready(function () {
    var date;
    $('#date').change( function (e) {
        date = $(this).val();
        $('.dateSelect').remove();
        $('#month').append('<lable class="label label-info" style="font-size: 24px">'+date+'</lable>');
       $('#add').fadeIn();
        $('#employeeId').select2();

    });
 $('.countSalary').change( function (e) {
        var basic = $('#basic').val();
        var sustenance = $('#sustenance').val();
        var management = $('#management').val();
        var travel = $('#travel').val();
        var overTime = $('#overTime').val();
        var advance = $('#advance').val();
        var reward = $('#reward').val();
        var discount = $('#discount').val();
        var total=basic+sustenance+management+travel+overTime+advance+reward-discount;
        $('#total').val(total);

    });

    $(document).on('change', '#employeeId', function (e) {
        e.preventDefault();
            $("#submit").button('loading');
            var employeeId = $('#employeeId').val();


            $.ajax({
                url: 'request/createSalary.php',
                type: 'Post',
                data: {
                    action: 'search',
                    employeeId: employeeId,
                    date:date
                },
                success: function (response) {

                    if (response.code == "1") {
                        $('#basic').val(response.data['salary']);
                        $('#discount').val(response.data['discount']);
                        $('#overTime').val(response.data['overTime']);
                        $('#reward').val(response.data['reward']);
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
        var basic = parseInt($('#basic').val());
        var sustenance = parseInt($('#sustenance').val());
        var management = parseInt($('#management').val());
        var travel = parseInt($('#travel').val());
        var overTime = parseInt($('#overTime').val());
        var advance = parseInt($('#advance').val());
        var reward = parseInt($('#reward').val());
        var discount = parseInt($('#discount').val());
        var total=basic+sustenance+management+travel+overTime+advance+reward-discount;
        $('#total').val(total);
        $('.total').html(''+total.toLocaleString(window.document.documentElement.lang)+'');
        $('.dateOut').html(date);
        $('.userName').html($( "#employeeId option:selected" ).text());
        $('#myModal').modal('show')


    });


    $(document).on('click', '.checkOutBtn', function (e) {
        e.preventDefault();
        $(".checkOutBtn").button('loading');
        var employeeId = $('#employeeId').val();
        var basic = parseInt($('#basic').val());
        var sustenance = parseInt($('#sustenance').val());
        var management = parseInt($('#management').val());
        var travel = parseInt($('#travel').val());
        var overTime = parseInt($('#overTime').val());
        var advance = parseInt($('#advance').val());
        var reward = parseInt($('#reward').val());
        var discount = parseInt($('#discount').val());
        var total = parseInt($('#total').val());

        $.ajax({
            url: 'request/createSalary.php',
            type: 'Post',
            data: {
                action: 'add',
                employeeId: employeeId,
                basic:basic,
                sustenance:sustenance,
                management:management,
                travel:travel,
                overTime:overTime,
                advance:advance,
                reward:reward,
                discount:discount,
                total:total,
                date:date
            },
            success: function (response) {
                $(".checkOutBtn").button('reset');
                $('#myModal').modal('hide');
                if (response.code == "1") {
                    notification(response.msg, 'success');
                    setTimeout(function () {
                        window.location = "viewSalary";
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
