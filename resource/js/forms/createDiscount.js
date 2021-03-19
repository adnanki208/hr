$(document).ready(function () {
    $('#groupid').select2();
    $(document).on('submit', '#addSkill', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var startTime = $('#startTime').val();
            var endTime= $('#endTime').val();
            var discount= $('#discount').val();
            $.ajax({
                url: 'request/createDiscount.php',
                type: 'Post',
                data: {
                    action: 'add',
                    startTime: startTime,
                    endTime:endTime,
                    discount:discount
                },
                success: function (response) {
                    $("#submit").button('reset');
                    if (response.code == "1") {
                        notification(response.msg, 'success');
                        setTimeout(function () {
                            window.location = "viewDiscount";
                        }, 2000);

                    }else if (response.code == "-1"){
                        notification(response.msg, 'danger');
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
