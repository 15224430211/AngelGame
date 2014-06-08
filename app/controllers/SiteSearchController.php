<?php

class SiteSearchController extends SiteController {

    public function getIndex($keyword = null) {
        $keyword ? "" : die;
        $games_info = $this->getPlayStatus($keyword);
        return View::make('Site.search.search')
                        ->with('games_info', $games_info)
                        ->with('keyword', $keyword);
    }

    //three status details
    protected function getPlayStatus($keyword) {
        $sql = 'select T1.*,T2.play_status,T2.updated_at from ag_user_game_relation T2 '
                . 'RIGHT JOIN (select * from ag_game_info '
                . 'where name_1 like ? or name_2 like ? '
                . 'order by updated_at desc';
        $sql.=') T1 ON T2.game_uid = T1.game_uid';
        return DB::select($sql, array(
                    '%' . $keyword . '%',
                    '%' . $keyword . '%'));
    }

}
