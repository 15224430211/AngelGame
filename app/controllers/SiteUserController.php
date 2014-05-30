<?php

class SiteUserController extends SiteController {

    public function getIndex($uid = null) {
        !is_null($uid)? : $uid = Session::get('user')['uid'];
        $user_info = $this->getUserInfo($uid);
        $play_want_games = $this->getPlayStatus($uid, 1, true);
        $playing_games = $this->getPlayStatus($uid, 2, true);
        $played_games = $this->getPlayStatus($uid, 3, true);

        $play_want_num = $this->countPlayStatus($uid, 1);
        $playing_num = $this->countPlayStatus($uid, 2);
        $played_num = $this->countPlayStatus($uid, 3);
        return View::make('Site.user.index')
                        ->with('play_want_num', $play_want_num)
                        ->with('playing_num', $playing_num)
                        ->with('played_num', $played_num)
                        ->with('play_want_games', $play_want_games)
                        ->with('playing_games', $playing_games)
                        ->with('played_games', $played_games)
                        ->with('user_info', $user_info)
        ;
    }

    public function getGameList($uid, $play_status) {
        $games_info = $this->getPlayStatus($uid, $this->transformStatus($play_status));
        return View::make('Site.user.game-list')
                        ->with('games_info', $games_info);
    }

    //get one user info by uid
    protected function getUserInfo($uid) {
        return Userdb::where('uid', $uid)->first();
    }

    //three status count
    public function countPlayStatus($uid, $play_status) {
        return UserGameRelation::whereRaw('uid = ? AND play_status = ?', array($uid, $play_status))->count();
    }

    //three status details
    protected function getPlayStatus($uid, $play_status, $is_limit = null) {
        $sql = 'select T1.play_status, T1.updated_at, T2.* from ag_game_info T2, '
                . '(select game_uid,play_status,updated_at from ag_user_game_relation '
                . 'where uid = ? AND play_status = ? order by updated_at desc';
        is_null($is_limit) ? : $sql.=' limit 5';
        $sql.=') T1 where T2.game_uid = T1.game_uid';
        return DB::select($sql, array($uid, $play_status));
    }

    public function ajaxUserGameRelation() {
        $game_uid = Input::get('game_uid');
        strlen($game_uid) ? : die;
        $userGameRelation = UserGameRelation::whereRaw('uid = ? AND game_uid = ?', array(Session::get('user')['uid'], $game_uid))
                        ->take(1)->get()->toArray();
        if (empty($userGameRelation)) {
            echo json_encode("");
        } else {
            $userGameRelation[0]['tags'] = trim($userGameRelation[0]['tag1'] . " "
                    . $userGameRelation[0]['tag2'] . " " . $userGameRelation[0]['tag3'] . " "
                    . $userGameRelation[0]['tag4'] . " " . $userGameRelation[0]['tag5']);
            echo json_encode($userGameRelation[0]);
        }
    }

}
