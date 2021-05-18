$(document).ready(function () {
 var lang=$('#lang1').val();
    var table=  $('#pro').DataTable( {
        "language": {
            "url": "resource/js/forms/"+lang+".json"
        },
        "ajax": {
            "url": 'request/viewTask.php',
            "type": "post",
            "data": {"action":"myTask"}
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
                    var stateColor = ['', 'info', 'warning', _Success, 'danger'];
                    var state = ['', 'Working on', 'Under Check', 'Done', 'incomplete'];
                    return '<label class="label label-' + stateColor[c.taskstate] + '">' + state[c.taskstate] + '</label>'
                }
            },
            {"data": "date"},
            {"data": "endDate"},
            {
                "data": "taskstate", "mRender": function (a, b, c) {
                    var view='';
                    if (c.taskstate === '1'||c.taskstate === '4') {
                        view = '<button class="btn btn-success finish" data-loading-text="Loading..."  data-id="' + c.taskid + '" title="Finish"><i class="fa fa-check"></i></button>'
                    }
                    return view;
                }
            }
        ]
    });

    $(document).on('click', '.finish', function (e) {
        $(this).button('loading');
        var id = $(this).data('id');
        $.ajax({
            url: 'request/createTask.php',
            type: 'Post',
            data: {
                action: 'finish',
                id: id,
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


});
