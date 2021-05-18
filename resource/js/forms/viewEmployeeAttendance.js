$(document).ready(function () {
var lang=$('#lang1').val();
    var table=  $('#pro').DataTable( {
        "language": {
            "url": "resource/js/forms/"+lang+".json"
        },
        "ajax": {
            "url":'request/viewEmployeeAttendance.php',
            "type":"post"
        },"columns":[
            {"data":"id"},
            {"data":"user" , "mRender": function (a, b, c) {
                   return c.first + " " + c.last + " ( "+c.user+" )";
                } },
            {"data":"start"},
            {"data":"end"},
            {"data":"vacationState","mRender": function (a,b,c) {
                    var state=['','vacation','sake','unjustified','attend','no action'];
                    var stateClass=['','label-primary','label-info','label-warning','label-success','label-danger'];
                    return '<label class="label '+stateClass[c.vacationState]+'">'+state[c.vacationState]+'</label>';}
            },
            {"data":"date"}


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
