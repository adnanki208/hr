$(document).ready(function () {
    var table=  $('#pro').DataTable( {

        "ajax": {
            "url":'request/viewSalary.php',
            "type":"post"
        },"columns":[
            {"data":"salaryId"},
            {"data":"userName"},
            {"data":"date"},
            {"data":"basic"},
            {"data":"sustenance"},
            {"data":"management"},
            {"data":"travel"},
            {"data":"overTime"},
            {"data":"advance"},
            {"data":"reward"},
            {"data":"discount"},
            {"data":"total"},
           {"data":"checkout"}


        ],"order": [[ 2, 'desc' ]]
    } );
    $(document).on('click','.del',function (e) {

        var id = $(this).val();
        $.ajax({
            url: 'request/createDepartment.php',
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
