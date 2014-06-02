<?php

class SiteTweetController extends SiteController {

    public function getIndex() {
        return View::make('Site.tweet.index')
                        ->with('tweetList', $this->tweetList())
        ;
    }

    public function postIndex() {
        $tweet_content = new TweetContent();
        $tweet_content->content = Input::get('content');
        $tweet_content->uid = Session::get('user')['uid'];
        $tweet_content->save();
        return Redirect::back();
    }

    public function postCommentList() {
        $mid = Input::get('mid');
        $sql = 'SELECT T1.*,T2.uid,T2.avatar,T2.username FROM ag_tweet_comment T1 LEFT JOIN '
                . 'ag_userdb T2 ON T1.uid = T2.uid WHERE T1.mid = ?';
        echo json_encode(DB::select($sql, array($mid)));
    }
    
    public function retweet(){
        $mid = Input::get('mid');
    }

    protected function tweetList() {
        $sql = 'select T1.*,T2.uid,T2.avatar,T2.username FROM'
                . '(SELECT ag_tweet_content.*,count(ag_tweet_comment.mid) as comment_count FROM ag_tweet_content '
                . 'LEFT JOIN ag_tweet_comment ON ag_tweet_content.mid = ag_tweet_comment.mid where ag_tweet_content.uid in '
                . '(SELECT follow_uid FROM ag_friend_list WHERE uid = ?) '
                . 'or ag_tweet_content.uid = ? GROUP BY ag_tweet_comment.mid) T1 '
                . 'LEFT JOIN ag_userdb T2 ON T1.uid = T2.uid '
                . 'ORDER BY T1.mid DESC';
        $uid = Session::get('user')['uid'];
        return DB::select($sql, array($uid, $uid));
    }

}
