@extends('Site.layout.layout')

@section('title') 友邻广播 | @stop

@section('content')
<div class="container">

    @include('Site.layout.search-bar')

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="/tweet" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="content" style="margin-bottom: 5px;" class="form-control" rows="1" maxlength="140" placeholder="请输入要分享的内容,最大长度140字"></textarea>               
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7"></div>
                            <div class="col-md-4">
                                <h6 class="text-success">还可以输入<span class="tweet-length">140</span>个字</h6>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-lg btn-primary pull-right">分享广播</button>
                            </div>
                        </div>
                    </form>
                    <hr class="hr-margin-10">
                    <div class="row">
                        @foreach($tweetList as $tweet)
                        <div class="col-md-12">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img src="/assets/images/UserPic/small/{{$tweet->avatar}}" class="media-object" data-src="holder.js/64x64" alt="64x64">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#">{{$tweet->username}}({{substr($tweet->updated_at,0,10)}})</a></h4>                                    
                                    <p>{{$tweet->content}}</p>
                                    <p>
                                        <a mid="{{$tweet->mid}}" href="javascript:void(0)" class="label label-info show-comment">回复(<span>{{$tweet->replies}}</span>)</a>
                                        <a mid="{{$tweet->mid}}" href="javascript:void(0)" class="label label-info retweet"><span class="glyphicon glyphicon-remove"></span> 转播</a>
                                    </p>
                                </div>
                            </div>
                            <hr class="hr-margin-10">
                        </div>
                        @endforeach
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
<!--hidden-->
<div class="media" style="display: none;">
    <a class="pull-left" href="#">
        <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAABN0lEQVR4Xu2YQQ6EIAxFdeXFODZnYu9qJk5C0sGiUiAx8FyKVPr76VPWEMJnmfhaEQAHsAXoARP3wIUmCAWgABSAAlBgYgXAIBgEg2AQDE4MAX6GwCAYBINgEAyCwYkVAIO1GPTe//nHOXfyU3xGG9PM1yNmzuRVDpCJ5ZKUyTwRoEfMqx3eTIBcJbdtW/Z9/w2XCtAqZncB5Atkkkc1NQFileVYFCi1fypcLqa1jzd1QM6+2va4EycKWRLTIkI3AY7FPKmmVmF5LxXvLmapCF0FiItp5QCZXClZulBAq/IVBtN9rvUAa8zSysfnqxxgfemb5iFA7Zfgm6ppWQsOwAEciXEkxpGYpXuOMgcKQAEoAAWgwCgd3ZIHFIACUAAKQAFL9xxlDhSAAlAACkCBUTq6JY/pKfAFwO6XkLwNdToAAAAASUVORK5CYII=" style="width: 64px; height: 64px;">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><a href="#">Nested media heading</a></h4>
        <span>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
        </span>
    </div>
</div>

<div id="comment-div" style="display: none;">
    <hr class="hr-margin-10">
    <div class="input-group">
        <input type="text" class="form-control search-query">
        <span class="input-group-btn">
            <button id="comment-ok" type="button" class="btn btn-primary" data-type="last">回复</button>
        </span>
    </div>
</div>

@stop

@section('foot-assets')
<script src="/assets/scripts/Site/tweet.js" type="text/javascript"></script>
@stop