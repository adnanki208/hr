/**/
function notification(msg,type) {
    $('.notification').removeClass('success');
    $('.notification').removeClass('danger');
    $('.notification').removeClass(type);
    $('.notification').addClass(type);
    $('.msg').html(msg);
    $('.notification_body').fadeIn().delay(2000).fadeOut();


}


/**/