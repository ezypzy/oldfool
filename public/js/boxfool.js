var total_msg = 3;
var current_msg = 1;

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
			
		setInterval(function() {
			toggle_msg();	
		}, 3000);

});

function toggle_msg() {
	if(current_msg < total_msg) {
		$('#message' + current_msg).fadeOut('slow');
		current_msg = current_msg + 1; 
		$('#message' + current_msg).fadeIn('slow');	
	} else {
		$('#message' + current_msg).fadeOut('slow');
		current_msg = 1;
		$('#message' + current_msg).fadeIn('slow');	
	}
}
