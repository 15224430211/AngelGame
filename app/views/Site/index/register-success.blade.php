@extends('Site.layout.layout')

@section('title') 注册成功 | @stop

@section('content')
<div class="container register-panel">
    <div style="background: rgba(255,255,255,.1);">
        <a href="#content" class="sr-only">Skip to main content</a>
        <div class="jumbotron" style="background: rgba(255,255,255,0);color: #FFF;padding: 50px;">
            <h1 style="font-size: 100px;">恭喜您！注册成功！</h1>
            <br>
            <h1>您现在可以用手机号码或者用户名可登录</h1>
            <br>
            <h2>
                <span id="href-second">3</span>秒后跳转到登录页面......
            </h2>
        </div>
    </div>
</div> <!-- /container -->

<script type="text/javascript">
    setInterval("href_second()", 1000);
    var second = 3;
    var href_second = function() {
        if (second < 1) {
            window.location.href = "/";
        } else {
            $("#href-second").text(second);
            second = second - 1;
        }
    };
</script>
@stop

