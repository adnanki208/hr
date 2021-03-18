$(document).ready(function () {
    var table=  $('#pro').DataTable( {
        "ajax": {
            "url":'request/showSkills.php',
            "type":"post"
        },"columns":[
            {"data":"id"},{"data":"name"},{"data":"groupname"}
            ,{"data":"id","mRender": function (a,b,c) {
                    return '<button class="delSkill btn btn-danger" value="'+c.id+'">'+'<i class="fa fa-trash"></i>'+'</button><a class="btn btn-primary" href="eSkills/'+c.id+'"><i class="fa fa-edit"></i></a>';}
            }

        ]
    } );
    $(document).on('click','.delSkill',function (e) {

        var id = $(this).val();
        $.ajax({
            url: 'request/addSkills.php',
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
                    },2000);

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
