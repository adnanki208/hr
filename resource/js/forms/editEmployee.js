$(document).ready(function () {
    $('#role').select2();
    $('#department').select2();
    $('#jobType').select2();
    $('#upper').select2();
    $('#gander').select2();
    $('#shift').select2();
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
    $("#userImg").fileinput({
    });
    $("#document").fileinput({
    });
    $(document).on('submit', '#editEmployee', function (e) {
        e.preventDefault();
        if ($(this).parsley()) {
            $("#submit").button('loading');
            var id = $('#id').val();
            var userName = $('#userName').val();
            var shift = $('#shift').val();
            var roleId = $('#role').val();
            var departmintId = $('#department').val();
            var jobTypeId = $('#jobType').val();
            var first = $('#firstName').val();
            var last = $('#lastName').val();
            var father = $('#fatherName').val();
            var mather = $('#matherName').val();
            var experience = $('#exp').val();
            var gander = $('#gander').val();
            var mobile = $('#mobile').val();
            var phone = $('#phone').val();
            var cophone = $('#cophone').val();
            var email = $('#email').val();
            var address = $('#address').val();
            var education = $('#edu').val();
            var salary = $('#salary').val();
            var upperId = $('#upper').val();
            var holyday = $('#holidays').val();
            var sike = $('#sake').val();
            var degree = $('#degree').val();
            var typeOfEdu = $('#typeOfEdu').val();
            var facelty = $('#facelty').val();
            var totalHours = $('#totalHours').val();
            var img =$('input#userImg')[0].files[0];
            var document =$('input#document')[0].files[0];
            var form_data = new FormData();
            form_data.append('action','edit');
            form_data.append('id',id);
            form_data.append('userName',userName);
            form_data.append('shift',shift);
            form_data.append('roleId',roleId);
            form_data.append('departmintId',departmintId);
            form_data.append('jobTypeId',jobTypeId);
            form_data.append('first',first);
            form_data.append('last',last);
            form_data.append('father',father);
            form_data.append('mather',mather);
            form_data.append('experience',experience);
            form_data.append('gander',gander);
            form_data.append('mobile',mobile);
            form_data.append('phone',phone);
            form_data.append('cophone',cophone);
            form_data.append('email',email);
            form_data.append('address',address);
            form_data.append('education',education);
            form_data.append('salary',salary);
            form_data.append('upperId',upperId);
            form_data.append('holyday',holyday);
            form_data.append('sike',sike);
            form_data.append('degree',degree);
            form_data.append('typeOfEdu',typeOfEdu);
            form_data.append('facelty',facelty);
            form_data.append('totalHours',totalHours);
            form_data.append('img',img);
            form_data.append('document',document);
            $.ajax({
                url: '../request/creatEmploy.php',
                type: 'Post',
                processData: false,
                contentType: false,
                data:form_data,
                success: function (response) {
                    $("#submit").button('rest');
                    if (response.code == "1") {
                        notification(response.msg, 'success');
                        setTimeout(function () {
                            window.location = "../viewEmployees";
                        }, 2000);

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