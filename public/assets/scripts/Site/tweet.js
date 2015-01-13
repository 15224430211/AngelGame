$(function () {
    $('textarea').focus(function () {
        $(this).attr('rows', 3);
    });
    $('textarea').keydown(function () {
        $('.tweet-length').text(140 - $(this).val().length);
    });
    $('form').submit(function () {
        if ($('textarea[name]').val().length < 1) {
            $('textarea[name]').attr('placeholder', '输入的内容为空！')
                .css('background-color', 'rgb(255,230,230)');
            return false;
        }
    });
    $('a.show-comment').click(function () {
        if ($(this).parent().next().is(':hidden')) {
            $(this).parent().nextAll('div.media:hidden,#comment-div:hidden').show();
        } else if ($(this).parent().next().is(':visible')) {
            $(this).parent().nextAll('div.media:visible,#comment-div:visible').hide();
        } else {
            var mid = $(this).attr('mid');
            installComment(mid);
        }
    });
    $('#comment-ok').click(function () {
        var mid = $(this).attr('mid');
        var content = $(this).parent().prev(':text').val();
        if (content.length < 1 || mid.length < 1) {
            $(this).parent().prev(':text').attr('placeholder', '输入的内容为空！')
                .css('background-color', 'rgb(255,230,230)');
            return false;
        }
        var json = {
            "mid": $(this).attr('mid'),
            "content": content
        };
        $.post('/tweet/comment-submit', json, function (data) {
            if (data === 'success') {
                $('.media[mid="' + mid + '"],#comment-div[mid="' + mid + '"]').remove();
                $('a.show-comment[mid="' + mid + '"] span').text(parseInt($('a[mid="' + mid + '"] span').text()) + 1);
                installComment(mid);
            } else {
                alert(data);
            }
        });
    });
    $('a.retweet').click(function () {
        alert('转发功能开发中');
    });
});

var installComment = function (mid) {
    var $comment_div = $('#comment-div').clone(true).attr('mid', mid);
    $comment_div.attr('mid', mid).show();
    $comment_div.find('button').attr('mid', mid);
    $('p:has(a[mid="' + mid + '"])').after($comment_div);
    $.post('/tweet/comment-list', {"mid": mid}, function (data) {
        $.each(data, function (index, comment) {
            var $comment = $('.media:hidden').first().clone().attr('mid', mid);
            $comment.find('a').attr('href', '/user/' + comment.uid);
            $comment.find('img').attr('src', '/assets/images/UserPic/small/' + comment.avatar);
            $comment.find('h4 a').text(comment.username);
            $comment.find('span').text(comment.content + ' (' + comment.created_at + ')');
            $comment.show();
//                    alert(index);
            $('p:has(a[mid="' + comment.mid + '"])').after($comment);
        });
    }, 'json');
};