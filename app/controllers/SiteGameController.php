<?php

class SiteGameController extends SiteController {

    public function getIndex($game_uid = null) {
        $game_uid ? "" : die;
        $game_details = GameInfo::find($game_uid)->toArray();
        if ($game_details) {
            $userGameRelation = $this->userGameRelation(Session::get('user')['uid'], $game_uid);
            return View::make('Site.game.detail')
                            ->with('game_details', $game_details)
                            ->with('userGameRelation', $userGameRelation);
        } else {
            die;
        }
    }

    public function postIndex() {
        $input = Input::all();
        $input['status'] = $this->checkStatus($input['status']);
        if (!GameInfo::find($input['game_uid'])) {
            die('找不到此游戏数据');
        }
        $old_userGameRelation = $this->userGameRelation(Session::get('user')['uid'], $input['game_uid']);
        if ($old_userGameRelation) {
            $this->updateStatusNum($input['game_uid'], $input['status'], $old_userGameRelation[0]['play_status']);
            $userGameRelation = UserGameRelation::find($old_userGameRelation[0]['id']);
        } else {
            $this->updateStatusNum($input['game_uid'], $input['status']);
            $userGameRelation = new UserGameRelation();
            $userGameRelation->uid = Session::get('user')['uid'];
            $userGameRelation->game_uid = $input['game_uid'];
        }
        $tags = $this->tagsStringToArray($input['tags']);
        for ($i = 0; $i < 5; $i++) {
            $key = 'tag' . ($i + 1);
            if (!isset($tags[$i])) {
                $userGameRelation->$key = " ";
            } else {
                $userGameRelation->$key = htmlspecialchars($tags[$i]);
            }
        }
        $userGameRelation->score = $this->checkScore($input['score']);
        $userGameRelation->play_status = $input['status'];
        $userGameRelation->comment = htmlspecialchars($input['comment']);
        if ($userGameRelation->save()) {
            echo 'success';
        }
    }

    public function userGameRelation($uid, $game_uid) {
        $userGameRelation = UserGameRelation::whereRaw('uid = ? AND game_uid = ?', array($uid, $game_uid))
                        ->take(1)->get()->toArray();
        empty($userGameRelation) ? "" :
                        $userGameRelation[0]['tags'] = trim($userGameRelation[0]['tag1'] . " "
                        . $userGameRelation[0]['tag2'] . " " . $userGameRelation[0]['tag3'] . " "
                        . $userGameRelation[0]['tag4'] . " " . $userGameRelation[0]['tag5']);
        return $userGameRelation;
    }

    protected function updateStatusNum($game_uid, $new_status, $old_status = null) {
        if (is_null($old_status)) {
            //没有old status
            return GameInfo::find($game_uid)->increment($this->statusToField($new_status));
        } else {
            //有old status
            GameInfo::find($game_uid)->decrement($this->statusToField($old_status));
            return GameInfo::find($game_uid)->increment($this->statusToField($new_status));
        }
    }

}
