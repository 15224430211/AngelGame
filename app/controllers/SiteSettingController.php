<?php

class SiteSettingController extends SiteController {

    public function getIndex() {
        return View::make('Site.setting.setting');
    }

    public function putIndex() {
        $input = Input::all();
        $userdb = Userdb::find(Session::get('user')['uid']);
        $userdb->address = $input['address'];
        if ($userdb->save()) {
            Session::get('user')['address'] = $input['address'];
            return Redirect::back();
        }
    }

    public function putAvatar() {
        // 获取所有表单数据
        $data = Input::all();
        // 创建验证规则
        $rules = array(
            'avatar' => 'required|mimes:jpeg,gif,png|max:1024',
        );
        // 自定义验证消息
        $messages = array(
            'avatar.required' => '请选择需要上传的图片。',
            'avatar.mimes' => '请上传 :values 格式的图片。',
            'avatar.max' => '图片的大小请控制在 1M 以内。',
        );
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // 验证成功
            $image = Input::file('avatar');
            $ext = $image->guessClientExtension();  // 根据 mime 类型取得真实拓展名
            $fullname = $image->getClientOriginalName(); // 客户端文件名，包括客户端拓展名
            $hashname = date('H.i.s') . '-' . md5($fullname) . '.' . $ext; // 哈希处理过的文件名，包括真实拓展名
            // 图片信息入库
            $user = Userdb::find(Session::get('user')['uid']);
            $oldImage = $user->avatar;
            $user->avatar = $hashname;
            $user->save();
            // 存储不同尺寸的图片
            $avatar = Image::make($image->getRealPath());
            $avatar->resize(220, 220)->save(public_path('assets/images/UserPic/large/' . $hashname));
            $avatar->resize(128, 128)->save(public_path('assets/images/UserPic/medium/' . $hashname));
            $avatar->resize(64, 64)->save(public_path('assets/images/UserPic/small/' . $hashname));
            Session::get('user')['avatar'] = $hashname;
            // 删除旧头像
            File::delete(
                    public_path('assets/images/UserPic/large/' . $oldImage), public_path('assets/images/UserPic/medium/' . $oldImage), public_path('assets/images/UserPic/small/' . $oldImage)
            );
            // 返回成功信息
            return Redirect::back()->with('success', '操作成功。');
        } else {
            // 验证失败
            return Redirect::back()->with('error', $validator->messages()->first());
        }
    }

}
