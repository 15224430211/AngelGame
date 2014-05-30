@extends('Site.layout.layout')

@section('title') {{$user_info['username']}} | @stop

@section('content')
<div class="container">
    @include('Site.layout.search-bar')

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default user-game-list">
                <div class="panel-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <h4>正在玩的游戏······<a href="/user/{{$user_info['uid']}}/playing">({{$playing_num}})部</a></h4>
                        </div>
                    </div><!--playing-->
                    <div class="row">
                        @foreach($playing_games as $playing_game)
                        <div class="col-md-2">
                            <div class="thumbnail" title="{{$playing_game->name_1}}&#10;{{$playing_game->name_2}}">
                                <a href="/game/{{$playing_game->game_uid}}" game_uid="{{$playing_game->game_uid}}">
                                    <img data-src="holder.js/300x200" src="/assets/images/GamePic/{{$playing_game->game_pic}}">
                                </a>
                                <div class="caption text-center">
                                    <a href='#'><b>{{$playing_game->name_1}}</b></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4>已经玩过的游戏······<a href="/user/{{$user_info['uid']}}/played">({{$played_num}})部</a></h4>
                        </div>
                    </div><!--played-->
                    <div class="row">
                        @foreach($played_games as $played_game)
                        <div class="col-md-2">
                            <div class="thumbnail" title="{{$played_game->name_1}}&#10;{{$played_game->name_2}}">
                                <a href="/game/{{$played_game->game_uid}}" game_uid="{{$played_game->game_uid}}">
                                    <img data-src="holder.js/300x200" src="/assets/images/GamePic/{{$played_game->game_pic}}">
                                </a>
                                <div class="caption text-center">
                                    <a href='#'><b>{{$played_game->name_1}}</b></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4>想玩的游戏······<a href="/user/{{$user_info['uid']}}/want">({{$play_want_num}})部</a></h4>
                        </div>
                    </div><!--want-->
                    <div class="row">
                        @foreach($play_want_games as $play_want_game)
                        <div class="col-md-2">
                            <div class="thumbnail" title="{{$play_want_game->name_1}}&#10;{{$play_want_game->name_2}}">
                                <a href="/game/{{$play_want_game->game_uid}}" game_uid="{{$play_want_game->game_uid}}">
                                    <img data-src="holder.js/300x200" src="/assets/images/GamePic/{{$play_want_game->game_pic}}">
                                </a>
                                <div class="caption text-center">
                                    <a href='#'><b>{{$play_want_game->name_1}}</b></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img class="img-rounded" src="/assets/images/UserPic/medium/{{$user_info['avatar']}}">
                        </div>
                        <div class="col-md-7 text-center">
                            <strong class="text-primary">
                                常居：{{$user_info['address']}}<br>
                                {{$user_info['username']}}<br>
                                {{substr($user_info['created_at'],0,10)}}加入
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

