$(document).ready(function () {
   var table=  $('#pro').DataTable( {
        "ajax": {
            "url":'request/viewSkill.php',
            "type":"post"
        },"columns":[
            {"data":"id"},{"data":"name"}
            ,{"data":"id","mRender": function (a,b,c) {
                    return '<button class="delSkill btn btn-danger" value="'+c.id+'">'+'<i class="fa fa-trash"></i>'+'</button><a class="btn btn-primary" href="editSkill/'+c.id+'"><i class="fa fa-edit"></i></a>';}
            }

        ],"order": [[ 0, 'desc' ]]
    } );
    $(document).on('click','.delSkill',function (e) {

        var id = $(this).val();
        $.ajax({
            url: 'request/createSkill.php',
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

                        window.location="viewSkill";
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
