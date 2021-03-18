$(document).ready(function () {
    $('#role').select2();
    $('#department').select2();
    $('#jobType').select2();
    $('#upper').select2();
    $('#gander').select2();
    $('#edu').trumbowyg({
        btns: [
            ['viewHTML'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['formatting'],
            ['strong', 'em', 'del'],
            ['superscript', 'subscript'],
            ['link'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ['horizontalRule'],
            ['removeformat'],
            ['fullscreen']
        ]
    });
    $('#exp').trumbowyg({
        btns: [
            ['viewHTML'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['formatting'],
            ['strong', 'em', 'del'],
            ['superscript', 'subscript'],
            ['link'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ['horizontalRule'],
            ['removeformat'],
            ['fullscreen']
        ]
    });
$(document).on('submit','#addEmployee',function (e) {
    e.preventDefault();
    if($(this).parsley()){
        $("#submit").button('loading');
        var name = $('#name').val();
        var gsm = $('#gsm').val();
        var pass = $('#pass').val();
        $.ajax({
            url: 'request/add-employ.php',
            type: 'Post',
            data: {
                action: 'add',
                name: name,
                pass: pass,
                gsm: gsm
            },
            success: function (response) {
                $("#submit").button('rest');
                if (response.code == "1") {
                    notification(response.msg, 'success');
                    setTimeout(function () {
                        window.location="employees-list";
                    },2000);

                } else {
                    notification(response.msg, 'danger');
                }
            }, error: function () {
                $("#submit").button('rest');
                notification(404, 'danger');
            }
        });
    }
});
});