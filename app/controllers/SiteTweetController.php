<?php

class SiteTweetController extends SiteController
{

    public function getIndex()
    {
        return View::make('Site.tweet.index')
            ->with('tweetList', $this->tweetList());
    }

    public function postIndex()
    {
        $tweet_content = new TweetContent();
        $tweet_content->content = Input::get('content');
        $tweet_content->uid = Session::get('user')['uid'];
        $tweet_content->save();
        return Redirect::back();
    }

    public function postCommentList()
    {
        $mid = Input::get('mid');
        $sql = 'SELECT T1.*,T2.uid,T2.avatar,T2.username FROM ag_tweet_comment T1 LEFT JOIN '
            . 'ag_userdb T2 ON T1.uid = T2.uid WHERE T1.mid = ?';
        echo json_encode(DB::select($sql, array($mid)));
    }

    public function postCommentSubmit()
    {
        $content = Input::get('content');
        $mid = Input::get('mid');
        if ($mid > TweetContent::max('mid') || $mid < 1 || strlen($content) < 1 || strlen($content) > 150) {
            die("回复失败");
        }
        $tweet_Comment = new TweetComment();
        $tweet_Comment->uid = Session::get('user')['uid'];
        $tweet_Comment->mid = $mid;
        $tweet_Comment->content = $content;
        if ($tweet_Comment->save()) {
            TweetContent::find($mid)->increment('replies');
            echo "success";
        } else {
            echo "回复失败";
        }
    }

    public function retweet()
    {
        $mid = Input::get('mid');
    }

    protected function tweetList()
    {
        $sql = 'select T1.*,T2.uid,T2.avatar,T2.username FROM'
            . '(SELECT * FROM ag_tweet_content where uid in '
            . '(SELECT follow_uid FROM ag_friend_list WHERE uid = ?) '
            . 'or uid = ?) T1 '
            . 'LEFT JOIN ag_userdb T2 ON T1.uid = T2.uid '
            . 'ORDER BY T1.mid DESC';
        $uid = Session::get('user')['uid'];
        return DB::select($sql, array($uid, $uid));
    }

}
