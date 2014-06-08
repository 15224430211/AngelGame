@extends('Site.layout.layout')

@section('title') 注册 | @stop

@section('content')

<div class="container register-panel">

    <div class="panel panel-info">
        <div class="panel-body">
            <div class="col-md-offset-2 col-md-8">
                <h4 class="text-info text-center">注册天使游戏</h4>
                <hr>
                <div class="alert alert-danger text-center" style="display: none;"></div>
                <form id="register-form" action="/register" method="post" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="username" class="col-lg-2 control-label">用户名</label>

                        <div class="col-lg-9">
                            <input name="username" type="text" class="form-control" id="username"
                                   placeholder="用户名为1-20位" autofocus required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-lg-2 control-label">Email</label>

                        <div class="col-lg-9">
                            <input name="email" type="text" class="form-control" id="email"
                                   placeholder="请输入您的Email 用于登录和找回密码" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">密码</label>

                        <div class="col-lg-9">
                            <input name="password" type="password" class="form-control" id="password"
                                   placeholder="密码应为6-20位字母或数字" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="passwordconfirm" class="col-lg-2 control-label">确认密码</label>

                        <div class="col-lg-9">
                            <input type="password" class="form-control" id="passwordconfirm" placeholder="请再次输入一遍密码"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-5">
                            <button type="submit" class="btn btn-lg btn-info">注册用户</button>
                        </div>
                        <div class="col-lg-2">
                            <a href="/" class="btn btn-lg btn-success">返回首页</a>
                        </div>
                    </div>
                    {{Form::token();}}
                </form>
            </div>

        </div>
    </div>

</div> <!-- /container -->

@stop

@section('foot-assets')
<script type="text/javascript" src="/assets/scripts/Site/register.js"></script>
@stop
