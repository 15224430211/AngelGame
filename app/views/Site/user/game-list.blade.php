@extends('Site.layout.layout')

@section('title') 搜索 用户 | @stop

@section('content')
<div class="container">

    @include('Site.layout.search-bar')

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    @foreach($games_info as $game_info)
                    <div class="row game-list">
                        <div class="col-md-2">
                            <a href="/game/{{$game_info->game_uid}}" class="thumbnail">
                                <img src="/assets/images/GamePic/{{$game_info->game_pic}}" data-src="holder.js/100%x180" alt="...">
                            </a>
                        </div>
                        <div class="col-md-10">
                            <a href="/game/{{$game_info->game_uid}}">
                                <p>{{$game_info->name_1}}{{$game_info->name_2 ? ' / ':""}}{{$game_info->name_2}}</p>
                            </a>
                            <p>游戏类型:{{$game_info->Categories}}<br>
                                游戏平台:{{$game_info->Platform}}<br>
                                出版日期:{{$game_info->pub_date}}<br>
                                综合评分:{{$game_info->score_avg ? round($game_info->score_avg,1) : "无"}}</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="play-status-buttons">
                                        @if(empty($game_info->play_status))
                                        <button game-uid="{{$game_info->game_uid}}" data-toggle="modal" data-target="#status-modal" class="btn btn-info btn-sm play-want">我想玩</button>
                                        <button game-uid="{{$game_info->game_uid}}" data-toggle="modal" data-target="#status-modal" class="btn btn-primary btn-sm playing">我正在玩</button>
                                        <button game-uid="{{$game_info->game_uid}}" data-toggle="modal" data-target="#status-modal" class="btn btn-success btn-sm played">我玩过</button>
                                        @elseif($game_info->play_status == 1)   
                                        <button game-uid="{{$game_info->game_uid}}" data-toggle="modal" data-target="#status-modal" class="btn btn-info btn-sm play-want" disabled>我想玩这个游戏</button>
                                        <button game-uid="{{$game_info->game_uid}}" data-toggle="modal" data-target="#status-modal" class="btn btn-primary btn-sm playing">我正在玩</button>
                                        <button game-uid="{{$game_info->game_uid}}" data-toggle="modal" data-target="#status-modal" class="btn btn-success btn-sm played">我玩过</button>
                                        @elseif($game_info->play_status == 2)
                                        <button game-uid="{{$game_info->game_uid}}" data-toggle="modal" data-target="#status-modal" class="btn btn-primary btn-sm playing" disabled>我正在玩这个游戏</button>
                                        <button game-uid="{{$game_info->game_uid}}" data-toggle="modal" data-target="#status-modal" class="btn btn-success btn-sm played">我玩过</button>
                                        @elseif($game_info->play_status == 3)
                                        <button game-uid="{{$game_info->game_uid}}" data-toggle="modal" data-target="#status-modal" class="btn btn-success btn-sm played">我玩过这个游戏</button>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hr-margin-10">
                    @endforeach
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

@include('Site.layout.status-modal')
@stop

@section('foot-assets')
<script src="/assets/scripts/Site/search.js" type="text/javascript"></script>
@stop