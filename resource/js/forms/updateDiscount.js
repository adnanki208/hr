$(document).ready(function () {
    $(document).on('submit', '#edit', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var min = $('#min').val();
            var discount= $('#discount').val();
            var id = $('#id').val();
            $.ajax({
                url: '../request/createDiscount.php',
                type: 'Post',
                data: {
                    action: 'update',
                    min: min,
                    discount:discount,
                    id: id
                },
                success: function (response) {
                    $("#submit").button('reset');
                    if (response.code == "1") {
                        notification(response.msg, 'success')
                        setTimeout(function () {
                            window.location = "../viewDiscount";
                        }, 2000);

                    }else if (response.code == "-1") {
                        notification(response.msg, 'danger');
                    } else {
                        notification(response.msg, 'danger');
                    }
                }, error: function () {
                    $("#submit").button('reset');
                    notification(404, 'danger');
                }
            });
        }
    });
});