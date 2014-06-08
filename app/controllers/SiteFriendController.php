<?php

class SiteFriendController extends SiteController {

    public function getFollow($uid = null) {
        !is_null($uid)? : $uid = Session::get('user')['uid'];

//        print_r($this->getFollowerListWithMe($uid));die;
        return View::make('Site.friend.follow')
                        ->with('countFollow', $this->countFollow($uid))
                        ->with('countFans', $this->countFans($uid))
                        ->with('user_info', $this->getUserInfo($uid))
                        ->with('followers', $this->getFollowerListWithMe($uid))
                        ->with('user_relation', $this->checkUserRelation($uid))
        ;
    }

    public function getFans($uid = null) {
        !is_null($uid)? : $uid = Session::get('user')['uid'];

//        print_r($this->getFollowerListWithMe($uid));die;
        return View::make('Site.friend.fans')
                        ->with('countFollow', $this->countFollow($uid))
                        ->with('countFans', $this->countFans($uid))
                        ->with('user_info', $this->getUserInfo($uid))
                        ->with('fans', $this->getFansListWithMe($uid))
                        ->with('user_relation', $this->checkUserRelation($uid))

        ;
    }

    public function postFollow() {
        $follower = Input::get('follower');
        $id = $this->checkUserRelation($follower);
        if ($id) {
            $result = FriendList::find($id)->delete();
        } else {
            $friend_List = new FriendList();
            $friend_List->uid = Session::get('user')['uid'];
            $friend_List->follow_uid = $follower;
            $result = $friend_List->save();
        }
        if ($result) {
            echo 'success';
        } else {
            echo '操作失败,请重试';
        }
    }

    protected function getFollowerList($uid) {
        $sql = 'SELECT ag_userdb.* FROM `ag_friend_list` '
                . 'LEFT JOIN ag_userdb on ag_userdb.uid = ag_friend_list.follow_uid '
                . 'WHERE ag_friend_list.uid = ?';
        return DB::select($sql, array($uid));
    }

    protected function getFollowerListWithMe($uid) {
        $sql = 'SELECT T1.*,T2.id as friend_list_id from (SELECT ag_userdb.* FROM `ag_friend_list` '
                . 'LEFT JOIN ag_userdb on ag_userdb.uid = ag_friend_list.follow_uid '
                . 'WHERE ag_friend_list.uid = ?) T1 LEFT JOIN ag_friend_list T2 '
                . 'ON T2.uid = ? AND T2.follow_uid = T1.uid';
        return DB::select($sql, array($uid, Session::get('user')['uid']));
    }

    protected function getFansListWithMe($uid) {
        $sql = 'SELECT T1.*,T2.id as friend_list_id from (SELECT ag_userdb.* FROM `ag_friend_list` '
                . 'LEFT JOIN ag_userdb on ag_userdb.uid = ag_friend_list.uid '
                . 'WHERE ag_friend_list.follow_uid = ?) T1 LEFT JOIN ag_friend_list T2 '
                . 'ON T2.uid = ? AND T2.follow_uid = T1.uid';
        return DB::select($sql, array($uid, Session::get('user')['uid']));
    }

}
