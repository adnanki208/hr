$(document).ready(function () {
 var lang=$('#lang1').val();
    var table=  $('#pro').DataTable( {
        "language": {
            "url": "resource/js/forms/"+lang+".json"
        },
        "ajax": {
            "url": 'request/viewEmployees.php',
            "type": "post"
        }, "columns": [
            {"data": "employeeId"},
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
            {"data": "branchname"},
            {"data": "roleName"},
            {"data": "title"},
            {"data": "jobtypename"},
            {"data": "totalHours"},
            {"data": "mobile"},
            {
                "data": "state", "mRender": function (a, b, c) {
                    var view;
                    if (c.state === '1') {
                        view= '<button class="btn btn-danger changeState" data-loading-text="Loading..." data-state="'+c.state+'" data-id="'+c.employeeId+'" title="Disable"><i class="fa fa-eye-slash"></i></button>'
                    } else {
                        view= '<button class="btn btn-success changeState" data-loading-text="Loading..." data-state="'+c.state+'" data-id="'+c.employeeId+'" title="Available"><i class="fa fa-eye"></i></button>'
                    }
                    view=view+'<a title="edit" class="btn btn-primary" href="employeeEdit/'+c.employeeId+'"><i class="fa fa-edit"></i></a>'
                    view=view+'<a title="Add Skills" class="btn btn-success" href="employeeSkill/'+c.employeeId+'"><i class="fa fa-plus-circle"></i></a>'
                    view=view+'<a title="Add warning" class="btn btn-warning" href="createAlert/'+c.employeeId+'"><i class="fa fa-warning"></i></a>'
                    view=view+'<a title="More Details" class="btn btn-info" href="employeeInfo/'+c.employeeId+'"><i class="fa fa-info-circle"></i></a>'
                    view=view+'<a title="change Password" class="btn btn-dark change" data-id="'+c.employeeId+'"><i class="fa fa-key"></i></a>'
                    return view;
                }
            },
        ]
    });
    $(document).on('click', '.changeState', function (e) {
        $(this).button('loading');
        var id = $(this).data('id');
        var state = $(this).data('state');
        $.ajax({
            url: 'request/creatEmploy.php',
            type: 'Post',
            data: {
                action: 'change',
                id: id,
                state: state
            },
            success: function (response) {
                $('.changeState').button('reset');
                if (response.code == "1") {
                    notification(response.msg, 'success')
                    table.ajax.reload();
                } else {
                    notification(response.msg, 'danger');
                }
            }, error: function () {
                $('.changeState').button('reset');
                notification(404, 'danger');
            }
        });

    });

    var id;
    $(document).on('click','.change',function (e) {
        $('#myModal').modal('show');
        id=$(this).data('id');
    })
    $(document).on('submit', '#changePass', function (e) {
        e.preventDefault();
        $('#submit').button('loading');
        var pass = $('#password').val();
        $.ajax({
            url: 'request/creatEmploy.php',
            type: 'Post',
            data: {
                action: 'changePass',
                id: id,
                pass: pass
            },
            success: function (response) {
                $('#submit').button('reset');
                if (response.code == "1") {
                    notification(response.msg, 'success')
                    $('#myModal').modal('hide');
                } else {
                    notification(response.msg, 'danger');
                }
            }, error: function () {
                $('#submit').button('reset');
                notification(404, 'danger');
            }
        });

    });
});
