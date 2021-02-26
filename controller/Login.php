<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\index\model\Login as LoginModel;
class Login extends Controller
{
    /**登录页面 */
    public function login(){    
        return view('login');
    }

    public function loginDo(Request $request){
        $account = $request->param('account');
        $password = $request->param('password');
        $LoginModel = new LoginModel();
        $where = [
            ['account','=',$account]
        ];
        // print_r($where);exit;
        $userInfo = $LoginModel->where($where)->find();
        // print_r($userInfo);
        if(!empty($userInfo)){
            if($userInfo['password']==$password){
                session('userInfo',['id'=>$userInfo['id'],'account'=>$account]);
                $this->success('登陆成功',url('index/create'));
            }else{
                $this->error('账号或密码有误');
            }
        }
    }
}

?>