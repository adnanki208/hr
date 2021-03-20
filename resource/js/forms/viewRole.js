$(document).ready(function () {
    var table=  $('#pro').DataTable( {

        "ajax": {
            "url":'request/viewRole.php',
            "type":"post"
        },"columns":[
            {"data":"id"},
            {"data":"name"},
            {"data":"code"}
            ,{"data":"id","mRender": function (a,b,c) {
                    return '<button class="del btn btn-danger" data-loading-text="loading..." value="'+c.id+'">'+'<i class="fa fa-trash"></i>'+'</button><a class="btn btn-primary" href="editRole/'+c.id+'"><i class="fa fa-edit"></i></a>';}
            }

        ],"order": [[ 0, 'desc' ]]
    } );
    $(document).on('click','.del',function (e) {

        var id = $(this).val();
        $.ajax({
            url: 'request/createRole.php',
            type: 'Post',
            data: {
                action: 'del',
                id: id
            },
            success: function (response) {
                $("#submit").button('loading');
                $('.load').addClass('hidden');
                if (response.code == "1") {
                    notification(response.msg, 'success');
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
});
