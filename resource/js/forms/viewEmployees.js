$(document).ready(function () {
    var table = $('#pro').DataTable({
        "ajax": {
            "url": 'request/viewEmployees.php',
            "type": "post"
        }, "columns": [
            {"data": "id"},
            {"data": "userName"},
            {"data": "first"},
            {"data": "last"},
            {
                "data": "state", "mRender": function (a, b, c) {
                    if (c.state === '1') {
                        return '<label class="label label-success">Available</label>'
                    } else {
                        return '<label class="label label-danger">Disable</label>'
                    }
                }
            },
            {"data": "name"},
            {"data": "title"},
            {"data": "jobtypename"},
            {"data": "totalHours"},
            {"data": "mobile"},
            {
                "data": "state", "mRender": function (a, b, c) {
                    var view;
                    if (c.state === '1') {
                        view= '<button class="btn btn-danger changeState" data-state="'+c.state+'" data-id="'+c.id+'" title="Disable"><i class="fa fa-eye-slash"></i></button>'
                    } else {
                        view= '<button class="btn btn-success changeState" data-state="'+c.state+'" data-id="'+c.id+'" title="Available"><i class="fa fa-eye"></i></button>'
                    }
                    view=view+'<a title="edit" class="btn btn-primary" href="employeeEdit/'+c.id+'"><i class="fa fa-edit"></i></a>'
                    view=view+'<a title="Add Skills" class="btn btn-success" href="employeeAddSkill/'+c.id+'"><i class="fa fa-plus-circle"></i></a>'
                    view=view+'<a title="Add warning" class="btn btn-warning" href="employeeAddSkill/'+c.id+'"><i class="fa fa-warning"></i></a>'
                    view=view+'<a title="More Details" class="btn btn-info" href="employeeInfo/'+c.id+'"><i class="fa fa-info-circle"></i></a>'
                    return view;
                }
            },
        ]
    });
    $(document).on('click', '.delSkill', function (e) {

        var id = $(this).val();
        $.ajax({
            url: 'request/creatEmploy.php',
            type: 'Post',
            data: {
                action: 'del',
                id: id
            },
            success: function (response) {
                $("#submit").removeAttr('disabled');
                $('.load').addClass('hidden');
                if (response.code == "1") {
                    notification(response.msg, 'success');
                    table.ajax.reload();
                    setTimeout(function () {

                        window.location = "viewSkill";
                    }, 2000);

                } else {
                    notification(response.msg, 'danger');
                }
            }, error: function () {
                $("#submit").removeAttr('disabled');
                $('.load').addClass('hidden');
                notification(404, 'danger');
            }
        });

    });
});
