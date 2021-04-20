$(document).ready(function () {
    $('#pro').DataTable( {
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
});
