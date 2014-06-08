@extends('Site.layout.layout')

@section('title') 我的关注 | @stop

@section('content')
<div class="container">

    @include('Site.layout.search-bar')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills nav-justified">
                                <li class="active">
                                    <a href="/follow/{{$user_info['uid']}}">{{$user_info['username']}}的关注
                                        <span class="badge">{{$countFollow}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/fans/{{$user_info['uid']}}">{{$user_info['username']}}的粉丝
                                        <span class="badge badge-danger">{{$countFans}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @foreach($followers as $follower)
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                                <a href="/user/{{$follower->uid}}">
                                    <img src="/assets/images/UserPic/large/{{$follower->avatar}}">
                                </a>

                                <div class="caption text-center">
                                    <a href="/user/{{$follower->uid}}">
                                        <h3>{{$follower->username}}</h3>
                                    </a>
                                    <!--<p>Cras justo odio...</p>-->
                                    @if($follower->friend_list_id)
                                    <button follower="{{$follower->uid}}" class="btn btn-danger" role="button">取消关注
                                    </button>
                                    @elseif(!$follower->friend_list_id)
                                    <button follower="{{$follower->uid}}" class="btn btn-danger" role="button">关注他
                                    </button>
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


