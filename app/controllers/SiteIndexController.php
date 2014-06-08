<?php

class SiteIndexController extends SiteController
{

    public function getIndex()
    {
//        var_dump(Auth::check());die;
        if (Session::has('user')) {
            return Redirect::to('user');
        } else {
            return View::make('Site.index.login');
        }
    }

    public function postIndex()
    {
        $credentials = array('email' => Input::get('email'), 'password' => Input::get('password'));
        if (Auth::attempt($credentials)) {
            Session::put('user', Auth::user());
            return Redirect::intended('user');
        } else {
            echo '登录失败';
        }
    }

    public function getLogout()
    {
        Session::flush();
        Auth::logout();
        return Redirect::to('/');
    }

    public function getRegister()
    {
        return View::make('Site.index.register');
    }

    public function postRegister()
    {
        $rules = array(
            'username' => 'required|min:6|max:20|unique:userdb',
            'password' => 'required|min:6|max:20',
            'email' => 'required|email|unique:userdb'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            foreach ($validator->messages()->all() as $message) {
                echo $message;
            }
        } else {
            $userdb = new Userdb();
            $userdb->email = Input::get('email');
            $userdb->username = Input::get('username');
            $userdb->password = Hash::make(Input::get('password'));
            if ($userdb->save()) {
                return Redirect::to('index/register-success');
            } else {
                die('注册失败,可能是数据库错误,请联系管理员');
            }
        }
    }

    public function getRegisterSuccess()
    {
        return View::make('Site.index.register-success');
    }

    public function postRegisterUsername()
    {
        $rules = array('username' => 'required|min:1|max:20|unique:userdb');
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            echo $validator->messages()->first();
        } else {
            echo 'success';
        }
    }

    public function postRegisterEmail()
    {
        $rules = array('email' => 'required|email|unique:userdb');
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            echo $validator->messages()->first();
        } else {
            echo 'success';
        }
    }

}
