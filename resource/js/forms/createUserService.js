$(document).ready(function () {
    $('#vacationType').select2();
   var lang=$('#lang1').val();
    var table2=  $('#pro2').DataTable( {
        "language": {
            "url": "resource/js/forms/"+lang+".json"
        },
        "ajax": {
            "url":'request/viewUserService.php',
            "type":"post"
        },"columns":[
            {"data":"id"},
            {"data":"date"},
            {"data":"acceptedDate"},
            {
                "data":"type", "mRender": function (a, b, c) {
                    if (c.type === '1') {
                        return '<label class="label label-success">Normal Vacation</label>'
                    } else if (c.type === '2') {
                        return '<label class="label label-danger">Sick Vacation</label>'
                    }else {
                        return '<label class="label label-default">Unjustified Vacation</label>'
                    }
                }
            },

            {
                "data":"state", "mRender": function (a, b, c) {
                    if (c.state === '0') {
                        return '<label class="label label-warning">Pending</label>'
                    } else if (c.state === '1') {
                        return '<label class="label label-success">Approved</label>'
                    }else {
                        return '<label class="label label-danger">Rejected</label>'
                    }
                }
            }

            ,{"data":"idreq","mRender": function (a,b,c) {

                    return '<button data-title="Reason Of Vacation" data-desc="'+c.description+'" class="btn btn-info info" title="See More Info" ><i class="fa fa-info-circle"></i></button>'

                }}

        ],"order": [[ 0, 'desc' ]]
    } );

    $(document).on('submit', '#addVacation', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var vacationDate = $('#vacationDate').val();
            var vacationType = $('#vacationType').val();
            var vacationDescription = $('#vacationDescription').val();
            $.ajax({
                url: 'request/createUserService.php',
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
                        notification(response.msg, 'success')
                        table2.ajax.reload();
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
    $(document).on('click','.info',function () {
        $('#modalTitle').empty().append($(this).data("title"));
        $('.modal-body').empty().append($(this).data("desc"));
        $('#modal').modal('show')
    })

    $(document).on('click','.reject',function (e) {

        var id = $(this).val();
        $.ajax({
            url: 'request/createRequestVacation.php',
            type: 'Post',
            data: {
                action: 'reject',
                id: id
            },
            success: function (response) {
                $(".reject").button('loading');
                $('.load').addClass('hidden');
                if (response.code == "1") {
                    notification(response.msg, 'success')
                    table.ajax.reload();
                    table2.ajax.reload();
                } else {
                    notification(response.msg, 'danger');
                }
            }, error: function () {
                $(".reject").button('reset');
                $('.load').addClass('hidden');
                notification(404, 'danger');
            }
        });

    });
});
