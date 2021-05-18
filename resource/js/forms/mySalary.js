$(document).ready(function () {
var lang=$('#lang1').val();
    var table=  $('#pro').DataTable( {
        "language": {
            "url": "resource/js/forms/"+lang+".json"
        },
        "ajax": {
            "url":'request/mySalary.php',
            "type":"post"
        },"columns":[
            {"data":"id"},
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


        ],"order": [[ 1, 'desc' ]]
    } );
});
