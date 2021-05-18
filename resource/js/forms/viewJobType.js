$(document).ready(function () {
var lang=$('#lang1').val();
    var table=  $('#pro').DataTable( {
        "language": {
            "url": "resource/js/forms/"+lang+".json"
        },
        "ajax": {
            "url":'request/viewJobType.php',
            "type":"post"
        },"columns":[
            {"data":"id"},{"data":"name"}
            ,{"data":"id","mRender": function (a,b,c) {
                    return '<button class="del btn btn-danger" data-loading-text="loading..."  value="'+c.id+'">'+'<i class="fa fa-trash"></i>'+'</button><a class="btn btn-primary" href="editJobType/'+c.id+'"><i class="fa fa-edit"></i></a>';}
            }

        ]
    } );
    $(document).on('click','.del',function (e) {
        $("#submit").button('loading');
        var id = $(this).val();
        $.ajax({
            url: 'request/createJobType.php',
            type: 'Post',
            data: {
                action: 'del',
                id: id
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

            }
        });

    });
});
