$(document).ready(function () {
var lang=$('#lang1').val();
    var table=  $('#pro').DataTable( {
        "language": {
            "url": "resource/js/forms/"+lang+".json"
        },
        "ajax": {
            "url":'request/viewMyAlert.php',
            "type":"post"
        },"columns":[
            {"data":"id"},
            {"data":"type"},
            {"data":"discount"},
            {"data":"date"}
            ,{"data":"id","mRender": function (a,b,c) {
                    return '<button data-title="'+c.type+'" data-desc="'+c.description+'" class="btn btn-info info" ><i class="fa fa-info-circle"></i></button>';}
            }

        ],"order": [[ 0, 'desc' ]]
    } );
    $(document).on('click','.del',function (e) {

        var id = $(this).val();
        $.ajax({
            url: 'request/createAlert.php',
            type: 'Post',
            data: {
                action: 'del',
                id: id
            },
            success: function (response) {
                $("#submit").button('loading');
                $('.load').addClass('hidden');
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

    });

    $(document).on('click','.info',function () {
        $('#modalTitle').empty().append($(this).data("title"));
        $('.modal-body').empty().append($(this).data("desc"));
        $('#modal').modal('show')
    })
});
