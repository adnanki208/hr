$(document).ready(function () {
    var table=  $('#pro').DataTable( {

        "ajax": {
            "url":'request/viewRequestVacation.php',
            "type":"post"
        },"columns":[
            {"data":"idreq"},
            {"data":"userName" , "mRender": function (a, b, c) {
                return c.first+' '+c.last+' ('+c.userName+')'
                }},
            {"data":"date"},
            {
                "data":"type", "mRender": function (a, b, c) {
                    if (c.type === '1') {
                        return '<label class="label label-success">Normal Vaction</label>'
                    } else if (c.type === '2') {
                        return '<label class="label label-danger">Sick Vacation</label>'
                    }else {
                       return '<label class="label label-default">Unjustified Vacation</label>'
                    }
                }
            }

            ,{"data":"idreq","mRender": function (a,b,c) {
                if(c.state == 0){
                    return '<button data-date="'+c.date+'" data-type="'+c.type+'" title="Accept Vacation" data-employeeid="'+c.employeeId+'" data-loading-text="loading..."  class="approve btn btn-success" value="'+c.idreq+'" >'+'<i class="fa fa-check"></i></button>' +
                        '<button title="Reject Vacation" class="reject btn btn-danger" data-loading-text="loading..." value="'+c.idreq+'">'+'<i class="fa fa-ban"></i>'+'</button><button data-title="Reason Of Vacation" data-desc="'+c.description+'" class="btn btn-info info" title="See More Info" ><i class="fa fa-info-circle"></i></button>';}
                        else {
                    return '<button data-title="Reason Of Vacation" data-desc="'+c.description+'" class="btn btn-info info" title="See More Info" ><i class="fa fa-info-circle"></i></button>'

                }
            }}

        ],"order": [[ 0, 'desc' ]]
    } );

    var table2=  $('#pro2').DataTable( {

        "ajax": {
            "url":'request/viewRequestVacationTable2.php',
            "type":"post"
        },"columns":[
            {"data":"idreq"},
            {"data":"userName" , "mRender": function (a, b, c) {
                    return c.first+' '+c.last+' ('+c.userName+')'
                }},
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
                    notification(response.msg, 'success');
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
    $(document).on('click','.approve',function (e) {

        var id = $(this).val();
        var type = $(this).data("type");
        var date = $(this).data("date");
        var employeeId = $(this).data("employeeid");


        $.ajax({
            url: 'request/createRequestVacation.php',
            type: 'Post',
            data: {
                action: 'approve',
                id: id,
                type:type,
                employeeId:employeeId,
                date:date
            },
            success: function (response) {
                $("#submit").button('loading');
                $('.load').addClass('hidden');
                if (response.code == "1") {
                    notification(response.msg, 'success');
                    table.ajax.reload();
                    table2.ajax.reload();
                } else {
                    notification(response.msg, 'danger');
                }
            }, error: function () {
                $("#submit").button('reset');
                $('.load').addClass('hidden');
                notification(404, 'danger');
            }
        });

    });

    $(document).on('click','.info',function () {
        $('#modalTitle').empty().append($(this).data("title"));
        $('.modal-body').empty().append($(this).data("desc"));
        $('#modal').modal('show')
    })
});
