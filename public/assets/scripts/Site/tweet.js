$(function() {
    $('textarea').focus(function() {
        $(this).attr('rows', 3);
    });
    $('textarea').keydown(function() {
        $('.tweet-length').text(140 - $(this).val().length);
    });
    $('form').submit(function() {
        if ($('textarea[name]').val().length < 1) {
            $('textarea[name]').attr('placeholder', '输入的内容为空！')
                    .css('background-color', 'rgb(255,230,230)');
            return false;
        }
    });
    $('a.show-comment').click(function() {
        if ($(this).parent().next().is('div.media:hidden')) {
            $(this).parent().nextAll('div.media:hidden').show();
        } else if ($(this).parent().next().is('div.media:visible')) {
            $(this).parent().nextAll('div.media:visible').hide();
        } else {
            var mid = $(this).attr('mid');
            $.post('/tweet/comment-list', {"mid": mid}, function(data) {
                $.each(data, function(index, comment) {
                    var $media = $('.media:hidden').clone();
                    $media.find('a').attr('href', '/user/' + comment.uid);
                    $media.find('img').attr('src', '/assets/images/UserPic/small/' + comment.avatar);
                    $media.find('h4 a').text(comment.username);
                    $media.find('span').text(comment.content + ' (' + comment.created_at + ')');
                    $media.show();
//                    alert(index);
                    $('p:has(a[mid="' + comment.mid + '"])').after($media);
                });
            }, 'json');
        }
    });
    $('a.retweet').click(function(){
        alert('转发功能开发中');
    });
});