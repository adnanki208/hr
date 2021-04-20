$(document).ready(function () {
    var table = $('#pro').DataTable({
        "ajax": {
            "url": 'request/viewTask.php',
            "type": "post"
        }, "columns": [
            {"data": "taskid"},
            {"data": "employeeName"},
            {"data": "creatorName"},
            {
                "data": "checkerName", "mRender": function (a, b, c) {
                    if (c.taskstate == '3' || c.taskstate == '4') {
                        return '<span>'+c.checkerName+'</span>';
                    } else {
                        return '';
                    }
                }
            },
            {"data": "description"},
            {
                "data": "taskstate", "mRender": function (a, b, c) {
                    var stateColor = ['', 'info', 'warning', 'success', 'danger'];
                    var state = ['', 'Working on', 'Under Check', 'Done', 'incomplete'];
                    console.log(stateColor[parseInt(c.taskstate)]);
                    return '<label class="label label-' + stateColor[parseInt(c.taskstate)] + '">' + state[parseInt(c.taskstate)] + '</label>'
                }
            },
            {"data": "date"},
            {"data": "endDate"},
            {
                "data": "taskstate", "mRender": function (a, b, c) {
                    var view='';
                    if (c.taskstate === '1') {
                        view = '<button class="btn btn-danger del" data-loading-text="Loading..."  data-id="' + c.taskid + '" title="delete"><i class="fa fa-trash"></i></button>'
                    } else if (c.taskstate === '2') {
                        view = '<button class="btn btn-success approve" data-loading-text="Loading..."  data-id="' + c.taskid + '" title="approve"><i class="fa fa-check"></i></button>'
                        view = view + '<button class="btn btn-danger reject" data-loading-text="Loading..."  data-id="' + c.taskid + '" title="reject"><i class="fa fa-close"></i></button>'
                    }
                    return view;
                }
            },
        ]
    });
    $(document).on('click', '.del', function (e) {
        $(this).button('loading');
        var id = $(this).data('id');
        $.ajax({
            url: 'request/createTask.php',
            type: 'Post',
            data: {
                action: 'del',
                id: id,
            },
            success: function (response) {
                $('.changeState').button('reset');
                if (response.code == "1") {
                    notification(response.msg, 'success');
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
    $(document).on('click', '.approve', function (e) {
        $(this).button('loading');
        var id = $(this).data('id');
        $.ajax({
            url: 'request/createTask.php',
            type: 'Post',
            data: {
                action: 'approve',
                id: id,
            },
            success: function (response) {
                $('.changeState').button('reset');
                if (response.code == "1") {
                    notification(response.msg, 'success');
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
    $(document).on('click', '.reject', function (e) {
        $(this).button('loading');
        var id = $(this).data('id');
        $.ajax({
            url: 'request/createTask.php',
            type: 'Post',
            data: {
                action: 'reject',
                id: id,
            },
            success: function (response) {
                $('.changeState').button('reset');
                if (response.code == "1") {
                    notification(response.msg, 'success');
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


});
