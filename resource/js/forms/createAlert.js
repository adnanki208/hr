$(document).ready(function () {
    $('#alertTo').select2();
    $('#alertBody').trumbowyg({
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
    $(document).on('submit', '#addSkill', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var alertTo = $('#alertTo').val();
            var alertBody = $('#alertBody').val();
            var title = $('#title').val();
            var discount = $('#discount').val();
            $.ajax({
                url: 'request/createAlert.php',
                type: 'Post',
                data: {
                    action: 'add',
                    alertTo: alertTo,
                    alertBody:alertBody,
                    title:title,
                    discount:discount
                },
                success: function (response) {
                    $("#submit").button('reset');
                    if (response.code == "1") {
                        notification(response.msg, 'success');
                        setTimeout(function () {
                            window.location = "showAlert";
                        }, 2000);

                    } else {
                        notification(response.msg, 'danger');
                    }
                }, error: function () {
                    $("#submit").button('reset');
                    $('.load').addClass('hidden');
                    notification(404, 'danger');
                }
            });
        }
    });
});
