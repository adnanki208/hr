$(document).ready(function () {
    var table=  $('#pro').DataTable( {

        "ajax": {
            "url":'request/myAttendance.php',
            "type":"post"
        },"columns":[
            {"data":"id"},
            {"data":"start"},
            {"data":"end"},
            {"data":"duration"},
            {"data":"vacation","mRender": function (a,b,c) {
                var state=['','vacation','sake','unjustified','attend','no action'];
                var stateClass=['','label-primary','label-info','label-warning','label-success','label-danger'];
                    return '<label class="label '+stateClass[c.vacation]+'">'+state[c.vacation]+'</label>';}
            },
            {"data":"date"}


        ],"order": [[ 0, 'desc' ]]
    } );

});
