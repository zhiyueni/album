<?php
    namespace app\index\model;
    use think\Model;
    use think\Db;
    class User extends Model
    {
        /*
         * 测试用户身份
         * @param $info[username] 用户名
         * @param info[password]  用户密码
         * @return $result 用户信息
         * 登录成功
         */
        public function checkUser($info)
        {

            $userInfo = Db::table('user')->where('username',$info['username'])->where('password',$info['password'])->select();
            if ($userInfo) {
                return $userInfo;
            }
            else{
                return false;
            }
        }

        /**
         * 获取用户信息
         * @param $user 用户名
         * @param $pwd 密码
         * @return mixed
         */
        public function getUserInfo($id)
        {
            $list = Db::table('xc')->where('uid',$id[0]['userid'])->select();
            return $list;
        }
    }