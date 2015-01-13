@extends('Site.layout.layout')

@section('title') {{$game_details['name_1']}} | @stop

@section('content')
<div class="container">
    @include('Site.layout.search-bar')

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <div class="thumbnail">
                                <img src="/assets/images/GamePic/{{$game_details['game_pic']}}"
                                     data-src="holder.js/300x200" alt="...">

                                <div class="caption">
                                    <a style="text-decoration:line-through;" href="/game/{{$game_details['game_uid']}}/edit" class="btn btn-default disabled" role="button">上传图片或信息</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>游戏名称:{{$game_details['name_1']}}</h5>

                            <p>
                                游戏别名 | 外文名称 : {{$game_details['name_2']}}<br>
                                游戏类型 : {{$game_details['Categories']}}<br>
                                游戏平台 : {{$game_details['Platform']}}<br>
                                游戏开发 : {{$game_details['Developer']}}<br>
                                出版公司 : {{$game_details['publisher']}}<br>
                                出版时间 : {{$game_details['pub_date']}}<br>
                            </p>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-info text-center">
                                <div class="panel-heading">
                                    <p class="panel-title"><b>游戏统计</b></p>
                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item">{{$game_details['play_want_num']}}人想玩</li>
                                    <li class="list-group-item">{{$game_details['playing_num']}}人在玩</li>
                                    <li class="list-group-item">{{$game_details['played_num']}}人玩过</li>
                                    <li class="list-group-item">玩家评分:
                                        <span class="player-score badge badge-primary">{{$game_details['score_avg'] ? round($game_details['score_avg'],1) : "无"}}</span>
                                    </li>
                                    <li class="list-group-item">我的评分:
                                        <span class="user-score badge badge-primary">
                                            @if(empty($userGameRelation))
                                            0
                                            @elseif(isset($userGameRelation[0]['score']))
                                            {{$userGameRelation[0]['score']}}
                                            @else
                                            0
                                            @endif
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <p class="play-status-buttons">
                                @if(empty($userGameRelation))
                                <button game-uid="{{$game_details['game_uid']}}" data-toggle="modal"
                                        data-target="#status-modal" class="btn btn-info btn-sm play-want">我想玩
                                </button>
                                <button game-uid="{{$game_details['game_uid']}}" data-toggle="modal"
                                        data-target="#status-modal" class="btn btn-primary btn-sm playing">我正在玩
                                </button>
                                <button game-uid="{{$game_details['game_uid']}}" data-toggle="modal"
                                        data-target="#status-modal" class="btn btn-success btn-sm played">我玩过
                                </button>
                                @elseif($userGameRelation[0]['play_status'] == 1)
                                <button game-uid="{{$game_details['game_uid']}}" data-toggle="modal"
                                        data-target="#status-modal" class="btn btn-info btn-sm play-want" disabled>
                                    我想玩这个游戏
                                </button>
                                <button game-uid="{{$game_details['game_uid']}}" data-toggle="modal"
                                        data-target="#status-modal" class="btn btn-primary btn-sm playing">我正在玩
                                </button>
                                <button game-uid="{{$game_details['game_uid']}}" data-toggle="modal"
                                        data-target="#status-modal" class="btn btn-success btn-sm played">我玩过
                                </button>
                                @elseif($userGameRelation[0]['play_status'] == 2)
                                <button game-uid="{{$game_details['game_uid']}}" data-toggle="modal"
                                        data-target="#status-modal" class="btn btn-primary btn-sm playing" disabled>
                                    我正在玩这个游戏
                                </button>
                                <button game-uid="{{$game_details['game_uid']}}" data-toggle="modal"
                                        data-target="#status-modal" class="btn btn-success btn-sm played">我玩过
                                </button>
                                @elseif($userGameRelation[0]['play_status'] == 3)
                                <button game-uid="{{$game_details['game_uid']}}" data-toggle="modal"
                                        data-target="#status-modal" class="btn btn-success btn-sm played">我玩过这个游戏
                                </button>
                                @endif
                            </p>
                        </div>
                    </div>
                    @if(!empty($userGameRelation))
                    <div class="row">
                        <div class="col-md-12">
                            <p tags="{{$userGameRelation[0]['tags']}}" class="old-tags">我的标签 :
                                @foreach(explode(" ", $userGameRelation[0]['tags']) as $tag)
                                <span class="label label-info">{{$tag}}</span>
                                @endforeach
                            </p>
                        </div>
                    </div>
                    @if(isset($userGameRelation[0]['comment']))
                    <div class="row">
                        <div class="col-md-12">
                            <p comment="{{$userGameRelation[0]['comment']}}">我的评论 :
                                {{$userGameRelation[0]['comment']}}</p>
                        </div>
                    </div>
                    @endif
                    @endif
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>游戏描述······</h5>

                            <p class="game-description">{{$game_details['description']}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>喜欢此游戏的人也喜欢······</h5>
                            <div class="row user-game-list">
                                @foreach($recommend_games as $recommend_game)
                                <div class="col-md-2">
                                    <div class="thumbnail" title="{{$recommend_game->name_1}}&#10;{{$recommend_game->name_2}}">
                                        <a href="/game/{{$recommend_game->game_uid}}" game_uid="{{$recommend_game->game_uid}}">
                                            <img data-src="holder.js/300x200"
                                                 src="/assets/images/GamePic/{{$recommend_game->game_pic}}">
                                        </a>

                                        <div class="caption text-center">
                                            <a href='#'><b>{{$recommend_game->name_1}}</b></a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>游戏图赏······</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>游戏评论······</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>游戏攻略······</h5>
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

@include('Site.layout.status-modal')
@stop

@section('foot-assets')
<script src="/assets/scripts/Site/detail.js" type="text/javascript"></script>
@stop