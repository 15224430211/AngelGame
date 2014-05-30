$(document).ready(function() {
    var score = $(".user-score").text();
    $(".play-want,.playing,.played").click(function() {
        //初始化星级显示
        $(".star").removeClass("star-black");
        $(".star").removeClass("star-light");
        if (score !== 0) {
            $(".star").eq(score - 1).nextAll(".star").addClass("star-black");
            $(".star").eq(score - 1).addClass("star-light");
            $(".star").eq(score - 1).prevAll(".star").addClass("star-light");
        }
        $("#userplay_score").text(score + '分');
        $("#new-tags").val($("p[tags]").attr('tags'));
        $('#new-comment').val($("p[comment]").attr('comment'));
        $('#hidden-score').val(score);
        //获取game-uid，写入hidden
        $('#hidden-game-uid').val($(this).attr('game-uid'));
    });

    //传入用户选择的状态按钮
    $(".play-status-buttons button").click(function() {
        $("#status-modal label").removeClass('active');
    });
    $(".play-want, #play_status1").click(function() {
        $("#hidden-play-status").val("1");
        $("#play_status1").addClass('active');
    });
    $(".playing, #play_status2").click(function() {
        $("#hidden-play-status").val("2");
        $("#play_status2").addClass('active');
    });
    $(".played, #play_status3").click(function() {
        $("#hidden-play-status").val("3");
        $("#play_status3").addClass('active');
    });

    //显示综合游戏星级评分图片
    $(".score").each(function() {
        var num = Math.round($(this).text() / 2);
        $(this).prev().attr("src", "/assets/images/img/score/" + num + "_star.gif");
    });

    //显示用户游戏星级评分图片
    var num = Math.round(parseFloat(score) / 2);
    for (i = 1; i <= num; i++) {
        var starid = 'star' + i;
        document.getElementById(starid).setAttribute("src", "/assets/images/img/score/light_star.gif");
    }//end of forloop

    //选择星星
    $(".star").mouseover(function() {
        $(this).addClass("star-click");
        $(this).nextAll(".star").addClass("star-black");
        $(this).prevAll(".star").addClass("star-click");

    });
    $(".star").mouseout(function() {
        $(".star").removeClass("star-click");
        $(".star").removeClass("star-black");
    });


    //点击星星
    $(".star").click(function() {
        $(this).nextAll(".star").removeClass("star-light");
        $(this).nextAll(".star").addClass("star-black");
        $(this).addClass("star-light");
        $(this).prevAll(".star").addClass("star-light");
        var score = parseInt(($(this).attr("id")[4])) + 1;
        $("#userplay_score").text(score + '分');
        $("#hidden-score").val(score);
    });

    //status-modal-submit
    $('#status-modal-submit').click(function() {
        var hidden_score = $('#hidden-score').val().trim();
        var hidden_game_uid = $('#hidden-game-uid').val();
        var hidden_play_status = $('#hidden-play-status').val();
        var new_tags = $("#new-tags").val();
        var new_comment = $('#new-comment').val();
        if (!hidden_score || !hidden_game_uid || !hidden_play_status) {
            alert('系统出错,暂时无法提交');
            return false;
        }
        var json = {
            "score": hidden_score,
            "game_uid": hidden_game_uid,
            "status": hidden_play_status,
            "tags": new_tags,
            "comment": new_comment
        };
        $.post("/game", json, function(data) {
            if (data === 'success') {
                window.location.reload();
            } else {
                alert('提交失败,可能是服务器正在维护');
                return false;
            }
        });
    });

});//end of jQuery

