<?php

class SiteController extends BaseController {

    //get one user info by uid
    protected function getUserInfo($uid) {
        return Userdb::where('uid', $uid)->first();
    }

    protected function checkUserRelation($follower) {
        return FriendList::whereRaw('uid = ? AND follow_uid = ?', array(Session::get('user')['uid'], $follower))
                        ->pluck('id');
    }

    protected function countFollow($uid) {
        return FriendList::where('uid', $uid)->count();
    }

    protected function countFans($uid) {
        return FriendList::where('follow_uid', $uid)->count();
    }

    protected function transformStatus($status) {
        switch ($status) {
            case 'want':
                return 1;
            case 'playing':
                return 2;
            case 'played':
                return 3;
            default :
                exit();
        }
    }

    protected function checkScore($score) {
        $score = (int) $score;
        if ($score <= 10 && $score > 0) {
            return $score;
        } else {
            return 0;
        }
    }

    protected function checkStatus($status) {
        $status = (int) $status;
        if ($status == 1 || $status == 2 || $status == 3) {
            return $status;
        } else {
            return null;
        }
    }

    protected function statusToField($status) {
        switch ($status) {
            case 1:
                return 'play_want_num';
            case 2:
                return 'playing_num';
            case 3:
                return 'played_num';
        }
    }

    protected function tagsStringToArray($tags) {
        if ($tags) {
            for ($i = 0; $i < 5; $i++) {
                $tags = trim($tags);
                $tagarr = explode(" ", $tags, 2);
                $tagresult[] = $tagarr[0];
                if (isset($tagarr[1])) {
                    $tags = $tagarr[1];
                } else {
                    break;
                }
            }
            return $tagresult;
        } else {
            return array();
        }
    }

}
