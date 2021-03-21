$(document).ready(function () {
    $(document).on('submit', '#addVacation', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var vacationDate = $('#vacationDate').val();
            var vacationType = $('#vacationType').val();
            var vacationDescription = $('#vacationDescription').val();
            $.ajax({
                url: 'request/createRequestVacation.php',
                type: 'Post',
                data: {
                    action:'add',
                    vacationDate: vacationDate,
                    vacationType: vacationType,
                    vacationDescription:vacationDescription
                },
                success: function (response) {
                    $("#submit").button('reset');
                    if (response.code == "1") {
                        notification(response.msg, 'success');
                        setTimeout(function () {
                            // window.location = "showSkills";
                        }, 2000);

                    }else if(response.code == "-1") {
                        notification(response.msg, 'danger');
                    }else if (response.code == "-2"){
                        notification(response.msg, 'danger');
                    }
                    else {
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
