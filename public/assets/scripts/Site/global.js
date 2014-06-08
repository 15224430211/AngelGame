$(function() {
    $('#searching').click(function() {
        search();
    });
    $('#search-bar').keydown(function(event) {
        switch (event.keyCode) {
            case 13:
                search();
                break;
        }
    });
    $('.navbar a[href*="' + window.location.pathname.split('/')[1] + '"],.nav  a[href*="' + window.location.pathname.split('/')[1] + '"]').parent().addClass('active');
});

var search = function() {
    var q = $('#search-bar').val();
    $('#search-bar').val('');
    if (q.trim().length > 1) {
        window.location.href = "/search/" + q;
    } else {
        return false;
    }
};