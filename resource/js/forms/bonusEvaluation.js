$(document).ready(function () {
 var lang=$('#lang1').val();
    var table=  $('#pro').DataTable( {
        "language": {
            "url": "resource/js/forms/"+lang+".json"
        },
        "ajax": {
            "url": 'request/bonusEvaluation.php',
            "type": "post",
            "data": {"action":"view"}
        }, "columns": [
            {"data": "id"},
            {"data": "rate"},
            {"data": "percent"},

            {
                "data": "id", "mRender": function (a, b, c) {

                        return  '<button class="btn btn-danger del" data-loading-text="Loading..."  data-id="' + c.id + '" title="delete"><i class="fa fa-trash"></i></button>'

                }
            },
        ]
    });
    $(document).on('click', '.del', function (e) {
        $(this).button('loading');
        var id = $(this).data('id');
        $.ajax({
            url: 'request/bonusEvaluation.php',
            type: 'Post',
            data: {
                action: 'del',
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


    $(document).on('submit', '#add', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var rate = $('#rate').val();
            var percent = $('#percent').val();
            $.ajax({
                url: 'request/bonusEvaluation.php',
                type: 'Post',
                data: {
                    action: 'add',
                    rate: rate,
                    percent:percent
                },
                success: function (response) {
                    $("#submit").button('reset');
                    if (response.code == "1") {
                        notification(response.msg, 'success')
                        table.ajax.reload();

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
