$(document).ready(function () {
    var table=  $('#pro').DataTable( {

        "ajax": {
            "url":'request/viewEvaluation.php',
            "type":"post"
        },"columns":[
            {"data":"id"},
            {"data":"userName"},
            {"data":"date"},
            {"data":"attendance"},
            {"data":"punctuality"},
            {"data":"communication"},
            {"data":"dress"},
            {"data":"productivity"},
            {"data":"total"}



        ],"order": [[ 2, 'desc' ]]
    } );

});
