$(document).ready(function () {
    var table=  $('#pro').DataTable( {

        "ajax": {
            "url":'request/myAttendance.php',
            "type":"post"
        },"columns":[
            {"data":"id"},
            {"data":"start"},
            {"data":"end"},
            {"data":"date"}


        ],"order": [[ 0, 'desc' ]]
    } );

});
