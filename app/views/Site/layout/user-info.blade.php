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
            <hr class="hr-margin-10">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="/follow/{{$user_info['uid']}}">关注 
                                <span class="badge badge-info">{{$countFollow}}</span>
                            </a></li>
                        <li><a href="/fans/{{$user_info['uid']}}">粉丝 
                                <span class="badge badge-info">{{$countFans}}</span>
                            </a></li>
                        <li><a href="#">广播 
                                <span class="badge badge-info">42</span>
                            </a></li>
                    </ul>                         
                </div>
            </div>
            @if($user_info['uid'] != Session::get('user')['uid'])
            <hr class="hr-margin-10">
            <div class="row">
                <div class="col-md-12 text-center">
                    @if(!$user_relation)
                    <button data-loading-text="请等待..." follower="{{$user_info['uid']}}" class="btn btn-danger" role="button">
                        <span class="glyphicon glyphicon-plus"></span> 关注</button>
                    @else
                    <div class="btn-group">
                        <button disabled follower="{{$user_info['uid']}}" class="btn btn-danger" role="button">已关注 
                            <span class="glyphicon glyphicon-ok"></span>
                        </button>
                        <button data-loading-text="请等待..." follower="{{$user_info['uid']}}" class="btn btn-danger" role="button">取消关注</button>
                    </div>
                    @endif  
                </div>
            </div>
            @else
            <hr class="hr-margin-10">
            <div class="row">
                <div class="col-md-12 text-center">
                    <button id="edit-intro" class="btn btn-danger" role="button">
                        <span class="glyphicon glyphicon-edit"></span> 编辑介绍</button>
                    <div class="btn-group" style="display: none;">
                        <button data-loading-text="保存中..." id="save-intro" class="btn btn-danger" role="button">
                            <span class="glyphicon glyphicon-ok"></span> 保存介绍
                        </button>
                        <button id="cancel-intro" data-loading-text="请等待..." class="btn btn-danger" role="button">
                            <span class="glyphicon glyphicon-remove"></span> 取消编辑
                        </button>
                    </div>
                </div>
            </div>
            @endif
            <hr class="hr-margin-10">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p id="content-intro">{{$user_info->intro}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@section('foot-assets')
@parent
<script src="/assets/scripts/Site/user-info.js" type="text/javascript"></script>
@stop