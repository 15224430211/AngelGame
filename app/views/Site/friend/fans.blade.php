@extends('Site.layout.layout')

@section('title') 我的关注 | @stop

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills nav-justified">
                                <li>
                                    <a href="/follow/{{$user_info['uid']}}">{{$user_info['username']}}的关注 
                                        <span class="badge badge-danger">{{$countFollow}}</span>
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="/fans/{{$user_info['uid']}}">{{$user_info['username']}}的粉丝 
                                        <span class="badge">{{$countFans}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @foreach($fans as $fan)
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                                <a href="/user/{{$fan->uid}}">
                                    <img src="/assets/images/UserPic/large/{{$fan->avatar}}">
                                </a>
                                <div class="caption text-center">
                                    <a href="/user/{{$fan->uid}}">
                                        <h3>{{$fan->username}}</h3>
                                    </a>
                                    <!--<p>Cras justo odio...</p>-->
                                    @if($fan->friend_list_id)
                                    <button follower="{{$fan->uid}}" class="btn btn-danger" role="button">取消关注</button>
                                    @elseif(!$fan->friend_list_id)
                                    <button follower="{{$fan->uid}}" class="btn btn-danger" role="button">关注他</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @include('Site.layout.user-info')
    </div>
</div>

</div>
@stop

@section('foot-assets')
<script src="/assets/scripts/Site/friend.js" type="text/javascript"></script>
@stop


