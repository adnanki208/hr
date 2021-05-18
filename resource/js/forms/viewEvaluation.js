$(document).ready(function () {
var lang=$('#lang1').val();
    var table=  $('#pro').DataTable( {
        "language": {
            "url": "resource/js/forms/"+lang+".json"
        },
        "ajax": {
            "url":'request/viewEvaluation.php',
            "type":"post"
        },"columns":[
            {"data":"evaluateId"},
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
