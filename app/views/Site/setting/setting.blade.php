@extends('Site.layout.layout')

@section('title') 设置 | @stop

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8">
            <div class="panel">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#change-avatar" data-toggle="tab">更换头像</a></li>
                    <li><a href="#change-profile" data-toggle="tab">修改资料</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="change-avatar">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-8 text-center">
                                {{ Form::open(array('url'=>'/setting/avatar','method' => 'PUT', 'files' => true, 'class'
                                => 'form')) }}
                                <h1><span class="label label-info">更改头像</span></h1>
                                <hr>
                                <img class="img-thumbnail" width="220" height="220"
                                     src="/assets/images/UserPic/large/{{ Session::get('user')->avatar }}" alt="头像（大）">
                                <img class="img-thumbnail" width="128" height="128"
                                     src="/assets/images/UserPic/medium/{{ Session::get('user')->avatar }}" alt="头像（中）">
                                <img class="img-thumbnail" width="64" height="64"
                                     src="/assets/images/UserPic/small/{{ Session::get('user')->avatar }}" alt="头像（小）">
                                <hr>
                                {{ Form::file('avatar') }}
                                <hr>
                                <button class="btn btn-lg btn-primary btn-block" type="submit">上传头像</button>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="change-profile">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-8 text-center">
                                {{ Form::open(array('url'=>'/setting','method' => 'PUT', 'class' => 'form')) }}
                                <h1><span class="label label-info">修改资料</span></h1>
                                <hr>
                                <div class="input-group">
                                    <span class="input-group-addon">常住地</span>
                                    <input value="{{Session::get('user')['address']}}" name="address" type="text"
                                           class="form-control" placeholder="常住地" required>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" data-toggle="popover"
                                                data-content="最长15个汉字">?
                                        </button>
                                    </span>
                                </div>
                                <hr>
                                <button class="btn btn-lg btn-primary btn-block" type="submit">确认修改资料</button>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@stop
@section('foot-assets')
<script type="text/javascript">
    $(function () {
        $('[data-toggle]').popover({container: 'body'});
    });
</script>
@stop


