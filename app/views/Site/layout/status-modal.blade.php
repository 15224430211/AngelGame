<div class="modal" id="status-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">收藏游戏</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn-group btn-group-justified" data-toggle="buttons">
                                    <label class="btn btn-default" id="play_status1">
                                        <input type="radio" name="options"> 想玩
                                    </label>
                                    <label class="btn btn-default" id="play_status2">
                                        <input type="radio" name="options"> 正在玩
                                    </label>
                                    <label class="btn btn-default" id="play_status3">
                                        <input type="radio" name="options"> 玩过
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="new-tags">游戏标签:</label>
                                <input id="new-tags" type="text" class="form-control" placeholder="多个标签用空格隔开,最多五个">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="star">
                            <p><strong>游戏评分:</strong></p>
                            <div class="star" id="star0"></div>
                            <div class="star" id="star1"></div>
                            <div class="star" id="star2"></div>
                            <div class="star" id="star3"></div>
                            <div class="star" id="star4"></div>
                            <div class="star" id="star5"></div>
                            <div class="star" id="star6"></div>
                            <div class="star" id="star7"></div>
                            <div class="star" id="star8"></div>
                            <div class="star" id="star9"></div>
                            <hr>
                            <p><b>我的评分: <span id="userplay_score"></span></b></p>
                        </div>    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label>游戏短评:</label>
                        <textarea id="new-comment" class="form-control" rows="3" maxlength="200" placeholder="请不要超过200个字符"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input id="hidden-score" type="hidden" value="">
                <input id="hidden-play-status" type="hidden" value="">
                <input id="hidden-game-uid" type="hidden" value="">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button id="status-modal-submit" type="button" class="btn btn-success"  data-loading-text="正在加载...">保存</button>
            </div>
        </div>
    </div>
</div>