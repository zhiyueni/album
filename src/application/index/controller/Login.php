<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\User;
use think\Session;
class  Login extends Controller
{
    public function index()
    {
        return $this ->fetch();
    }

    public function login()
    {
        return $this->fetch();
    }

    public function do_login()
    {
        $info = array('username' => $_POST['user_name'], 'password' => $_POST['password']);
        $loginModel = new User();
        $res = $loginModel->checkUser($info);
        if ($res) {
            Session::set('name', $res);

            return json_encode(['code' => 200,'data'=>'../../Index/index/index','msg' =>'登录成功']);
        }
        else{
            return json_encode(['code' => 300,'data'=>'../../Index/index/index','msg' =>'登录失败']);
        }

    }
}
