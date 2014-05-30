$(function() {
    $("input[name='username']").change(function() {
        $('.alert').hide();
        $.post('/index/register-username', {"username": $("input[name='username']").val()}, function(data) {
            if (data !== 'success') {
                $('.alert').text(data).show();
            }
        });
    });
    $("input[name='email']").change(function() {
        $('.alert').hide();
        $.post('/index/register-email', {"email": $("input[name='email']").val()}, function(data) {
            if (data !== 'success') {
                $('.alert').text(data).show();
            }
        });
    });
    $("form").submit(function() {
        $('.alert').hide();
        var username_valid = function() {
            return $("input[name='username']").val().length;
        };
        var email_valid = function() {
            var reg = /^[a-z\d]+(\.[a-z\d]+)*@([\da-z](-[\da-z])?)+(\.{1,2}[a-z]+)+$/;
            return reg.test($("input[name='email']").val());
        };
        var password_valid = function() {
            var reg = /^[a-z0-9_-]{6,20}$/;
            return reg.test($("input[name='password']").val());
        };
        if (!username_valid()) {
            $('.alert').text('用户名不符合格式要求').show();
            return false;
        } else {
            $("input[name='username']").parent("div").addClass('has-success');
        }
        if (!email_valid()) {
            $('.alert').text('Email不符合格式要求').show();
            return false;
        } else {
            $("input[name='username']").parent("div").addClass('has-success');
        }
        if ($('#password').val() !== $('#passwordconfirm').val()) {
            $('.alert').text('两次密码输入不一致').show();
            return false;
        } else if (!password_valid()) {
            $('.alert').text('密码不符合格式要求').show();
            return false;
        } else {
            $(":password").parent("div").addClass('has-success');
        }
    });
});