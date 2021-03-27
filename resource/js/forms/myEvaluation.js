$(document).ready(function () {
    var table=  $('#pro').DataTable( {

        "ajax": {
            "url":'request/myEvaluation.php',
            "type":"post"
        },"columns":[
            {"data":"id"},
            {"data":"date"},
            {"data":"attendance"},
            {"data":"punctuality"},
            {"data":"communication"},
            {"data":"dress"},
            {"data":"productivity"},
            {"data":"total"}



        ],"order": [[ 1, 'desc' ]]
    } );

});
