$(function() {

    $('button[follower]').click(function() {
        $(this).button('loading');
        var follower = $(this).attr('follower');
        $.post('/follow', {"follower": follower}, function(data) {
            if (data === 'success') {
                window.location.reload();
            } else {
                alert(data);
                window.location.reload();
            }
        });
    });

});