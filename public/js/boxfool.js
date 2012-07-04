$(function() {
    $('#login_link').click(function(e) {
        $(this).hide();
        $('#login_box').slideToggle('normal', function() {
            if(!$(this).is(':visible')) {
                $('#login_link').show();
            }
        });
        return false;
    });
    $('.login-close').click(function(e) {
        if($('#login_box').is(':visible')) {
            $('#login_box').slideToggle('normal', function() {
                if(!$(this).is(':visible')) {
                    $('#login_link').show();
                }
            });
        }
    });
});