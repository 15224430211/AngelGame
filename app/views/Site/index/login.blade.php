@extends('Site.layout.layout')

@section('title') 登录 | @stop

@section('content')

<div class="container login-panel">
    <div class="col-md-6">
        <form action="/index" method="post" class="form-signin" role="form">
            <h2 class="text-center form-signin-heading">进入天使游戏</h2>
            <hr>
            <div class="form-search search-only">
                <i class="search-icon glyphicon glyphicon-user"></i>
                <input name="email" type="text" class="form-control" placeholder="Email" required autofocus>
            </div>
            <div class="form-search search-only">
                <i class="search-icon glyphicon glyphicon-lock"></i>
                <input name="password" type="password" class="form-control" placeholder="密码" required>
            </div>
            {{Form::token();}}
            <!--            <label class="checkbox">
                            <input type="checkbox" name="remember-me" value="remember-me"> 记住我
                        </label>-->
            <hr>
            <div class="row text-center">
                <button class="btn btn-lg btn-primary" type="submit">
                    <span class="glyphicon glyphicon-chevron-right"></span> 进入
                </button>
                <a href="/index/register" class="btn btn-lg btn-success" type="submit">注册用户</a>
            </div>
        </form>
    </div>
</div> <!-- /container -->

@stop